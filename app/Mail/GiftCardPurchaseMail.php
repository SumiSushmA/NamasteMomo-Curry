<?php

namespace App\Mail;

use App\Mail\Concerns\HasListUnsubscribe;
use App\Models\GiftCard;
use App\Models\GiftCardDesign;
use App\Models\GiftCardOccasion;
use App\Services\SiteSettings;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GiftCardPurchaseMail extends Mailable
{
    use HasListUnsubscribe, Queueable, SerializesModels;

    public function __construct(
        public GiftCard $card,
        public GiftCardDesign $design,
        public ?string $recipientEmail = null,
        public ?GiftCardOccasion $occasion = null,
    ) {}

    public function envelope(): Envelope
    {
        $site = SiteSettings::all();
        $name = $site['restaurant_name'] ?? 'Namaste MoMo & curry house';

        return new Envelope(
            subject: "Your {$name} gift card — \${$this->card->face_value}",
            headers: $this->listUnsubscribeHeaders($this->recipientEmail),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.gift-card-purchase',
            with: [
                'card' => $this->card,
                'design' => $this->design,
                'occasion' => $this->occasion,
                'site' => SiteSettings::all(),
                'recipientEmail' => $this->recipientEmail,
            ],
        );
    }
}
