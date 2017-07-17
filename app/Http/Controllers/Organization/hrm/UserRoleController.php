<?php
namespace App\Http\Controllers\Organization\hrm;

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
use Session;

class UserRoleController extends Controller{
   
    public function listRole()
    {
       $all_role = Role::all();
       return view('organization.role.list',['data'=>$all_role]);
    }
    // public function create()
    // {
    // 	return view('organization.role.create');
    // }
    public function save(Request $request)
    {
        $org_id = Session::get('organization_id');
        $data =  [
                    'name' => 'bail|required|unique:'.$org_id.'_users_roles'
            ];

        $this->validate($request, $data);
        $role = new Role();
        $role->fill($request->all());
        $role->save();
        return redirect()->route('list.role');
    }
    public function Delete(Request $request , $id = null)
    {   
        if(!empty($id) && $id==1){
            return redirect()->route('access.denied');
        }else{
            $roleUser = User::where('role_id',$id)->get();
            dd($roleUser);

        }
        // $model = OrganizationSetting::where(['value'=>$id , 'type' => 'role'])->first();
        $model = OrganizationSetting::select(['value','key'])->whereIn('key',['employee_role','client_role'])->get()->keyBy('value')->toArray();
        $ids = array_keys($model);
        if(in_array($id, $ids))
        {
          $data['key']  = $model[$id]['key'];
          $data['id']  =$id;
          $data['id']  =$id;
           return $data;
        }else{
           // Role::where('id',$id)->delete();
            return 'false';
        }
        // dd($request->all());
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
            dd('not a id');
        }
        
        $orgModule = ORG::organization_module();
        $widget = Widget::whereIn('module_id',array_collapse([$orgModule , [0]]))->get();
        $role_data = Role::with(['permisson'])->where('id',$id)->get();
        $data = collect($role_data[0]['permisson']);
        $filled_data = $data->groupBy('permisson_type');
        $module_data = Module::with('subModule.moduleRoute')->whereIn('id',$orgModule)->get();
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

    //     dd($request->all());
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
