<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Admin\GlobalOrganization;
use Session;
class SurveyMiddleware
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
        $url_array = explode('.', parse_url($request->url(), PHP_URL_HOST));
        $subdomain = $url_array[0];
        $model = GlobalOrganization::where('slug',$subdomain)->first();
               if(!empty($model)){
                Session::put('organization_id',$model->id);                
               }else{
                echo "organization not exist";
                dd();
               }
        return $next($request);
    }
}
