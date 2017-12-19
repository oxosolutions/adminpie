<?php
namespace App\Http\Controllers\Organization\users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\UsersRole as Role;
use App\Model\Organization\RolePermisson as Permisson;
use App\Model\Admin\GlobalModule as Module;
use App\Model\Admin\GlobalWidget as Widget;
use App\Model\Organization\WidegetPermisson as WidgetPermisson;
use App\Model\Admin\GlobalOrganization as ORG;
use App\Model\Organization\OrganizationSetting;
use App\Model\Organization\User;
use App\Model\Organization\UserRoleMapping;
use Session;
use DB;

class UserRoleController extends Controller{
   
    public function listRole(Request $request)
    {
        if($request->has('items')){
          $perPage = $request->items;
          if($perPage == 'all'){
            $perPage = 999999999999999;
          }
        }else{
          $perPage = get_items_per_page();;
        }
        $sortedBy = @$request->orderby;
        if($request->has('search')){
            if($sortedBy != ''){
                $model = Role::where('title','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                $model = Role::where('title','like','%'.$request->search.'%')->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $model = Role::orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                 $model = Role::paginate($perPage);
            }
        }
        $datalist =  [
                        'datalist'=>$model,
                        'showColumns' => ['name'=>'Role Name','slug'=>'Role Id','description'=>'Role Description','created_at'=>'Created'],
                        'actions' => [
                                        'edit' => ['title'=>'Assign Permission','route'=>'role.assign'],
                                        'delete'=>['title'=>'Delete','route'=>'role.delete']
                                     ]
                    ];

        return view('organization.role.list' , $datalist); 

    }
    public function save(Request $request)
    {
        $org_id = Session::get('organization_id');
        
        $output = parse_slug($request->slug);
        $request['slug'] = $output;

        $data =  [
                    'name' => 'bail|required|unique:'.$org_id.'_users_roles',
                    'slug' => 'required|unique:'.$org_id.'_users_roles'
            ];

        $this->validate($request, $data);
        $role = new Role();
        $role->fill($request->all());
        $role->save();
        return redirect()->route('list.role');
    }
    public function Delete(Request $request , $id = null)
    {   
        if($request->isMethod('POST'))
        { 
            Role::where('id',$request['old_role_id'])->delete();
            try{
                DB::beginTransaction();
                    if(!empty($request['user'])){
                        $checkUserExist = UserRoleMapping::whereIn('user_id',$request['user'])->update(['role_id'=>$request['new_role_id']]);
                    }
                    Permisson::where('role_id',$request['old_role_id'])->delete();
                    
                DB::commit();
            }catch(Exception $e) {
                DB::rollback();
                }
            return redirect()->route('list.role');    
        }
        if(empty($id)){
            return redirect()->route('access.denied');
        }else{
            if($id != 1){
                $roleUser = User::with(['user_role_rel', 'metas'])->whereHas('user_role_rel',function($query) use($id){
                $query->where('role_id',$id);
                })->get();// UserRoleMapping::where('role_id',$id)->get();
                if($roleUser->toArray() == null){
                    Role::where('id',$id)->delete();
                    return back();
                }else{                    
                    $roleList = Role::whereNotIn('id',[1])->get()->keyBy('id');
                    $roleData = compact("roleUser", "roleList" ,'id');

                    return view('organization.role.roleUser', $roleData);
                }
            }else{
                Session::flash('error','You Cant Delete the Administrator role');
                return redirect()->route('list.role');
            }
        }
        // $model = OrganizationSetting::where(['value'=>$id , 'type' => 'role'])->first();
        // $model = OrganizationSetting::select(['value','key'])->whereIn('key',['employee_role','client_role'])->get()->keyBy('value')->toArray();
        // $ids = array_keys($model);
        // if(in_array($id, $ids))
        // {
        //   $data['key']  = $model[$id]['key'];
        //   $data['id']  =$id;
        //   $data['id']  =$id;
        //    return $data;
        // }else{
        //    // Role::where('id',$id)->delete();
        //     return 'false';
        // }
       
    }



    
   /**
    * [assign description]
    * @param  [int] $id [Role ID]
    * @var  $orgModule [organization assigned module array come from GlobalOrganization static method organization_module]
    * @return [type]     [description]
    */
    public function assign($id){
        if(request()->route()->parameters()['id']){
            if(request()->route()->parameters()['id'] == 1){
                return redirect('access_denied');
            }
        }else{
            Session::flash('error','not a id');
        }
        
        $orgModule = ORG::organization_module();
        $widget = Widget::whereStatus(1)->whereIn('module_id',array_collapse([$orgModule , [0]]))->orderBy('order','asc')->get();
        $role_data = Role::with(['permisson'])->where('id',$id)->get();
        $data = collect($role_data[0]['permisson']);
        $filled_data = $data->groupBy('permisson_type');
        $module_data = Module::with('subModule.moduleRoute')->whereIn('id',$orgModule)->orderBy('orderBy','asc')->get();
        return view('organization.role_permisson.permisson', ['role_data'=>$role_data, 'filled_data'=> $filled_data, 'module_data'=>$module_data ,'widget'=>$widget]);
    }
    public function role_permisson_save(Request $request)
    {
        $role_id = $request['role_id'];
        foreach ($request->all() as $key => $value) {
            if(is_array($value)){
                foreach ($value as $nkey => $nvalue) {
                    $nvalue['role_id'] = $role_id;
                    $check = Permisson::where(['permisson_type'=>$nvalue['permisson_type'], 'role_id'=>$nvalue['role_id'] , 'permisson_id'=>$nvalue['permisson_id'] ]);
                    if($check->exists()){
                        if(!isset($nvalue['permisson'])){
                         $nvalue['permisson'] =NULL;
                        }
                         $check->update($nvalue);
                    }else{
                        $permisson = new Permisson();
                        $permisson->fill($nvalue);
                        $permisson->save();
                    }
                }
            }
        }
        
        return back();
    }
    protected function check_widget($value)
    {
        if(!empty($value['permisson']) && isset($value['permisson']))
            {
                $value = $value['permisson'];
            }else{
                $value = NULL;
            }
        return $value;
    }
    // public function widget_permission_save(Request $request){

    //     foreach ($request['widget'] as $key => $value) {
    //        $check =  WidgetPermisson::where(['widget_id'=>$value['widget_id'], 'role_id'=>$value['role_id']]);
    //        if($check->count()>0)
    //        {
    //             $check->update(['permisson'=> $this->check_widget($value)]);
    //        }else{
    //         $wpermisson  = new WidgetPermisson();
    //         $wpermisson->role_id = $value['role_id'];
    //         $wpermisson->widget_id = $value['widget_id'];
    //         $wpermisson->permisson = $this->check_widget($value);
    //         $wpermisson->save();
    //              }
    //     }
    //     return redirect()->route('role.assign',['id'=>$value['role_id']]);

    //  }
}
