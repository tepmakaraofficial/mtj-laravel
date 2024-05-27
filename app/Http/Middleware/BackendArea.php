<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BackendArea
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($user = auth()->user()){
            $adminRoleId = (new \App\Http\Controllers\AuthController())->getRoleId('admin');
            if($user->role_id!=$adminRoleId){
                return Redirect::to('/');
            }
        }else{
            // if(request()->getPathInfo()!='/admin/login'){
            //     return Redirect::to('/admin/login');
            // }
        }
        
        return $next($request);
    }
}
