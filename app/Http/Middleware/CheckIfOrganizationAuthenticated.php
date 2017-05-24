<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;
class CheckIfOrganizationAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        Session::put('organization_id',10);
        $auth = Auth::guard('org');
        if (!$auth->check()) {
            return redirect('/login');
        }

        return $next($request);
    }
}
