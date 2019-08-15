<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class Language
 *
 * @package App\Http\Middleware
 * @author Anitche Chisom
 */
class Language
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
        if (session('lang') && session('lang') != app()->getLocale()) {
            app()->setLocale(session('lang'));
        }

        return $next($request);
    }
}
