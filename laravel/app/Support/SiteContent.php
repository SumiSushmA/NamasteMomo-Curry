<?php

namespace App\Support;

use App\Services\SiteSettings;

class SiteContent
{
    public static function text(string $section, ?string $fallback = null): string
    {
        $value = SiteSettings::content($section);
        if ($value !== null && $value !== '') {
            return $value;
        }

        return $fallback ?? '';
    }

    public static function image(string $section, ?string $fallbackLabel = null): string
    {
        $path = SiteSettings::content($section);
        if ($path !== null && $path !== '') {
            return StockImages::resolve($fallbackLabel, $path);
        }

        if ($url = StockImages::sectionImage($section)) {
            return $url;
        }

        return StockImages::resolve($fallbackLabel);
    }

    /** @return list<string> */
    public static function lines(string $section, ?string $fallback = null): array
    {
        $raw = self::text($section, $fallback ?? '');
        $lines = preg_split('/\r\n|\r|\n/', $raw) ?: [];

        return array_values(array_filter(array_map('trim', $lines), fn ($l) => $l !== ''));
    }

    /** @return array{value: string, label: string}|null */
    public static function stat(string $section, string $defaultValue, string $defaultLabel): array
    {
        $raw = self::text($section, $defaultValue.'|'.$defaultLabel);
        $parts = explode('|', $raw, 2);

        return [
            'value' => trim($parts[0] ?? $defaultValue),
            'label' => trim($parts[1] ?? $defaultLabel),
        ];
    }
}
