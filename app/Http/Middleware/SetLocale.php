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
        if (Session::has('locale')) {

            in_array(session('locale'), ['en', 'zh-CN', 'zh-TW']) ? : session(['locale' => 'en']);

        }
        
        return $next($request);
    }
}
