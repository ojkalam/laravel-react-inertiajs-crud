<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($request->header('X-Inertia')) {
            // If it's an Inertia request, render the page with all notifications
            $notifications = $user->notifications()->latest()->get();
            return Inertia::render('Admin/Notifications/Index', [
                'notifications' => $notifications,
            ]);
        } else {
            // Otherwise, return JSON for API calls (e.g., from Topbar.jsx)
            $allNotifications = $user->notifications()->latest()->take(5)->get();
            return response()->json([
                'unreadNotifications' => $allNotifications->whereNull('read_at')->values(),
                'readNotifications' => $allNotifications->whereNotNull('read_at')->values(),
            ]);
        }
    }

    public function show($id)
    {
        $user = Auth::user();
        $notification = $user->notifications()->where('id', $id)->firstOrFail();
        $notification->markAsRead();
        return Inertia::render('Admin/Notifications/Show', ['notification' => $notification]);
    }

    public function markAsRead(Request $request)
    {
        $user = Auth::user();
        $notification = $user->notifications()->where('id', $request->id)->first();

        if ($notification) {
            $notification->markAsRead();
            return response()->json(['message' => 'Notification marked as read.']);
        }

        return response()->json(['message' => 'Notification not found.'], 404);
    }

    public function markAllAsRead()
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();
        return response()->json(['message' => 'All notifications marked as read.']);
    }
}
