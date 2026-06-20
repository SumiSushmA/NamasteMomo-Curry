<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminData;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $range = in_array($request->query('range'), ['today', '30'], true)
            ? $request->query('range')
            : '7';

        $badges = AdminData::getNavBadges();
        $analytics = AdminData::getAnalytics($range);
        $dashboard = AdminData::getDashboardStats($range);
        $reservations = AdminData::getReservations();

        $user = $request->user();
        $firstName = Str::before($user->name ?? 'there', ' ');
        $hour = (int) now()->format('G');
        $greeting = $hour < 12 ? 'Good morning' : ($hour < 17 ? 'Good afternoon' : 'Good evening');

        $tasks = array_values(array_filter([
            $badges['reservations'] > 0 ? [
                'cal', 'gold',
                $badges['reservations'].' reservation'.($badges['reservations'] === 1 ? '' : 's'),
                'pending confirmation',
                'admin.reservations.index',
            ] : null,
            $badges['catering'] > 0 ? [
                'box', 'purple',
                $badges['catering'].' catering inquir'.($badges['catering'] === 1 ? 'y' : 'ies'),
                'awaiting a quote',
                'admin.catering.index',
            ] : null,
            $badges['contact'] > 0 ? [
                'mail', 'red',
                $badges['contact'].' unread message'.($badges['contact'] === 1 ? '' : 's'),
                'in the contact inbox',
                'admin.inquiries.index',
            ] : null,
        ]));

        $upcomingReservations = collect($reservations)
            ->filter(fn ($r) => in_array($r['status'], ['Confirmed', 'Pending'], true))
            ->take(5)
            ->values()
            ->all();

        return view('admin.dashboard', [
            'active' => 'overview',
            'range' => $range,
            'greeting' => $greeting,
            'firstName' => $firstName,
            'upcomingReservations' => $upcomingReservations,
            'analytics' => $analytics,
            'dashboardStats' => $dashboard['cards'],
            'tasks' => $tasks,
            'badges' => $badges,
        ]);
    }
}
