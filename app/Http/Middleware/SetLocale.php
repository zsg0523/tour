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
<<<<<<< HEAD
        if (Session::has('locale') && in_array(Session::get('locale'), ['en', 'zh-HK', 'zh-CN'])) {
            \App::setLocale(Session::get('locale') ?? 'en');
=======
        if (session::has('locale') && in_array(session::get('locale'), ['en', 'zh-HK', 'zh-CN'])) {
            \App::setLocale(session::get('locale') ?? 'en');
>>>>>>> c20466b3d0bcaee7dda45061520105a67b214659
        }
        return $next($request);
    }
}
