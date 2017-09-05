<?php

namespace App\Http\Controllers\Organization;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use App\Model\Organization\Attendance;
use Carbon\Carbon;
use App\Model\Organization\Client as Client;
use App\Model\Organization\ProjectTask as ProjectTask;
use App\Model\Organization\Project as Project;
use App\Model\Organization\User as User;
use App\Model\Organization\UsersMeta as UM;
use App\Model\Organization\UsersRole as Role;
use App\Model\Organization\RolePermisson as Permisson;
use App\Model\Admin\GlobalWidget;
use App\Model\Admin\GlobalModule;
use App\Model\Admin\GlobalOrganization;
use App\Model\Admin\forms;
use App\Model\Admin\FormsMeta;
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
	
	public function get_allowed_widgets($organization_id = null){
		$allowed_modules = GlobalOrganization::where('id',$organization_id)->pluck('modules')->toArray();
    	$allowed_modules = json_decode($allowed_modules[0],true);
    	$enabled_modules = GlobalModule::select('id')->where('status',1)->whereIn('id',$allowed_modules)->pluck('id')->toArray();
    	$allowed_widgets = GlobalWidget::where('status',1)->whereIn('module_id',$enabled_modules)->pluck('id')->toArray();
		
		return $allowed_widgets;
	}
	
	public function init_dashboards($user_id){
		$dashboards = array('dashboard'=>array(
			'title'			=> 'Dashboard',
			'description' 	=> 'Default Dashboard',
			'slug'			=> 'dashboard',
			'widgets'		=> array()
		));
		$dashboards = json_encode($dashboards);
		update_user_meta('dashboards',$dashboards,$user_id);
		$dashboards = get_user_meta($user_id,'dashboards');
		return @json_decode($dashboards,true);
	}

	protected function updateMeta(){
		$dataArray = array(
				'form_border'  => '1',
				'form_theme' => 'light',
				'form_show_title' => '0',
				'form_show_description' => '0',
				'form_title_align' => 'center',
				'form_description_align' => 'center',
				'form_section_show_title' => '1',
				'form_section_show_description' => '0',
				'form_secion_show_border' => '1',
				'form_section_title_align' => 'left',
				'form_section_description_align' => 'left',
				'form_field_show_label' => '1',
				'form_field_show_description' => '0',
				'form_field_show_tooltip' => '0',
				'form_field_show_placeholder' => '1',
				'form_field_show_border' => '1',
				'form_field_label_position' => 'top',
				'form_show_save_button' => '1',
				'form_save_button_text' => 'Save',
				'form_reset_button_text' => 'Cancel',
				'form_show_reset_button' => '0'
			);
		$model = forms::get();
		foreach($model as $key => $value){
			foreach($dataArray as $dataKey => $dataValue){
				$metaModel = FormsMeta::firstOrNew(['form_id'=>$value->id,'key'=>$dataKey]);
				$metaModel->form_id = $value->id;
				$metaModel->key = $dataKey;
				$metaModel->value = $dataValue;
				$metaModel->save();
			}
		}
	}

    public function index($slug = null){
		$user_id = get_user_id();
		$dashboards = get_user_meta($user_id,'dashboards');
		$allowed_widgets = array();
		$widgets = array();
		$listWidgets = array();
		if($dashboards){
			$dashboards = @json_decode($dashboards,true);
			if($dashboards && is_array($dashboards)){

				//Empty or wrong dashboard slug passed 
				if(!$slug || !in_array($slug,array_keys($dashboards))){
					//key(slug) of first element 
					$first_dashboard = current(array_keys($dashboards));
					//redirect to first dashboard
					return redirect()->route('organization.dashboard',$first_dashboard);
				}
				
				$organization_id = get_organization_id();
				$allowed_widgets = $this->get_allowed_widgets($organization_id);
				$roles = get_user_roles();
				

				if(!in_array('administrator',$roles)){
						$listWidgets = $allowed_widgets;
						$allowed_widgets = array_intersect($allowed_widgets,array_map('intval',$dashboards[$slug]['widgets']));
						$widgets = GlobalWidget::whereIn('id',$allowed_widgets)->get();
						$listWidgets = array_diff($listWidgets,array_map('intval',$dashboards[$slug]['widgets']));
		    			$listWidgets = GlobalWidget::whereIn('id',$listWidgets)->pluck('title','id');
				} else{
					if(isset($dashboards[$slug]['widgets'])){
						$listWidgets = [];
	    				$widgets = GlobalWidget::whereIn('id',$allowed_widgets)->get();
	    				$listWidgets = array_diff($widgets->pluck('id')->toArray(),$dashboards[$slug]['widgets']);
	    				$listWidgets = $widgets->whereIn('id',$listWidgets)->pluck('title','id');
	    				$widgetsEnables = array_map('intval',array_intersect($dashboards[$slug]['widgets'] , $widgets->pluck('id')->toArray()));
	    				$widgets = $widgets->whereIn('id',$widgetsEnables);
	    			}
				}
				$widgets = $widgets->toArray();
				
			} else {
				$dashboards = $this->init_dashboards($user_id);
			}
		} else {
			$dashboards = $this->init_dashboards($user_id);
			return redirect()->route('organization.dashboard','');
		}
		$data = array(
			'dashboards'			=>	$dashboards,
			'current_dashboard'		=>	$slug,
			'listWidgets'			=>	$listWidgets,
			'allowed_widgets'		=>	$allowed_widgets,
			'widgets'				=>	$widgets,
			
		);

		return view('organization.dashboard.index',$data);

    }
	
	
	
    public function saveWidget(Request $request)
    {
    	$model = get_user_meta(get_user_id(),'dashboards');
    	if($model != false && !empty(json_decode($model))){
    		$dashboard_data = json_decode($model);
    		$slug = str_replace(' ', "_", $request->slug);
    		$current_slug_data = $dashboard_data->$slug;

    		if(array_key_exists('widgets', $current_slug_data)){
    			
    			$current_slug_data->widgets = array_unique( array_merge($current_slug_data->widgets,$request->widget) );

    		}else{
    			$current_slug_data->widgets = $request->widget;
    		}
        update_user_meta('dashboards',json_encode($dashboard_data));
    	return back();
    	}
    }
    public function deleteWidget(Request $request)
    {
    	$dashboards = get_user_meta(get_user_id(),'dashboards');
    	$widgets = @json_decode($dashboards,true);
    	unset($widgets[$request->slug]['widgets'][array_search($request->widget_id, $widgets[$request->slug]['widgets'])]);
    	$widgets[$request->slug]['widgets'] = array_values($widgets[$request->slug]['widgets']);
        update_user_meta('dashboards',json_encode($widgets));
		Session::flash('success','Successfully deleted!');
		return "true";
    }
    public function deleteDashboard($slug)
    {
    	$user_id = get_user_id();
    	$model = get_meta('Organization\\UsersMeta',$user_id,null,'user_id',false);
    	
    	$decoded_data = json_decode($model['dashboards'] ,true);
    	$slug = str_replace(' ', "_", $slug);
    	unset($decoded_data[$slug]);

    	$model = update_user_meta('dashboards',json_encode($decoded_data),$user_id,false);
    	return back();
    }
    public function sortDashboard(Request $request)
    {
    	$user_id = get_user_id();
    	$model = get_meta('Organization\\UsersMeta',$user_id,null,'user_id',false);
    	$old_array = json_decode($model['dashboards'],true);
    	$new_sort = $request['data'];
    	$newArray = [];
    	dd($old_array);
    	foreach($new_sort as $key => $value){
    		$newArray[$value] = $old_array[$value];
    	}
    	dd($newArray);
		$sorted = array_intersect_key(array_flip( $old_array), $request['data']);
    }
	 
	public function dashboards(Request $request){
		
		$id = get_user_id();
		$dashboards = get_user_meta($id, 'dashboards');
		$slug = strtolower(str_replace(' ', "-", $request->slug));
		$value = ['title'=>$request->title,'description'=>$request->description ,'slug' => $slug,'widgets' => array()];

		if($dashboards != false && !empty(json_decode($dashboards))){
			$dashboards = json_decode($dashboards,true);
			if(array_key_exists($slug , $dashboards)){
	            Session::flash('error' , 'Slug Already Exists');
	        } else {
				$dashboards[$slug] = $value;
			}
		} else {
			$dashboards = new \stdClass();
			$dashboards->$slug = $value;
		}
		
		$dashboards = json_encode($dashboards);
		update_user_meta('dashboards',$dashboards);
		
        return back();
    }

	public function EditDashboard(Request $request){
		
		$id = get_user_id();
		$dashboards = get_user_meta($id, 'dashboards');
		return json_decode($dashboards, true)[$request->slug];
    }
	public function updateDashboard(Request $request){
		$id = get_user_id();
		$dashboards = get_user_meta($id, 'dashboards');
		$decoded_data = json_decode($dashboards , true);
		// dd($decoded_data);
		$requestData  = $request->all();

		$decoded_data[$request->old_slug] = [
							'title' 		=> $request->title , 
							'description' 	=> $request->description,
							'slug' 			=> $request->old_slug,
							'widgets' 		=> $decoded_data[$request->old_slug]['widgets']];
		update_user_meta('dashboards', json_encode($decoded_data) , $id , $return = true);
		return back();
    }
	// public function updateDashboard(Request $request){
	// 	$id = get_user_id();
	// 	$dashboards = get_user_meta($id, 'dashboards');
	// 	$decoded_data = json_decode($dashboards , true);
	// 	$requestData  = $request->all()['data'];
	// 	$newArray = [];
	// 	foreach($decoded_data as $key => $value){
	// 		if($key == $requestData['old_slug']){
	// 			$value['slug'] = $requestData['slug'];
	// 			$newArray[$requestData['slug']] = $value;
	// 		}else{
	// 			$newArray[$key] = $value;
	// 		}
	// 	}
	// 	update_user_meta('dashboards', json_encode($newArray) , get_user_id(), $return = true);
	// 	return 'true';
 //    }
 	

}