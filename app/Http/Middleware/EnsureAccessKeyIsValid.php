<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ApiUser;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

class EnsureAccessKeyIsValid
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
        // return $request->header('access_key');
        // return $_SERVER;
        // dd( $request->header('access_key'));
        if (isset($request->access_key)) { // if request has access_key 
        // if ($request->hasHeader('access_key')) { // if request has access_key 
            if ($access_key = ApiUser::where('token', $request->access_key)->first()) { // if access_key is on db
                // unset($request['access_key']); // delete access_key from request variable
                $request['ability']=explode(',',$access_key->ability); // add the ability of access key to request variable
                return $next($request); // take the request to next step
            }else {
                return ResponseFormatter::error([  // return error response
                    'error'=>"Something went wrong",
                ],"Authentication Failed",500);
            }
        }else {
            return ResponseFormatter::error([ // return error response
                'error'=>"Page Not Found",
            ],"Page Not Found",404);
        }
    }
}
