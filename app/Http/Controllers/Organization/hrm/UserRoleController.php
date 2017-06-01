<?php
namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\UsersRole as Role;
use App\Model\Organization\RolePermisson as Permisson;
use App\Model\Admin\GlobalModule as Module;
use App\Model\Admin\GlobalWidget as Widget;
use App\Model\Organization\WidegetPermisson as WidgetPermisson;


class UserRoleController extends Controller
{
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
        $role = new Role();
        $role->fill($request->all());
        $role->save();
        return redirect()->route('list.role');
    }
    public function assign($id)
    {
        $widget = Widget::all();
        $role_data = Role::with(['permisson','role_widget'])->where('id',$id)->get();
        $role_widget_data = collect($role_data[0]['role_widget'])->keyBy('widget_id')->toArray();
        $data = collect($role_data[0]['permisson']);
        $role_data_keys_module_id = $data->keyBy('module_id')->toArray();
        $module_data = Module::with('route')->get();
    	return view('organization.role_permisson.permisson', ['role_data'=>$role_data, 'role_data_keys_module_id'=> $role_data_keys_module_id, 'module_data'=>$module_data ,'widget'=>$widget, 'role_widget_data'=> $role_widget_data ]);
    }

    protected function check_permisson($value)
    {
                if(empty($value['read']))
                {
                    $value['read']=NULL;
                }
                if(empty($value['write']))
                {
                    $value['write']=NULL;
                }
                if(empty($value['delete']))
                {
                    $value['delete']=NULL;
                }
                if(empty($value['other']))
                {
                    $value['other']=NULL;
                }
         return $value;
    }

    public function role_permisson_save(Request $request)
    {
        foreach ($request['module'] as $key => $value) {
            $check = Permisson::where(['module_id'=>$value['module_id'], 'role_id'=>$value['role_id'] ]);
            if($check->count() > 0)
            {
                $value =  $this->check_permisson($value);
                $check->update($value);
            }else{
                $value =  $this->check_permisson($value);
                $permisson = new Permisson();
                $permisson->role_id  = $value['role_id'];
                $permisson->module_id  = $value['module_id'];
                $permisson->read  =      $value['read'];
                $permisson->write  = $value['write'];
                $permisson->delete  = $value['delete'];
                $permisson->other  = $value['other'];
                $permisson->save();
            }
        }
        return redirect()->route('role.assign',['id'=>$value['role_id']]);

        // return redirect()->route('list.role');
    }
    protected function check_widget($value)
    {
        if(!empty($value['permisson']) && isset($value['permisson']))
            {
                $value['permisson'] = $value['permisson'];
            }else{
                $value['permisson'] = NULL;
            }
        return $value;
    }
    public function widget_permission_save(Request $request){
        foreach ($request['widget'] as $key => $value) {
           $check =  WidgetPermisson::where(['widget_id'=>$value['widget_id'], 'role_id'=>$value['role_id']]);
           if($check->count()>0)
           {
                $check->update($this->check_widget($value));
           }else{
            $wpermisson  = new WidgetPermisson();
            $wpermisson->role_id = $value['role_id'];
            $wpermisson->widget_id = $value['widget_id'];
            $wpermisson->permisson = $this->check_widget($value);
            $wpermisson->save();
                 }
        }
        return redirect()->route('role.assign',['id'=>$value['role_id']]);

     }
}
