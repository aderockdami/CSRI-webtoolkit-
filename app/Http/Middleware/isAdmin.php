<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use App\User;
use App\Model\Admin;

class isAdmin
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
        if(Admin::isAdmin(User::getToken())){
          return $next($request);
        }
        return response()->json(['error'=>'unathorised'],401);
    }
}
