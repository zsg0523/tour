<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class SetLocale
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
        dd(session('locale'));
        if (session::has('locale') && in_array(session::get('locale'), ['en', 'zh-HK', 'zh-CN'])) {
            \App::setLocale(session::get('locale') ?? 'en');
        }
        return $next($request);
    }
}
