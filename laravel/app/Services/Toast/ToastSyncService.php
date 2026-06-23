<?php

namespace App\Services\Toast;

use App\Models\MenuItem;
use App\Models\ToastSyncLog;

class ToastSyncService
{
    public function __construct(
        private ToastApiClient $api,
        private ToastMenuPriceResolver $priceResolver,
        private ToastMenuImageResolver $imageResolver,
    ) {}

    public function sync(): ToastSyncLog
    {
        if (! ToastConfiguration::isLive()) {
            return ToastSyncLog::create([
                'logged_at' => now(),
                'message' => 'Mock sync completed — add Toast API keys to .env for live name and price sync.',
                'is_success' => true,
            ]);
        }

        try {
            $menuPayload = $this->api->fetchMenus();
            $synced = $this->syncMenuItems($menuPayload);

            return ToastSyncLog::create([
                'logged_at' => now(),
                'message' => "Live Toast sync completed — {$synced} menu items updated with Toast names, prices, and images.",
                'is_success' => true,
            ]);
        } catch (\Throwable $e) {
            return ToastSyncLog::create([
                'logged_at' => now(),
                'message' => 'Toast sync failed: '.$e->getMessage(),
                'is_success' => false,
            ]);
        }
    }

    private function syncMenuItems(array $menuPayload): int
    {
        $localItems = MenuItem::query()->get();
        $localByToastId = $localItems->filter(fn (MenuItem $item) => filled($item->toast_pos_id))
            ->keyBy('toast_pos_id');
        $localByName = $localItems->keyBy(fn (MenuItem $item) => $this->normalizeMenuName($item->name));

        $updated = 0;

        foreach ($this->flattenToastItems($menuPayload) as $toastItem) {
            $guid = $toastItem['guid'] ?? null;
            $name = trim((string) ($toastItem['name'] ?? ''));

            if (! filled($guid) || $name === '') {
                continue;
            }

            $localItem = $localByToastId->get($guid)
                ?? $localByName->get($this->normalizeMenuName($name))
                ?? $this->findLooseNameMatch($localItems, $name);

            if ($localItem === null) {
                continue;
            }

            $price = $this->priceResolver->resolve($toastItem, $menuPayload);
            $description = trim((string) ($toastItem['description'] ?? ''));
            $imageUrl = $this->imageResolver->resolve($toastItem);

            $changes = [
                'toast_pos_id' => $guid,
                'name' => $name,
                'is_available' => $this->isVisibleOnOnlineOrdering($toastItem),
                'toast_image_url' => $imageUrl,
            ];

            if ($price !== null) {
                $changes['price'] = round($price, 2);
            }

            if ($description !== '') {
                $changes['description'] = $description;
            }

            $localItem->fill($changes);

            if ($localItem->isDirty()) {
                $localItem->save();
                $updated++;
            }

            $localByToastId->put($guid, $localItem);
            $localByName->put($this->normalizeMenuName($name), $localItem);
        }

        return $updated;
    }

    private function flattenToastItems(array $menuPayload): iterable
    {
        foreach ($menuPayload['menus'] ?? [] as $menu) {
            foreach ($menu['menuGroups'] ?? [] as $group) {
                foreach ($group['menuItems'] ?? [] as $item) {
                    yield $item;
                }
            }
        }
    }

    private function findLooseNameMatch($localItems, string $toastName): ?MenuItem
    {
        $target = $this->normalizeMenuName($toastName, loose: true);

        foreach ($localItems as $item) {
            if ($this->normalizeMenuName($item->name, loose: true) === $target) {
                return $item;
            }
        }

        return null;
    }

    private function normalizeMenuName(string $name, bool $loose = false): string
    {
        $normalized = strtolower(trim(preg_replace('/\s+/', ' ', $name) ?? $name));

        if ($loose) {
            $normalized = preg_replace('/\s*\([^)]*\)\s*$/', '', $normalized) ?? $normalized;
            $normalized = trim($normalized);
        }

        return $normalized;
    }

    private function isVisibleOnOnlineOrdering(array $toastItem): bool
    {
        $visibility = $toastItem['visibility'] ?? [];

        return in_array('TOAST_ONLINE_ORDERING', $visibility, true)
            || in_array('ORDERING_PARTNERS', $visibility, true);
    }
}
