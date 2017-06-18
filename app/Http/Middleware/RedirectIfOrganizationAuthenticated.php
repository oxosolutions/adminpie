<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Route;
use App\Model\Admin\GlobalOrganization;
use Session;
class RedirectIfOrganizationAuthenticated
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
        $domain = explode('.', $request->getHost());
        $subdomain = $domain[0];
        $model = GlobalOrganization::where('slug',$subdomain)->first();
        if($model == null){
            dd('Not Valid Organization');
        }
        Session::put('organization_id',$model->id);
        $auth = Auth::guard('org');
        if ($auth->check()) {
            return redirect('/');
        }

        return $next($request);
    }
}
