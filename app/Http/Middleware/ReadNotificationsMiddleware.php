<?php

namespace App\Http\Middleware;

use App\Models\NotificationModel;
use Closure;
use Illuminate\Http\Request;

class ReadNotificationsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->notification_id
            && $notification = NotificationModel::find($request->notification_id)) {
            $notification->markAsRead();

            if ($request->action == 'delete') {
                $notification->delete();
            }
        }

        return $next($request);
    }
}
