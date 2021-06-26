<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    /**
     * Display a list of authenticated user's notifications.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $notifications = auth()->user()
            ->notifications()
            ->latest()
            ->simplePaginate();

        $notifications->each(function (DatabaseNotification $notification) {
            $notification->markAsRead();
        });

        return NotificationResource::collection($notifications)
            ->additional([
                'unread_count' => auth()->user()->unreadNotifications()->count(),
            ]);
    }

    /**
     * Retrieve the count of the unread notifications with json response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function count()
    {
        $notificationsCount = 0;
        if (auth('sanctum')->user()) {
            $notificationsCount = auth('sanctum')->user()->unreadNotifications()->count();
        }

        return response()->json([
            'notifications_count' => $notificationsCount,
        ]);
    }
}
