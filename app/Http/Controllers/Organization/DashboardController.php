<?php

namespace App\Http\Controllers\Organization;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use EmployeeHelper;
use App\Model\Organization\Attendance;
use Carbon\Carbon;
use App\Model\Organization\Client as Client;
use App\Model\Organization\Employee as Employee;
use App\Model\Organization\ProjectTask as ProjectTask;
use App\Model\Organization\Project as Project;
use App\Model\Organization\User as User;
use App\Model\Organization\UsersMeta as UM;
use App\Model\Organization\UsersRole as Role;
use App\Model\Organization\RolePermisson as Permisson;
use App\Model\Admin\GlobalWidget;

class DashboardController extends Controller
{
	protected function widget_permisson(){
		$widgetPermisson = Permisson::select('permisson_id')->whereIn('role_id',role_id())->where([ 'permisson_type'=>'widget','permisson'=>'on'])->get();
    	$permissonWidgetId = $widgetPermisson->mapWithKeys(function ($item) {
    		return [$item['permisson_id'] => $item['permisson_id']];
			});
    	$permissonWidgetIdZeroIndex = array_values($permissonWidgetId->toArray());
		$widgets = GlobalWidget::select(['slug','id'])->whereIn('id',$permissonWidgetIdZeroIndex)->get();
		$widgetSlug =	$widgets->mapWithKeys(function ($item) {
    		return [$item['id'] => $item['slug']];
			});
		$allowWidgetSlug = array_values($widgetSlug->toArray());
		return $allowWidgetSlug; 
	}
    public function index($slug = null){
    	$time = Carbon::now('Asia/Calcutta');
    	$userRole = Session::get('user_role');
    	// dd($userRole);
    	// $model = UM::where(['user_id'=> Auth::guard('org')->user()->id , 'key' => 'dashboards'])->first();
    	// 	$dashboard_tabs = json_decode($model->value);
    	// dd(json_decode($model->value));
    	
    	$roles = get_user_roles();
    	$dashboard_tabs = [];
    	    		$model = UM::where(['user_id'=> Auth::guard('org')->user()->id , 'key' => 'dashboards'])->first();
    	   $demo = json_decode($model->value);
    	reset($demo);
        $first_key = key($demo);

        if(request()->route()->parameters() == null){
        	return redirect()->route('organization.dashboard',$first_key);
        }

    	if(!in_array('administrator',$roles)){
    		$model = UM::where(['user_id'=> Auth::guard('org')->user()->id , 'key' => 'dashboards'])->first();
    		$dashboard_tabs = json_decode($model->value);
    		$data = json_decode($model->value);
    		$slugData = $data->$slug;
    		if(array_key_exists('widget' , $slugData)){
    			    		$availWidgets = $slugData->widget;
    		$widgets = Permisson::with(['widgets'])->whereHas('widgets', function($query) use ($availWidgets){
    			$query->whereIn('id',$availWidgets);
    		})->where(['permisson_type'=>'widget','role_id'=>$userRole])->where('permisson','on')->get();
    		}else{
    			$widgets = [];
    		}
    		$AllPermissionWidgets = Permisson::with(['widgets'])->where(['permisson_type'=>'widget','role_id'=>$userRole])->where('permisson','on')->get()->pluck('widgets.title','widgets.id');
    		$AllPermissionWidgets = $AllPermissionWidgets->only(array_diff(array_keys($AllPermissionWidgets->toArray()),$slugData->widget));

    	}else{
    		$widgets = [];
    		$model = UM::where(['user_id'=> Auth::guard('org')->user()->id , 'key' => 'dashboards'])->first();
    		if($model == null){
    			$dashboard_tabs = [];
    			$AllPermissionWidgets =[];
    		}else{
    			$dashboard_tabs = json_decode($model->value);
    			$data = json_decode($model->value);
    			if(isset($data->{$slug}->widget)){
    				$widgets = GlobalWidget::get();
    				$widgets = $widgets->only(array_map('intval',$data->{$slug}->widget));
    			}
    			$AllPermissionWidgets = GlobalWidget::pluck('title','id');
    				if(array_key_exists($slug,$data)){
	    				$slugData = $data->$slug;
		    			
		    			if(@$data->{$slug}->widget != null){
			    			$AllPermissionWidgets = $AllPermissionWidgets->only(array_diff(array_keys($AllPermissionWidgets->toArray()), array_map('intval',$data->{$slug}->widget)));
		    			}else{
		    				$AllPermissionWidgets = $AllPermissionWidgets;
		    			}
	    			}else{
	    				return redirect()->route('access.denied');
	    			}
    		}
    	}
    	return view('organization.dashboard.index',['widgets'=>$widgets,'model'=>[] , 'listWidget' => $AllPermissionWidgets,'dashboard_tabs' => @$dashboard_tabs,'check_in_out_status'=>'0']);


    	/************************************* Commented Section Should Remove in future *******************************************/


		/*$current_time =  gmdate('H:i:s',strtotime($time));
			//echo $time->format('l jS \\of F Y h:i:s A');
			$ip =  \Request::ip();
			$year 	= 	$time->format('Y');
			$month 	= 	$time->format('m');
			$date  	=	$time->format('d');
			$day 	=  	$time->format('l');
	    	$user_id = Auth::guard('org')->user()->id;
	    	$check_employee  = Employee::where('user_id',$user_id)->exists();
    	if($check_employee)
    	{
	    	$data = Attendance::select('check_for_checkin_checkout')->where([ 'user_id'=> $user_id , 'year'=>$year ,'date'=>$date , 'month'=>$month ]);
			$check_in_out_status = Null;
			if($data->count() > 0)
			{
				$check_in_out_status = $data->first()->check_for_checkin_checkout;
			}
		}else{
			$check_in_out_status ="not_employ";
		}
		//widgets
		$widget_data = [];
		$allow = [];
		$slug = [];
	//	dump(role_id());
		$rid = Auth::guard('org')->user()->role_id;
		$widget = Role::with(['role_widget'=> function($query){
			$query->with('widget')->where('permisson','on');
		}])->where('id',$rid)->get();
		if(!$widget->isEmpty()){
			$widget_data = $widget[0]['role_widget'];
			$collection = collect($widget[0]['role_widget'])->toArray();
			foreach ($collection as $key => $value) {
				if(!empty($value['widget']['slug']))
				{
					//dump($value['widget']['slug']);
					 //$d = global_draw_widget($value['widget']['slug']);
					 $slug[] = $value['widget']['slug'];
				}
				$allow[] = $value['widget']['title'];
			}
		}
		$dashboardData = [];
		$keys = ['clients' 	=> [
								'model' => 'App\Model\Organization\Client',
								'route' => 'list.client'
								],
				'employees' 	=> ['model' => 'App\Model\Organization\Employee',
								'route' => 'list.employee'
								],
				'projects' 	=> ['model' => 'App\Model\Organization\Project',
								'route' => 'list.project'
								],
				'tasks' 	=> ['model' => 'App\Model\Organization\ProjectTask',
								'route' => 'account.tasks'
								],
				'users' 		=> ['model' => 'App\Model\Organization\User',
								'route' => 'list.user'
								],

				];
				if(!in_array(1,role_id())){
					$permissonWidget = $this->widget_permisson();
				}
		foreach ($keys as $key => $arrayKey) {
					// condition commented by sandeep .reason. role system is not working correctly
					 
				if(!in_array(1,role_id())){	
					if(in_array($key, $permissonWidget)){
						$dashboardData[$key] = [
															'count' => $arrayKey['model']::get()->count(),
															'list' => $arrayKey['model']::get()->take(6),
															'route' => $arrayKey['route']
														];
					}

				}else{
				$dashboardData[$key] = [
															'count' => $arrayKey['model']::get()->count(),
															'list' => $arrayKey['model']::get()->take(6),
															'route' => $arrayKey['route']
														];

				}
		}
			// if(Auth::guard('org')->user()->id==1)
			// {
			// 	$dashboardData[$key] = [
			// 							'count' => $arrayKey['model']::get()->count(),
			// 							'list' => $arrayKey['model']::get()->take(6),
			// 							'route' => $arrayKey['route']
			// 						];
			// }
			// elseif(in_array($key, $allow))
			//  {
			// 		$dashboardData[$key] =  [
			// 							'count' => $arrayKey['model']::get()->count(),
			// 							'list' => $arrayKey['model']::get()->take(6),
			// 							'route' => $arrayKey['route']
			// 						];
			//  }
		
		return view('organization.dashboard.index',['check_in_out_status'=>$check_in_out_status ,'model' => $dashboardData, 'widget_data'=>$widget_data , 'slug'=>$slug]);*/
    }
    public function saveWidget(Request $request)
    {
    	if(Auth::guard('admin')->check()){
    		$id = Auth::guard('admin')->user()->id;
    	}else{
    		$id = Auth::guard('org')->user()->id;
    	}
    	$model = UM::where(['user_id' => $id , 'key' => 'dashboards'])->first();
    	if($model != null){
    		$dashboard_data = json_decode($model->value);

    		$slug = str_replace(' ', "_", $request->slug);
    		$current_slug_data = $dashboard_data->$slug;

    		if(array_key_exists('widget', $current_slug_data)){
    			// $current_slug_data->widget = $request->widget;
    			// dump($current_slug_data->widget);
    			// dump($request->widget);
    			// dd();
    			$current_slug_data->widget = array_unique( array_merge($current_slug_data->widget,$request->widget) );

    			// dump(array_push($current_slug_data->widget,$request->widget));
    		}else{
    			$current_slug_data->widget = $request->widget;
    		}

    	$model = UM::where(['user_id' => $id , 'key' => 'dashboards'])->update(['value' => json_encode($dashboard_data)]);
    	return back();
    	}
    }
    public function deleteWidget(Request $request)
    {
    	$id = get_user()->id;
    	$model = UM::where(['user_id' => $id , 'key' => 'dashboards'])->first();
    	$widget_array = json_decode($model->value,true);
    	unset($widget_array[$request->slug]['widget'][array_search($request->widget_id, $widget_array[$request->slug]['widget'])]);
    	$widget_array[$request->slug]['widget'] = array_values($widget_array[$request->slug]['widget']);
		$model = UM::where(['user_id' => $id , 'key' => 'dashboards'])->update(['value' => json_encode($widget_array)]);
		Session::flash('success','Successfully deleted!');
		return "true";
    }
    public function deleteDashboard(Request $request)
    {
    	$user_id = get_user_id();
    	$model = get_meta('Organization\\UsersMeta',$user_id,null,'user_id',false);
    	$decoded_data = json_decode($model['dashboards'] ,true);
    	unset($decoded_data[$request->slug]);
    	$model = update_user_meta('dashboards',json_encode($decoded_data),$user_id,false);
    		return 'true';
    }
    public function sortDashboard(Request $request)
    {
    	$user_id = get_user_id();
    	$model = get_meta('Organization\\UsersMeta',$user_id,null,'user_id',false);
    	$old_array = json_decode($model['dashboards'],true);
    	$new_sort = array_combine($request['data'], $request['data']);

    	$array = array_flip($new_sort);
		$sorted = array_intersect_key(array_flip( $old_array), $request['data']);
		print_r($sorted);

    }

}