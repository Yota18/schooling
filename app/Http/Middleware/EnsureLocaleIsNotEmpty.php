<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureLocaleIsNotEmpty
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
        $route = $request->route(); // get route variable
        $routeParams = $route->parameters(); // get route parameter
        $languages = array_keys(config('app.languages')); // get list language on config app
        if (in_array($routeParams['locale'], $languages)) { // if parameter locale is exist on languages variable 
            session()->put('language', $routeParams['locale']); //set session language
            app()->setLocale($routeParams['locale']); //set locale(language setting) 
            return $next($request); // take the request to next step
        }else {
            abort(404); // show 404 error
        }
    }
}
