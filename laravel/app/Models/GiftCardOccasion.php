<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class GiftCardOccasion extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'headline',
        'emoji',
        'bg_start',
        'bg_mid',
        'bg_end',
        'text_color',
        'gift_card_design_id',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function design(): BelongsTo
    {
        return $this->belongsTo(GiftCardDesign::class, 'gift_card_design_id');
    }

    public function palette(): array
    {
        return [
            'start' => $this->bg_start ?: '#c9922a',
            'mid' => $this->bg_mid ?: '#e8c56a',
            'end' => $this->bg_end ?: '#f8e8b8',
            'text' => $this->text_color ?: '#3a2810',
        ];
    }

    public function gradient(): string
    {
        $palette = $this->palette();

        return "linear-gradient(125deg, {$palette['start']} 0%, {$palette['mid']} 48%, {$palette['end']} 100%)";
    }

    public function toCustomer(): array
    {
        $palette = $this->palette();

        return [
            'id' => $this->slug,
            'name' => $this->name,
            'headline' => $this->headline,
            'emoji' => $this->emoji,
            'design' => $this->design?->slug,
            'bg' => $this->gradient(),
            'text' => $palette['text'],
        ];
    }

    public static function matchText(?string $text): ?self
    {
        $normalized = Str::lower(trim((string) $text));
        if ($normalized === '') {
            return null;
        }

        $asSlug = Str::slug($normalized);

        return static::query()
            ->where('is_active', true)
            ->get()
            ->first(function (self $occasion) use ($normalized, $asSlug) {
                $headline = Str::lower(trim(preg_replace('/[!?.]+$/', '', $occasion->headline)));

                return in_array($normalized, [
                    Str::lower($occasion->slug),
                    Str::slug($occasion->name),
                    Str::lower($occasion->name),
                    $headline,
                ], true)
                    || $asSlug === $occasion->slug
                    || $asSlug === Str::slug($occasion->name);
            });
    }
}
