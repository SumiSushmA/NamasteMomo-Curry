<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminNotifications;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAllRead(Request $request): RedirectResponse
    {
        AdminNotifications::markAllAsRead($request->user());

        return back()->with('success', 'All notifications marked as read.');
    }
}
