<?php

namespace App\Services;

use App\Models\CateringInquiry;
use App\Models\ContactMessage;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class AdminNotifications
{
    /** @return array{items: list<array<string, mixed>>, total: int} */
    public static function get(?User $user = null): array
    {
        $items = collect()
            ->merge(static::orderNotifications($user))
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
        return static::orderQuery($user)->count()
            + static::reservationQuery($user)->count()
            + static::cateringQuery($user)->count()
            + static::inquiryQuery($user)->count();
    }

    private static function clearedSince(?User $user): ?Carbon
    {
        return $user?->notifications_cleared_at;
    }

    private static function applyClearedFilter(Builder $query, string $column, ?User $user): Builder
    {
        $since = static::clearedSince($user);

        if ($since) {
            $query->where($column, '>', $since);
        }

        return $query;
    }

    private static function orderQuery(?User $user): Builder
    {
        $query = Order::query()->whereIn('status', ['New', 'Preparing']);

        $since = static::clearedSince($user);
        if ($since) {
            $query->where(function (Builder $q) use ($since) {
                $q->where('placed_at', '>', $since)
                    ->orWhere(function (Builder $q2) use ($since) {
                        $q2->whereNull('placed_at')->where('created_at', '>', $since);
                    });
            });
        }

        return $query;
    }

    private static function reservationQuery(?User $user): Builder
    {
        return static::applyClearedFilter(
            Reservation::query()->where('status', 'Pending'),
            'created_at',
            $user
        );
    }

    private static function cateringQuery(?User $user): Builder
    {
        return static::applyClearedFilter(
            CateringInquiry::query()->where('status', 'New'),
            'created_at',
            $user
        );
    }

    private static function inquiryQuery(?User $user): Builder
    {
        return static::applyClearedFilter(
            ContactMessage::query()->where('status', 'Unread'),
            'created_at',
            $user
        );
    }

    private static function orderNotifications(?User $user): Collection
    {
        return static::orderQuery($user)
            ->orderByDesc('placed_at')
            ->limit(8)
            ->get()
            ->map(function (Order $order) {
                $placedAt = $order->placed_at ?? $order->created_at;
                $isNew = $order->status === 'New';

                return [
                    'type' => 'order',
                    'icon' => $order->fulfillment_type === 'delivery' ? 'truck' : 'bag',
                    'tone' => $isNew ? 'gold' : 'blue',
                    'title' => ($isNew ? 'New order' : 'Order in progress').' · '.$order->order_number,
                    'message' => $order->customer_name.' · $'.number_format((float) $order->total, 0).' · '.ucfirst($order->fulfillment_type),
                    'url' => route('admin.orders.index', ['q' => $order->order_number, 'status' => $isNew ? 'New' : 'Preparing']),
                    'at' => $placedAt?->timestamp ?? 0,
                    'time' => $placedAt?->diffForHumans(short: true) ?? '—',
                ];
            });
    }

    private static function reservationNotifications(?User $user): Collection
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

    private static function cateringNotifications(?User $user): Collection
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

    private static function inquiryNotifications(?User $user): Collection
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
