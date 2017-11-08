<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Route;
use App\Model\Admin\GlobalOrganization;
use Session;
use App\Model\Group\AdminUsers;
class RedirectIfGroupAuthenticated
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
        if($request->route()->auth_token != null && $request->route()->auth_token != ''){
            $adminUser = AdminUsers::where('auth_token',$request->route()->auth_token)->first();
            if($adminUser != null){
                Auth::guard('group')->logout();
                $request->session()->flush();
                $request->session()->regenerate();
                Auth::guard('group')->loginUsingId($adminUser->id);
                $adminUser->auth_token = null;
                $adminUser->save();
                return redirect()->route('group.dashboard');
            }
        }else{
            $auth = Auth::guard('group');
            if ($auth->check()) {
                return redirect('/');
            }

            return $next($request);
        }
    }

}
