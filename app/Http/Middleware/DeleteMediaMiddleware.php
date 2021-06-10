<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DeleteMediaMiddleware
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
        if ($request->input('deleted_images')) {
            if (is_string($request->input('deleted_images'))) {
                $ids = json_decode($request->input('deleted_images'));
            } else {
                $ids = $request->input('deleted_images');
            }

            Media::whereIn('id', Arr::wrap($ids))->each(function (Media $media) {
                $media->delete();
            });
        }

        return $next($request);
    }
}
