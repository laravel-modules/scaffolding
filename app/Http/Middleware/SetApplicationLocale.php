<?php

namespace App\Http\Middleware;

use Locale;
use Closure;
use Carbon\Carbon;

class SetApplicationLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = Locale::getPrimaryLanguage(
            Locale::acceptFromHttp(
                $request->header('Accept-Language')
            )
        );

        $locale = $request->header('x-accept-language') ?: request()->query('language', $locale);

        if (in_array($locale, array_keys(config('locales.languages')))) {
            app()->setLocale($locale);
            Carbon::setLocale($locale);
        }

        return $next($request);
    }
}
