<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsSeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    { 
            if (Auth::check()) {
                $id = Auth::id();
                $user = User::find($id);
                if ($user->hasRole("seller")) {
                    return $next($request);
                }else{
                    return back();
                }
                // The user is logged in...
            }else{
                return back();
            }
        
    }
}

