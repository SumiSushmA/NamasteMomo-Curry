<?php

namespace App\Services\Toast;

use App\Support\CateringCart;
use Illuminate\Http\RedirectResponse;

class ToastConfiguration
{
    public static function isLive(): bool
    {
        return filled(config('toast.client_id'))
            && filled(config('toast.client_secret'))
            && filled(config('toast.restaurant_guid'))
            && filled(config('toast.merchant_uuid'));
    }

    public static function mode(): string
    {
        if (self::isLive()) {
            return 'live';
        }

        if (self::usesHostedMenu() || self::usesHostedGiftCards()) {
            return 'toast_hosted';
        }

        return 'mock';
    }

    public static function usesRealPayments(): bool
    {
        return self::isLive() || self::usesHostedMenu() || self::usesHostedGiftCards();
    }

    public static function label(): string
    {
        if (self::isLive()) {
            return 'Toast Payments (live)';
        }

        if (self::usesHostedMenu()) {
            return 'Order & pay securely on Toast';
        }

        return 'Demo payments (configure Toast in .env)';
    }

    /**
     * Send guests to Toast hosted ordering, catering contact, or the built-in checkout.
     */
    public static function resolveCheckoutRedirect(): RedirectResponse
    {
        $menuCart = session('cart', []);
        $hasMenuItems = $menuCart !== [];
        $hasCatering = CateringCart::itemCount() > 0;

        if ($url = self::onlineOrderUrl()) {
            if ($hasMenuItems || ! $hasCatering) {
                return redirect()->away($url);
            }

            return redirect()
                ->route('contact')
                ->with('info', 'For catering orders, share your event details and our team will confirm your menu and send a quote.');
        }

        return redirect()->route('checkout');
    }

    public static function apiBaseUrl(): string
    {
        return 'https://'.config('toast.api_hostname');
    }

    public static function onlineOrderUrl(): ?string
    {
        $url = trim((string) config('toast.online_order_url'));

        return filled($url) ? $url : null;
    }

    public static function usesHostedMenu(): bool
    {
        return self::onlineOrderUrl() !== null;
    }

    public static function giftCardUrl(): ?string
    {
        $url = trim((string) config('toast.gift_card_url'));

        return filled($url) ? $url : null;
    }

    public static function usesHostedGiftCards(): bool
    {
        return self::giftCardUrl() !== null;
    }

    /** @return array<string, bool> */
    public static function credentialStatus(): array
    {
        return [
            'client_id' => filled(config('toast.client_id')),
            'client_secret' => filled(config('toast.client_secret')),
            'restaurant_guid' => filled(config('toast.restaurant_guid')),
            'merchant_uuid' => filled(config('toast.merchant_uuid')),
            'card_encryption_key' => filled(config('toast.card_encryption_key')),
            'card_encryption_key_id' => filled(config('toast.card_encryption_key_id')),
            'dining_option_delivery_guid' => filled(config('toast.dining_option_delivery_guid')),
            'dining_option_pickup_guid' => filled(config('toast.dining_option_pickup_guid')),
            'revenue_center_guid' => filled(config('toast.revenue_center_guid')),
        ];
    }
}
