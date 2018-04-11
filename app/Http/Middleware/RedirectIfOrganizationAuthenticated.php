<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Route;
use App\Model\Admin\GlobalOrganization;
use Session;
use App\Model\Organization\OrganizationSetting;
use App\Model\Organization\Page;
use Schema;
use DB;
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
        
        $organization_settings = OrganizationSetting::getSettings('default_page');
        $group_id = Session::get('group_id');
        if($organization_settings != ''){
            $page_slug = Page::find($organization_settings)->slug;
        }
        $completeDomain = $request->getHost();
        $primary_domain = $this->is_primary_domain_exists($completeDomain);
        $secondary_domain = $this->is_secondary_domain_exists($completeDomain);
        if($primary_domain == false){
            if($secondary_domain == false){
                $domain = explode('.', $request->getHost());
                $subdomain = $domain[0];
                $model = GlobalOrganization::where('slug',$subdomain)->first();
                if($model == null){
                    return redirect()->route('demo5');
                }
                Session::put('organization_id',$model->id);
                $auth = Auth::guard('org');

                $prefix = DB::getTablePrefix();
                //if(Schema::hasTable($prefix.'group_'.$group_id.'_users')){
                    if($auth->check()) {
                        if($organization_settings != ''){
                            return redirect()->route('view.pages',$page_slug);
                        }else{
                            return redirect('/dashboard');
                        }
                    }
                /*}else{
                    if(!$request->isMethod('post')){
                        Session::flush();
                        Session::regenerate();
                    }
                    Session::put('organization_id',$model->id);
                }*/
            }else{
                Session::put('organization_id',$secondary_domain->id);
                $auth = Auth::guard('org');
                if ($auth->check()) {
                    if($organization_settings != ''){
                        return redirect()->route('view.pages',$page_slug);
                    }else{
                        return redirect('/dashboard');
                    }
                }
            }
        }else{
            Session::put('organization_id',$primary_domain->id);
            $auth = Auth::guard('org');
            if ($auth->check()) {
                if($organization_settings != ''){
                    return redirect()->route('view.pages',$page_slug);
                }else{
                    return redirect('/dashboard');
                }
            }
        }
        return $next($request);
    }

    protected function is_primary_domain_exists($domain){
        $primary_domain_existance_status = GlobalOrganization::where('primary_domain',$domain)->first();
        if($primary_domain_existance_status != null){
            return $primary_domain_existance_status;
        }else{
            return false;
        }
    }

    protected function is_secondary_domain_exists($domain){
        $secondary_domain_existance_status = GlobalOrganization::where('secondary_domains',$domain)->first();
        if($secondary_domain_existance_status != null){
            return $secondary_domain_existance_status;
        }else{
            return false;
        }
    }
}
