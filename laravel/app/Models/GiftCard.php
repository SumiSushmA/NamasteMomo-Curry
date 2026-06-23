<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GiftCard extends Model
{
    protected $fillable = [
        'code',
        'gift_card_design_id',
        'occasion',
        'occasion_label',
        'face_value',
        'balance',
        'status',
        'recipient_name',
        'sender_name',
        'message',
        'delivery_method',
        'channel',
        'payment_status',
        'payment_provider',
        'toast_order_guid',
        'toast_payment_guid',
        'payment_reference',
        'card_last4',
        'card_brand',
        'issued_at',
    ];

    protected function casts(): array
    {
        return [
            'face_value' => 'decimal:2',
            'balance' => 'decimal:2',
            'issued_at' => 'datetime',
        ];
    }

    public function design(): BelongsTo
    {
        return $this->belongsTo(GiftCardDesign::class, 'gift_card_design_id');
    }

    public function displayOccasion(): string
    {
        if ($this->occasion === 'custom' && $this->occasion_label) {
            return $this->occasion_label;
        }

        if ($this->occasion) {
            return ucfirst(str_replace('-', ' ', $this->occasion));
        }

        return '—';
    }

    public function occasionHeadline(): string
    {
        if ($this->occasion === 'custom' && $this->occasion_label) {
            return $this->occasion_label;
        }

        $preset = GiftCardOccasion::query()->where('slug', $this->occasion)->first();

        return $preset?->headline ?? $this->displayOccasion();
    }

    public function toLegacy(): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'design' => $this->design?->name ?? '',
            'occasion' => $this->displayOccasion(),
            'face' => (int) $this->face_value,
            'balance' => (int) $this->balance,
            'status' => $this->status,
            'recipient' => $this->recipient_name,
            'channel' => $this->channel,
            'issued' => ($this->issued_at ?? $this->created_at)->format('Y-m-d'),
        ];
    }
}
