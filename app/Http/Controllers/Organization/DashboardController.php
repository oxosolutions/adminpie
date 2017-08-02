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
use App\Model\Organization\UsersRole as Role;
use App\Model\Organization\RolePermisson as Permisson;
use App\Model\Admin\GlobalWidget;


//use App\App\Helpers\draw_sidebar as drawSidebar;



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
    public function index(){
    	$time = Carbon::now('Asia/Calcutta');
    	$userRole = Session::get('user_role');
    	// dd($userRole);
    	$widgets = Permisson::with(['widgets'])->where(['permisson_type'=>'widget','role_id'=>$userRole,'permisson'=>'on'])->get();
    	return view('organization.dashboard.index',['widgets'=>$widgets,'model'=>[],'check_in_out_status'=>'0']);




		$current_time =  gmdate('H:i:s',strtotime($time));
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
		
		return view('organization.dashboard.index',['check_in_out_status'=>$check_in_out_status ,'model' => $dashboardData, 'widget_data'=>$widget_data , 'slug'=>$slug]);
    }
}