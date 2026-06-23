<?php

namespace App\Services\Toast;

class ToastMenuPriceResolver
{
    public function resolve(array $item, array $menuPayload): ?float
    {
        $strategy = $item['pricingStrategy'] ?? 'BASE_PRICE';
        $price = $item['price'] ?? null;

        if (in_array($strategy, ['BASE_PRICE', 'MENU_SPECIFIC_PRICE'], true)) {
            return $price !== null ? (float) $price : null;
        }

        if ($strategy === 'TIME_SPECIFIC_PRICE') {
            return $this->resolveTimeSpecificPrice($item)
                ?? ($price !== null ? (float) $price : null);
        }

        if ($strategy === 'SIZE_PRICE') {
            return $this->resolveSizePrice($item, $menuPayload);
        }

        return $price !== null ? (float) $price : null;
    }

    private function resolveTimeSpecificPrice(array $item): ?float
    {
        $rules = $item['pricingRules']['timeSpecificPricingRules'] ?? [];
        $timezone = config('app.timezone', 'America/Los_Angeles');
        $now = now($timezone);
        $day = strtoupper($now->format('l'));
        $time = $now->format('H:i');

        foreach ($rules as $rule) {
            foreach ($rule['schedule'] ?? [] as $schedule) {
                if (! in_array($day, $schedule['days'] ?? [], true)) {
                    continue;
                }

                foreach ($schedule['timeRanges'] ?? [] as $range) {
                    $start = $range['start'] ?? '';
                    $end = $range['end'] ?? '';

                    if ($start !== '' && $end !== '' && $time >= $start && $time < $end) {
                        return isset($rule['timeSpecificPrice'])
                            ? (float) $rule['timeSpecificPrice']
                            : null;
                    }
                }
            }
        }

        foreach ($rules as $rule) {
            if (isset($rule['basePrice'])) {
                return (float) $rule['basePrice'];
            }
        }

        return null;
    }

    private function resolveSizePrice(array $item, array $menuPayload): ?float
    {
        $sizeGroupGuid = $item['pricingRules']['sizeSpecificPricingGuid'] ?? null;

        if (! filled($sizeGroupGuid)) {
            return null;
        }

        $group = $this->findModifierGroupByGuid($menuPayload, $sizeGroupGuid);

        if ($group === null) {
            return null;
        }

        $prices = [];

        foreach ($group['modifierOptionReferences'] ?? [] as $refId) {
            $option = $menuPayload['modifierOptionReferences'][$refId]
                ?? $menuPayload['modifierOptionReferences'][(string) $refId]
                ?? null;

            if ($option !== null && isset($option['price']) && $option['price'] !== null) {
                $prices[] = (float) $option['price'];
            }
        }

        return $prices === [] ? null : min($prices);
    }

    private function findModifierGroupByGuid(array $menuPayload, string $guid): ?array
    {
        foreach ($menuPayload['modifierGroupReferences'] ?? [] as $group) {
            if (($group['guid'] ?? '') === $guid) {
                return $group;
            }
        }

        return null;
    }
}
