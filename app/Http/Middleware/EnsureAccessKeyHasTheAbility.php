<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

class EnsureAccessKeyHasTheAbility
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $ability)
    {
        if (in_array('*', $request->ability) || in_array($ability, $request->ability)){ // if ability is all or ability is exist on request ability(from access key)
            unset($request['ability']); // delete ability from request variable
            return $next($request); // take the request to next step
        }else {
            return ResponseFormatter::error([ // return error response
                'error' => "Something went wrong",
            ], "Authentication Failed", 500);
        }
    }
}
