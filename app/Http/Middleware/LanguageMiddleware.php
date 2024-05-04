<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $supportedLocales = ["ar", "fr", "en", "es"];
        if (session()->has('locale')) {
            $locale = session('locale');
            if (in_array($locale, $supportedLocales)) {
                app()->setLocale($locale);
            } else {
                // Fallback to English if the stored locale is unsupported
                app()->setLocale('en');
            }
        }
        return $next($request);
    }
}
