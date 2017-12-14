<?php

namespace App\Http\Controllers\Organization\hrm;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\RolePermissonMapping as RP;
use App\Role;
use App\Permisson;
use App\PermissonRole;
use Session;
Use DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Model\Organization\OrganizationSetting;
use Image;
use App\Model\Organization\Employee as EMP;
use App\Model\Organization\UsersMeta;
class SettingController extends Controller
{
    //

    public function test()
    {
    	// $user = Auth::user();
    	// return $user;
    	echo "hello its working";
    }
    public function index()
    {
    		
    	$plugins = [ 'css'=> ['datatables'],
    					 'js'=>['datatables', 'custom'=>['gen-datatables'] ]	];
    	return view('setting.index', $plugins);

    }

    public function list_setting()
    {
		$model = Role::get();
    	// $model =	DB::table('roles as r')->select('r.*')
    	// 	->rightJoin('permisson_roles as pr','pr.role_id','=','r.id')->get();
		return Datatables::of($model)
		->addColumn('actions',function($model){                 
		return view('setting._actions',['model'=>$model])->render(); 
		})
		->make(true);

    }

    public function edit($id)
    {

		$data = DB::table('roles as r')
    	->select('prm.route_for','prm.route_name','pr.id as prid','r.id as rid','r.name as rname','pr.read','pr.write','pr.delete','pr.other','p.name as pname','p.id as pid')
		->leftJoin('permisson_roles as pr','r.id','=','pr.role_id')
		->leftJoin('permissons as p','p.id','=','pr.permisson_id')
		->leftJoin('permisson_route_mappings as prm', 'prm.permisson_id','=','p.id')
		->where('r.id',$id)->get();



		$role = Role::findOrFail($id);
		return view('setting.edit',['model'=>$role,'role_permisson'=>$data]);
		

    }
    public function update(Request $request)
    {
		//dd($request);	
		PermissonRole::where('role_id',$request->rid)->delete();

		if($request->permisson_id)
		{

				foreach ($request->permisson_id as $key => $value) {
						$permissonId[] = $key;
					$pr =	new PermissonRole($request->except(['_token','read']));
					$pr->role_id =  $request->rid;
					 $pr->permisson_id = $key;
					$pr->read=0;
					$pr->write=0;
					$pr->delete=0;
					$pr->other=0;
					$permSize = count($value);
					for($i=0; $i<$permSize; $i++){
					$field = $value[$i];
					$pr->$field =1;
					}
					$pr->save();
				}
					$perId = Permisson::select('id')->whereNotIn('id', $permissonId)->get();

		}
		else{
				$perId =	Permisson::select('id')->get();
		}
					
			foreach ($perId as  $value) {
					 $value->id;
					$pr =	new PermissonRole($request->except(['_token','read']));
					$pr->role_id =  $request->rid;
					$pr->permisson_id = $value->id;
					$pr->read=0;
					$pr->write=0;
					$pr->delete=0;
					$pr->other=0;
					$pr->save();	
			}
		
				return redirect()->route('setting.list');
    	
    }

    public function view($id)
    {
    	
		$countRole = DB::table('permisson_roles as pr')->where('pr.role_id',$id)->count();
		if($countRole==0)
		{

			Session::flash('error','No Permisson set yet');
			return redirect()->route('setting.list');
		}

		$data = DB::table('roles as r')->select('r.id as rid','r.name as rname','pr.read','pr.write','pr.delete','p.name as pname')
		->leftJoin('permisson_roles as pr','r.id','=','pr.role_id')
		->leftJoin('permissons as p','p.id','=','pr.permisson_id')
		->where('r.id',$id)->get();
		return view('setting.view', ['role_permisson'=> $data]);

	}

    public function create()
    {
    return	view('setting.create');
    }

    public function store(Request $request)
    {
		$this->modelValidation($request);
		if($request->permisson_id)
		{
			DB::beginTransaction();

			try{
				foreach ($request->permisson_id as $key => $value) {

					$pr =	new PermissonRole($request->except(['_token','read']));
					$pr->role_id =  $request->role_id;
					$pr->permisson_id = $key;
					$pr->read=0;
					$pr->write=0;
					$pr->delete=0;
					$permSize = count($value);
					for($i=0; $i<$permSize; $i++){
					$field = $value[$i];
					$pr->$field =1;
					}
					$pr->save();
					DB::Commit();

				}
			}catch(\Exception $e)
			{
			throw $e;
			}
		}
		else{
		Session::flash('error','Must Assign Permisson. ');
		return redirect()->route('setting.create');
		}
				return redirect()->route('setting.list');
	
    }
    

    public function modelValidation($request)
    {
    	$rules = ['role_id'=>'required'];
		$this->validate($request, $rules);
    }
    public function orgSetting(){
    	
    	$model = OrganizationSetting::get();
    	$settingsModel = [];
    	foreach($model as $key => $value){
    		$settingsModel[$value->key] = $value->value;
    	}
    	// return view('organization.settings._form',['model'=>$settingsModel]);
    	return view('organization.settings.basic',['model'=>$settingsModel]);
    }

    public function saveOrganizationSettings(Request $request){
    	// dd($request->all());
    	$organizationId = Session::get('organization_id');
    	if($request->has('employee_role')){
    		update_organization_metas($request->all());
    		return back();
    	}
    	
    	if($request->has('logo_delete')){
    		$del_logo = OrganizationSetting::where(['key' => 'logo'])->delete();
    		return back();
    	}
    	foreach($request->except(['_token']) as $key => $value){
    		//echo " <br>===".$key." --- ".$value;
    		if($key == 'bg_image_status'){
    			if($key == 0){
    				OrganizationSetting::where('key' , 'bg_image')->delete();
    			}
    		}
    		if($key == 'logo' && !empty($value)){
                if($request->hasFile('logo')){
                    $path = env('USER_FILES_PATH').'_'.$organizationId.'/assets/images';

                    $filename = date('Ymdhis');
                    $fileExt = '.'.$request->file('logo')->getClientOriginalExtension();
                    $uploadFile = $request->file('logo')->move($path, $filename.$fileExt);

                    $img = Image::make($path.'/'.$filename.$fileExt);
                    $img->resize(300, 300);
                    $resize_300x300 = $filename.'_300x300'.$fileExt;
                    $img->save($path.'/'.$resize_300x300);


                    $model = OrganizationSetting::firstOrNew(['key'=>$key]);
                    $model->key = $key;
                    $model->value = $path.'/'.$filename.$fileExt;
                    $model->save();
                }
    		}elseif($key == 'bg_image' && !empty($value)){
    			$path = env('USER_FILES_PATH').'_'.$organizationId.'/assets/bg_image';

    			$filename = date('Ymdhis');
    			$fileExt = '.'.$request->file('bg_image')->getClientOriginalExtension();
                $uploadFile = $request->file('bg_image')->move($path, $filename.$fileExt);

                $model = OrganizationSetting::firstOrNew(['key'=>$key]);
	    		$model->key = $key;
	    		$model->value = $path.'/'.$filename.$fileExt;
	    		$model->save();
    		}else{
    			if($value == '' || $value == null){
    				$value = '';
    			}
    			$model = OrganizationSetting::firstOrNew(['key'=>$key]);
	    		$model->key = $key;
	    		$model->value = $value;
	    		$model->save();
    		}
    	}

    	return back();
    }

    public function saveSettings(Request $request){
    	foreach($request->except(['_token']) as $key => $value){
    		$model = OrganizationSetting::firstOrNew(['key'=>$key]);
    		$model->key = $key;
    		$model->value = $value;
    		$model->save();
    	}
    	return back();
    }
    public function departmentSetting()
    {
    	
    }
    public function attendanceSetting()
    {	
    	$model = OrganizationSetting::get();
    	$modelArray = [];
    	foreach($model as $key => $value){
    		$modelArray[$value->key] = $value->value;
    	}
    	return view('organization.settings.hrm',['model'=>$modelArray]);
    }
    
    public function employeeSetting()
    {
    	return view('organization.settings.employee-settings');
    }
    public function roleSetting()
    {
    	return view('organization.settings.role');
    }
    public function leaveSetting()
    {
    	return view('organization.settings.leaves');
    }

    public function deletedEmployees(Request $request){

	    	$search = $this->saveSearch($request);
	        if($search != false && is_array($search)){
	            $request->request->add(['items'=>@$search['items'],'orderby'=>@$search['orderby'],'order'=>@$search['order']]);
	        }
	        $datalist= [];
	        $data= [];
	        if($request->has('items')){
	              $perPage = $request->items;
	              if($perPage == 'all'){
	                $perPage = 999999999999999;
	              }
	            }else{
	              $perPage = get_items_per_page();;
	            }
	        $sortedBy = @$request->orderby;
	        $orgId = Session::get('organization_id');
	        $datalist['datalist'] = [];
	        $model = [];
	        if($request->has('search')){
	            if($sortedBy != ''){
	                try{
	                    $model = EMP::with(['employ_info'=>function($query) use ($request){
	                          $query->with(['metas']);
	                    },'designations'=>function($query){
	                        $query->select(['name as designation_name','id']);
	                    },'department_rel'=>function($query){
	                        $query->select(['name as department_name','id']);
	                    }])
	                    ->select(
	                                [
	                                    'users.created_at as crt',
	                                    'users.name',
	                                    $orgId.'_employees.*',
	                                    $orgId.'_designations.name as designation_name',
	                                    $orgId.'_designations.id',
	                                    $orgId.'_departments.name as department_name',
	                                ]
	                            )
	                    ->join($orgId.'_designations',$orgId.'_designations.id','=',$orgId.'_employees.designation','left')
	                    ->join($orgId.'_departments',$orgId.'_departments.id','=',$orgId.'_employees.department','left')
	                    ->join($orgId.'_users as users','users.id','=',$orgId.'_employees.user_id')
	                    ->where('users.name','like','%'.$request->search.'%')
	                    ->orWhere($orgId.'_employees.employee_id','like','%'.$request->search.'%')
	                    ->orderBy($sortedBy,$request->order)
	                    ->onlyTrashed()->get()
	                    ->paginate($perPage);
	                }catch(\Exception $e){
	                    //throw $e;
	                }
	                
	            }else{
	                $model = EMP::with(['employ_info'=>function($query) use ($request){
	                      $query->with(['metas']);
	                },'designations','department_rel'])->whereHas('employ_info', function($query) use ($request){
	                    $query->where('name','like','%'.$request->search.'%');
	                })->orWhere('employee_id','like','%'.$request->search.'%')->onlyTrashed()->paginate($perPage);
	            }
	        }else{
	            if($sortedBy != ''){
	                try{
	                    $model = EMP::with(['employ_info'=>function($query){
	                          $query->with(['metas']);
	                    },'designations'=>function($query){
	                        $query->select(['name as designation_name','id']);
	                    },'department_rel'=>function($query){
	                        $query->select(['name as department_name','id']);
	                    }])
	                    ->select(
	                                [
	                                    'users.created_at as crt',
	                                    'users.name',
	                                    $orgId.'_employees.*',
	                                    $orgId.'_designations.name as designation_name',
	                                    $orgId.'_designations.id',
	                                    $orgId.'_departments.name as department_name',
	                                ]
	                            )
	                    ->join($orgId.'_designations',$orgId.'_designations.id','=',$orgId.'_employees.designation','left')
	                    ->join($orgId.'_departments',$orgId.'_departments.id','=',$orgId.'_employees.department','left')
	                    ->join($orgId.'_users as users','users.id','=',$orgId.'_employees.user_id')
	                    ->orderBy($sortedBy,$request->order)
	                    ->onlyTrashed()
	                    ->paginate($perPage);
	                }catch(\Exception $e){
	                    //throw $e;
	                }
	                
	            }else{
	                 $model = EMP::onlyTrashed()->with(['employ_info'=>function($query){
	                      $query->with(['metas']);
	                },'designations','department_rel'])->onlyTrashed()->paginate($perPage);
	            }
	        }
	        //'employ_info.metas.contact_no'=>'Contact No',
	        $datalist =  [
	                      'datalist'=>  $model,
	                      'showColumns' => ['employee_id'=>'Employee ID','employ_info.name'=>'Name','department_rel.department_name'=>'Department','designations.designation_name'=>'Designation','employ_info.email'=>'Email ID','created_at'=>'Created','status'=>'Status'],
	                      'actions' => [
	                                      'edit' => ['title'=>'Edit','route'=>['route'=>'account.profile','id'=>'employ_info.id'] , 'class' => 'edit'],
	                                      'delete'=>['title'=>'Delete','route'=>['route'=>'delete.employee','id'=>'employ_info.id'] , 'class' => 'delete']
	                                   ],
	                      'js'  =>  ['custom'=>['list-designation']],
	                      'css'=> ['custom'=>['list-designation']]
	                    ];
    	return view('organization.settings.delete_employees',$datalist);
    }

    protected function saveSearch($request){
        $search = $request->except(['page']);
        $model = UsersMeta::where(['key'=>$request->route()->uri,'user_id'=>Auth::guard('org')->user()->id])->first();
        if($model != null){
            if(!empty($request->except(['page']))){
              $model->value = json_encode($request->except(['page']));
              $model->save();
            }
            $savedSearch = json_decode($model->value, true);
            return $savedSearch;
        }else{
            $model = new UsersMeta;
            $model->user_id = Auth::guard('org')->user()->id;
            $model->key = $request->route()->uri;
            $model->value = json_encode(@$request->except(['page']));
            $model->save();
            return false;
        }
    }
}
