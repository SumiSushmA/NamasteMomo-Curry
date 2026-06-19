<?php

namespace App\Http\Controllers\Customer;

use App\Contracts\ToastPaymentGateway;
use App\Data\Toast\GiftCardChargeRequest;
use App\Exceptions\ToastPaymentException;
use App\Http\Controllers\Controller;
use App\Mail\GiftCardPurchaseMail;
use App\Models\GiftAmount;
use App\Models\GiftCard;
use App\Models\GiftCardDesign;
use App\Models\GiftCardOccasion;
use App\Services\RestaurantData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class GiftCardController extends Controller
{
    public function __construct(private ToastPaymentGateway $payments) {}

    public function create(): View
    {
        return view('customer.gift-cards.create', [
            'bodyPage' => 'giftcards',
            'giftOccasions' => RestaurantData::giftOccasions(),
            'giftDesigns' => RestaurantData::giftDesigns(),
            'giftAmounts' => GiftAmount::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->pluck('amount')
                ->map(fn ($amount) => (int) $amount)
                ->all(),
            'purchase' => session('gift_purchase'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'occasion' => 'required|string|max:40',
            'occasion_custom' => 'required_if:occasion,custom|nullable|string|max:80',
            'design' => 'nullable|string|max:30',
            'amount' => 'required|numeric|min:10|max:500',
            'delivery' => 'required|in:email,print,mail',
            'recipient' => 'required|string|max:120',
            'sender' => 'required|string|max:120',
            'message' => 'nullable|string|max:500',
            'card_number' => 'required|string|max:30',
            'card_expiry' => 'nullable|string|max:10',
            'card_cvc' => 'nullable|string|max:4',
        ]);

        $occasionSlug = $request->input('occasion');
        $occasionModel = null;
        $occasionLabel = null;
        $occasionName = '';
        $occasionHeadline = '';

        if ($occasionSlug === 'custom') {
            $occasionLabel = trim((string) $request->input('occasion_custom'));
            $matched = GiftCardOccasion::matchText($occasionLabel);

            if ($matched) {
                $occasionModel = $matched->load('design');
                $occasionSlug = $matched->slug;
                $occasionLabel = null;
                $occasionName = $matched->name;
                $occasionHeadline = $matched->headline;
            } else {
                $occasionName = $occasionLabel;
                $occasionHeadline = $occasionLabel;
            }
        } else {
            $occasionModel = GiftCardOccasion::query()
                ->where('slug', $occasionSlug)
                ->where('is_active', true)
                ->with('design')
                ->firstOrFail();
            $occasionName = $occasionModel->name;
            $occasionHeadline = $occasionModel->headline;
        }

        $designSlug = $request->input('design');
        if ($designSlug && $designSlug !== 'classic') {
            $design = GiftCardDesign::query()
                ->where('slug', $designSlug)
                ->where('is_active', true)
                ->firstOrFail();
        } else {
            $design = $occasionModel?->design
                ?? GiftCardDesign::query()->where('is_active', true)->firstOrFail();
        }
        $amount = (float) $request->input('amount');
        $recipient = $request->input('recipient');
        $recipientEmail = str_contains($recipient, '@') ? $recipient : null;

        try {
            $payment = $this->payments->chargeGiftCard(new GiftCardChargeRequest(
                amount: $amount,
                senderName: $request->input('sender'),
                recipientName: $recipientEmail ? $recipient : $recipient,
                recipientEmail: $recipientEmail,
                cardNumber: $request->input('card_number'),
                cardExpiry: $request->input('card_expiry'),
                cardCvc: $request->input('card_cvc'),
                clientIp: $request->ip() ?? '127.0.0.1',
            ));
        } catch (ToastPaymentException $e) {
            return back()->withInput()->withErrors(['payment' => $e->getMessage()]);
        }

        if (! $payment->success) {
            return back()->withInput()->withErrors(['payment' => $payment->error ?? 'Payment could not be processed.']);
        }

        $code = 'NK-'.strtoupper(Str::random(4)).'-'.random_int(1000, 9999);

        $card = GiftCard::create([
            'code' => $code,
            'gift_card_design_id' => $design->id,
            'occasion' => $occasionSlug,
            'occasion_label' => $occasionLabel,
            'face_value' => $amount,
            'balance' => $amount,
            'status' => 'Active',
            'recipient_name' => $recipient,
            'sender_name' => $request->input('sender'),
            'message' => $request->input('message'),
            'delivery_method' => $request->input('delivery'),
            'channel' => 'Online',
            'payment_status' => $payment->status,
            'payment_provider' => $payment->provider,
            'toast_order_guid' => $payment->toastOrderGuid,
            'toast_payment_guid' => $payment->toastPaymentGuid,
            'payment_reference' => $payment->paymentReference,
            'card_last4' => $payment->cardLast4,
            'card_brand' => $payment->cardBrand,
            'issued_at' => now(),
        ]);

        session(['gift_purchase' => [
            'code' => $card->code,
            'amount' => (float) $card->face_value,
            'occasion' => $occasionName,
            'occasion_headline' => $occasionHeadline,
            'design' => $design->name,
            'delivery' => $card->delivery_method,
            'recipient' => $card->recipient_name,
            'sender' => $card->sender_name,
            'payment_provider' => $payment->provider,
            'payment_reference' => $payment->paymentReference,
        ]]);

        if ($recipientEmail && $request->input('delivery') === 'email') {
            Mail::to($recipientEmail)->send(new GiftCardPurchaseMail($card, $design, $recipientEmail, $occasionModel));
        }

        return redirect()->route('giftcards')->with('gift_sent', true);
    }

    public function balance(Request $request): JsonResponse
    {
        $request->validate(['code' => 'required|string|max:30']);

        $code = strtoupper(trim($request->input('code')));
        $card = GiftCard::query()
            ->where('code', $code)
            ->where('status', 'Active')
            ->first();

        if (! $card) {
            return response()->json([
                'ok' => false,
                'message' => 'Gift card not found. Check the code and try again.',
            ]);
        }

        return response()->json([
            'ok' => true,
            'code' => $card->code,
            'balance' => (float) $card->balance,
        ]);
    }
}
