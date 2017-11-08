<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Route;
use App\Model\Admin\GlobalOrganization;
use Session;
use App\Model\Organization\User;
use App\Model\Organization\OrganizationSetting;
use App\Model\Organization\Page;
class CheckOrganizationActivatedStatus
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
        $organization_settings = OrganizationSetting::getSettings('default_page');
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
                $model = GlobalOrganization::where('slug',$subdomain)->where('status',1)->first();
                if($model == null){
                    return redirect()->route('demo5');
                }
                
            }
        }
        if(Auth::guard('org')->user()->status == 0){
            Auth::guard('org')->logout();
            $request->session()->flush();
            $request->session()->regenerate();
            Session::flash('error','User not activate!');
            return redirect()->route('org.login');
        }
        $userid = Auth::guard('org')->user()->id;
        $userModel = User::where('user_id',$userid)->first();
        if($userModel == null || $userModel->status == 0){
            Auth::guard('org')->logout();
            $request->session()->flush();
            $request->session()->regenerate();
            return redirect()->route('org.login');
        }
        return $next($request);
    }

    protected function is_primary_domain_exists($domain){
        $primary_domain_existance_status = GlobalOrganization::where('primary_domain',$domain)->where('status',1)->first();
        if($primary_domain_existance_status != null){
            return $primary_domain_existance_status;
        }else{
            return false;
        }
    }

    protected function is_secondary_domain_exists($domain){
        $secondary_domain_existance_status = GlobalOrganization::where('secondary_domains',$domain)->where('status',1)->first();
        if($secondary_domain_existance_status != null){
            return $secondary_domain_existance_status;
        }else{
            return false;
        }
    }
}
