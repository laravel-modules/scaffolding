<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\NotificationModel;

class ReadNotificationsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
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
