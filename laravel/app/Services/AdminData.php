<?php

namespace App\Services;

use App\Models\CateringInquiry;
use App\Models\ContactMessage;
use App\Models\ContentBlock;
use App\Models\GiftCard;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\Setting;
use App\Models\ToastSyncLog;
use App\Models\User;
use Illuminate\Support\Carbon;

class AdminData
{
    public static function getOrderStatuses(): array
    {
        return ['New', 'Preparing', 'Ready', 'Out for delivery', 'Completed'];
    }

    public static function getOrders(): array
    {
        return Order::query()
            ->with('items')
            ->orderByDesc('placed_at')
            ->get()
            ->map(fn (Order $order) => $order->toLegacy())
            ->all();
    }

    public static function getResStatuses(): array
    {
        return ['Confirmed', 'Seated', 'Pending', 'Cancelled', 'Completed'];
    }

    public static function getReservations(): array
    {
        return Reservation::query()
            ->orderBy('reserved_date')
            ->orderBy('reserved_time')
            ->get()
            ->map(fn (Reservation $r) => $r->toLegacy())
            ->all();
    }

    public static function getCalCounts(): array
    {
        $counts = [];
        for ($d = 1; $d <= 30; $d++) {
            $counts[$d] = 0;
        }

        Reservation::query()
            ->whereBetween('reserved_date', [now()->startOfMonth()->toDateString(), now()->endOfMonth()->toDateString()])
            ->get()
            ->each(function (Reservation $r) use (&$counts) {
                $day = (int) Carbon::parse($r->reserved_date)->format('j');
                $counts[$day] = ($counts[$day] ?? 0) + 1;
            });

        return $counts;
    }

    public static function getCatering(): array
    {
        return CateringInquiry::query()
            ->orderByDesc('created_at')
            ->get()
            ->map(fn (CateringInquiry $c) => $c->toLegacy())
            ->all();
    }

    public static function getContact(): array
    {
        return ContactMessage::query()
            ->orderByDesc('created_at')
            ->get()
            ->map(fn (ContactMessage $m) => $m->toLegacy())
            ->all();
    }

    public static function getUsers(): array
    {
        return User::query()
            ->orderBy('name')
            ->get()
            ->map(fn (User $u) => $u->toLegacy())
            ->all();
    }

    public static function getAnalytics(string $range = '7'): array
    {
        [$start, $end, $prevStart, $prevEnd, $bucketType, $bucketCount] = self::resolveDashboardRange($range);

        $reservations = Reservation::query()
            ->whereBetween('reserved_date', [$start->toDateString(), $end->toDateString()])
            ->get();
        $prevReservations = Reservation::query()
            ->whereBetween('reserved_date', [$prevStart->toDateString(), $prevEnd->toDateString()])
            ->get();

        $activitySeries = [];
        $activityLabels = [];

        if ($bucketType === 'hour') {
            for ($h = 0; $h < 24; $h++) {
                $activityLabels[] = sprintf('%02d', $h);
                $activitySeries[] = (float) $reservations
                    ->filter(fn ($r) => (int) substr((string) $r->reserved_time, 0, 2) === $h)
                    ->count();
            }
        } else {
            for ($i = $bucketCount - 1; $i >= 0; $i--) {
                $day = now()->subDays($i)->startOfDay();
                $activityLabels[] = $bucketCount <= 7 ? $day->format('D') : $day->format('M j');
                $activitySeries[] = (float) $reservations
                    ->filter(fn ($r) => $r->reserved_date->isSameDay($day))
                    ->count();
            }
        }

        $currentCount = $reservations->count();
        $previousCount = $prevReservations->count();
        $activityChange = $previousCount > 0
            ? round((($currentCount - $previousCount) / $previousCount) * 100, 1)
            : ($currentCount > 0 ? 100.0 : 0.0);

        $statusTotals = Reservation::query()
            ->whereBetween('reserved_date', [$start->toDateString(), $end->toDateString()])
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $totalStatuses = max(1, $statusTotals->sum());
        $statusColors = [
            'Confirmed' => 'var(--gold-600)',
            'Pending' => 'var(--spice-600)',
            'Seated' => '#6f9b5c',
            'Completed' => '#5f5446',
            'Cancelled' => '#8a4a52',
        ];

        $channelSplit = $statusTotals->isEmpty()
            ? [['label' => 'No reservations yet', 'value' => 100, 'color' => 'var(--line)']]
            : $statusTotals->map(fn ($count, $label) => [
                'label' => $label,
                'value' => (int) round(($count / $totalStatuses) * 100),
                'color' => $statusColors[$label] ?? 'var(--gold-600)',
            ])->values()->all();

        $upcoming = Reservation::query()
            ->where('reserved_date', '>=', now()->toDateString())
            ->orderBy('reserved_date')
            ->orderBy('reserved_time')
            ->limit(5)
            ->get()
            ->map(fn (Reservation $r) => [
                'name' => $r->customer_name,
                'detail' => 'Party of '.$r->party_size.' · '.$r->reserved_date->format('M j').' '.$r->reserved_time,
                'ref' => $r->reference,
            ])
            ->all();

        return [
            'revenue7' => $activitySeries,
            'revenueDays' => $activityLabels,
            'channelSplit' => $channelSplit,
            'topItems' => $upcoming,
            'revenueChange' => $activityChange,
            'revenueUp' => $activityChange >= 0,
            'chartTitle' => match ($range) {
                'today' => 'Reservations by hour',
                '30' => 'Reservations by day',
                default => 'Reservations by day',
            },
            'chartSubtitle' => match ($range) {
                'today' => 'Today · table bookings',
                '30' => 'Last 30 days · table bookings',
                default => 'Last 7 days · table bookings',
            },
        ];
    }

    public static function getDashboardStats(string $range = '7'): array
    {
        [$start, $end] = self::resolveDashboardRange($range);

        $reservations = Reservation::query()
            ->whereBetween('reserved_date', [$start->toDateString(), $end->toDateString()])
            ->get();
        $reservationCount = $reservations->count();
        $covers = (int) $reservations->sum('party_size');

        $cateringCount = CateringInquiry::query()
            ->whereBetween('created_at', [$start, $end])
            ->count();

        $messageCount = ContactMessage::query()
            ->whereBetween('created_at', [$start, $end])
            ->count();

        $periodLabel = match ($range) {
            'today' => 'Today',
            '30' => '30d',
            default => '7d',
        };

        $rangeLabel = match ($range) {
            'today' => 'today',
            '30' => 'last 30 days',
            default => 'last 7 days',
        };

        return [
            'range' => $range,
            'periodLabel' => $periodLabel,
            'cards' => [
                ["Reservations ({$periodLabel})", (string) $reservationCount, $rangeLabel, 'cal'],
                ['Covers booked', (string) $covers, 'party size total', 'users'],
                ['Catering inquiries', (string) $cateringCount, $rangeLabel, 'box'],
                ['Contact messages', (string) $messageCount, $rangeLabel, 'mail'],
            ],
        ];
    }

    /** @return array{0: \Illuminate\Support\Carbon, 1: \Illuminate\Support\Carbon, 2: \Illuminate\Support\Carbon, 3: \Illuminate\Support\Carbon, 4: string, 5: int} */
    private static function resolveDashboardRange(string $range): array
    {
        return match ($range) {
            'today' => [
                now()->startOfDay(),
                now()->endOfDay(),
                now()->subDay()->startOfDay(),
                now()->subDay()->endOfDay(),
                'hour',
                24,
            ],
            '30' => [
                now()->subDays(29)->startOfDay(),
                now()->endOfDay(),
                now()->subDays(59)->startOfDay(),
                now()->subDays(30)->endOfDay(),
                'day',
                30,
            ],
            default => [
                now()->subDays(6)->startOfDay(),
                now()->endOfDay(),
                now()->subDays(13)->startOfDay(),
                now()->subDays(7)->endOfDay(),
                'day',
                7,
            ],
        };
    }

    public static function getToast(): array
    {
        $logs = ToastSyncLog::query()->orderByDesc('logged_at')->limit(5)->get();

        return [
            'connected' => (bool) Setting::get('toast_connected', true),
            'location' => Setting::get('toast_location', 'Riverside District · Loc #RD-4471'),
            'lastSync' => $logs->first()?->logged_at?->diffForHumans(short: true) ?? '—',
            'syncs' => [
                ['type' => 'Menu items', 'dir' => 'POS → Web', 'count' => MenuItem::count(), 'status' => 'Synced', 'time' => '2 min ago'],
                ['type' => 'Orders', 'dir' => 'Web → POS', 'count' => Order::count(), 'status' => 'Synced', 'time' => '2 min ago'],
                ['type' => 'Modifiers', 'dir' => 'POS → Web', 'count' => 38, 'status' => 'Synced', 'time' => '11 min ago'],
                ['type' => 'Inventory (86\'d items)', 'dir' => 'POS → Web', 'count' => MenuItem::where('is_available', false)->count(), 'status' => 'Synced', 'time' => '11 min ago'],
                ['type' => 'Gift cards', 'dir' => 'Two-way', 'count' => GiftCard::count(), 'status' => 'Synced', 'time' => '1 hr ago'],
                ['type' => 'Payouts', 'dir' => 'POS → Web', 'count' => 7, 'status' => 'Pending', 'time' => '—'],
            ],
            'log' => $logs->map(fn ($l) => [
                't' => $l->logged_at->format('H:i'),
                'm' => $l->message,
                'ok' => $l->is_success,
            ])->all(),
        ];
    }

    public static function getContent(): array
    {
        return ContentBlock::query()
            ->orderBy('section')
            ->get()
            ->map(fn (ContentBlock $b) => $b->toLegacy())
            ->all();
    }

    public static function getGiftCards(): array
    {
        return GiftCard::query()
            ->with('design')
            ->orderByDesc('issued_at')
            ->get()
            ->map(fn (GiftCard $g) => $g->toLegacy())
            ->all();
    }

    public static function getGiftStats(): array
    {
        $cards = GiftCard::query()->get();

        return [
            'sold' => '$'.number_format($cards->where('issued_at', '>=', now()->subDays(30))->sum('face_value'), 0),
            'outstanding' => '$'.number_format($cards->where('status', '!=', 'Redeemed')->sum('balance'), 0),
            'active' => $cards->where('status', '!=', 'Redeemed')->count(),
            'redeemed30' => '$'.number_format($cards->where('status', 'Redeemed')->where('updated_at', '>=', now()->subDays(30))->sum('face_value'), 0),
        ];
    }

    public static function getGiftSales(): array
    {
        $sales = [];
        for ($i = 6; $i >= 0; $i--) {
            $day = now()->subDays($i)->startOfDay();
            $sales[] = (int) GiftCard::query()
                ->whereDate('issued_at', $day->toDateString())
                ->sum('face_value');
        }

        return $sales;
    }

    public static function getNavBadges(): array
    {
        return [
            'reservations' => Reservation::where('status', 'Pending')->count(),
            'catering' => CateringInquiry::where('status', 'New')->count(),
            'contact' => ContactMessage::where('status', 'Unread')->count(),
        ];
    }
}
