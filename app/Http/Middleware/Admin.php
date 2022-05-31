<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class Admin
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
        if(Session::has('user')){
            $user = Session::get('user');
            //view()->share('user', $user)让所有视图都能共享$user数据
            view()->share('user', $user);
        } else {
            return redirect('/admin/login/index');
        }
        view()->share('isAjax', $request->ajax());            
        return $next($request);
    }

}
