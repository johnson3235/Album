<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class emailVerification
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
        
        if(Auth::guard('sanctum')->check() && ! Auth::guard('sanctum')->user()->email_verified_at ){
            return ApiTrait::errorMessage(['email'=>'not verifeid'],"Not Verified Admin",403);
        }

        return $next($request);
    }
}
