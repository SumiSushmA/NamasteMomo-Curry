<?php

namespace App\Services\Toast;

class ToastMenuImageResolver
{
    public function resolve(array $item): ?string
    {
        foreach ($item['images'] ?? [] as $image) {
            $url = $this->normalizeUrl($image);

            if ($url !== null) {
                return $url;
            }
        }

        return $this->normalizeUrl($item['image'] ?? null);
    }

    private function normalizeUrl(mixed $value): ?string
    {
        if (is_string($value)) {
            $value = trim($value);

            return $value !== '' ? $value : null;
        }

        if (is_array($value)) {
            $url = trim((string) ($value['url'] ?? ''));

            return $url !== '' ? $url : null;
        }

        return null;
    }
}
