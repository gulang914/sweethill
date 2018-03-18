<?php

namespace App\Http\Middleware;

use Closure;
use DB;
class HomeLoginMiddleware
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
         $status = DB::table('config')->where('title','status')->value('content');
        //如果没有登录 返回登录页面
        if(!session('users')) {
            return redirect('login');
        }
        if($status == '0') {
            return redirect('404');
        }
        //登录之后执行下一步操作
        return $next($request); 
    }
}
