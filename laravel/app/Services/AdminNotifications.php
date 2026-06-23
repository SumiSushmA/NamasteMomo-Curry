<?php

namespace App\Services;

use App\Models\CateringInquiry;
use App\Models\ContactMessage;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Carbon;

class AdminNotifications
{
    /** @return array{items: list<array<string, mixed>>, total: int} */
    public static function get(?User $user = null): array
    {
        $items = collect()
            ->merge(static::reservationNotifications($user))
            ->merge(static::cateringNotifications($user))
            ->merge(static::inquiryNotifications($user))
            ->sortByDesc('at')
            ->values()
            ->take(15)
            ->all();

        return [
            'items' => $items,
            'total' => static::actionableCount($user),
        ];
    }

    public static function markAllAsRead(User $user): void
    {
        $user->update(['notifications_cleared_at' => now()]);
    }

    public static function actionableCount(?User $user = null): int
    {
        return static::reservationQuery($user)->count()
            + static::cateringQuery($user)->count()
            + static::inquiryQuery($user)->count();
    }

    private static function clearedSince(?User $user): ?Carbon
    {
        return $user?->notifications_cleared_at;
    }

    private static function applyClearedFilter($query, string $column, ?User $user)
    {
        $since = static::clearedSince($user);

        if ($since) {
            $query->where($column, '>', $since);
        }

        return $query;
    }

    private static function reservationQuery(?User $user)
    {
        return static::applyClearedFilter(
            Reservation::query()->where('status', 'Pending'),
            'created_at',
            $user
        );
    }

    private static function cateringQuery(?User $user)
    {
        return static::applyClearedFilter(
            CateringInquiry::query()->where('status', 'New'),
            'created_at',
            $user
        );
    }

    private static function inquiryQuery(?User $user)
    {
        return static::applyClearedFilter(
            ContactMessage::query()->where('status', 'Unread'),
            'created_at',
            $user
        );
    }

    private static function reservationNotifications(?User $user)
    {
        return static::reservationQuery($user)
            ->orderByDesc('created_at')
            ->limit(6)
            ->get()
            ->map(function (Reservation $reservation) {
                return [
                    'type' => 'reservation',
                    'icon' => 'cal',
                    'tone' => 'purple',
                    'title' => 'Reservation · '.$reservation->reference,
                    'message' => $reservation->customer_name.' · party of '.$reservation->party_size.' · '.$reservation->reserved_date->format('M j').' '.$reservation->reserved_time,
                    'url' => route('admin.reservations.index'),
                    'at' => $reservation->created_at?->timestamp ?? 0,
                    'time' => $reservation->created_at?->diffForHumans(short: true) ?? '—',
                ];
            });
    }

    private static function cateringNotifications(?User $user)
    {
        return static::cateringQuery($user)
            ->orderByDesc('created_at')
            ->limit(6)
            ->get()
            ->map(function (CateringInquiry $inquiry) {
                return [
                    'type' => 'catering',
                    'icon' => 'box',
                    'tone' => 'red',
                    'title' => 'Catering inquiry · '.$inquiry->reference,
                    'message' => $inquiry->customer_name.' · '.$inquiry->guest_count.' guests · '.$inquiry->event_type,
                    'url' => route('admin.catering.index'),
                    'at' => $inquiry->created_at?->timestamp ?? 0,
                    'time' => $inquiry->created_at?->diffForHumans(short: true) ?? '—',
                ];
            });
    }

    private static function inquiryNotifications(?User $user)
    {
        return static::inquiryQuery($user)
            ->orderByDesc('created_at')
            ->limit(6)
            ->get()
            ->map(function (ContactMessage $message) {
                return [
                    'type' => 'contact',
                    'icon' => 'mail',
                    'tone' => 'red',
                    'title' => 'Contact message · '.$message->reference,
                    'message' => $message->customer_name.' · '.$message->subject,
                    'url' => route('admin.inquiries.show', $message->reference),
                    'at' => $message->created_at?->timestamp ?? 0,
                    'time' => $message->created_at?->diffForHumans(short: true) ?? '—',
                ];
            });
    }
}
