<?php

namespace App\Http\Middleware;

use App\Helpers\Constant;
use App\Http\Controllers\Response;
use Closure;

class UserRoute
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
        if ($request->user()->role != Constant::ROLE_USER && $request->user()->role != Constant::ROLE_ADMIN) {
            return Response::apiError('Permission denied');
        }
        return $next($request);
    }
}
