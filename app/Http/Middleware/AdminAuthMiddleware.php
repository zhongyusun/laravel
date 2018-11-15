<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuthMiddleware
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
         //dd(1);
        //dd(auth()->check());
        //auth()->check();检测是否登录
        //dd(auth()->user()->is_admin);//检测是否为管理员
        if(!auth()->check() || auth()->user()->is_admin != 1){
            return redirect()->route('/');
        }
        return $next($request);
    }
}
