<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
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
        //如果没有登录 返回登录页面
        if(!session('user')) {
            return redirect('admin/login');
        }
        //登录之后执行下一步操作
        return $next($request); 
    }
}
