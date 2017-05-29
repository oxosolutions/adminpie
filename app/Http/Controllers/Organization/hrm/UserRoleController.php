<?php
namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\UsersRole as Role;
use App\Model\Organization\RolePermisson as Permisson;
use App\Model\Admin\GlobalModule as Module;


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
        $role_data = Role::with('permisson')->where('id',$id)->get();
        $data = collect($role_data[0]['permisson']);
        $role_data_keys_module_id = $data->keyBy('module_id')->toArray();
        $module_data = Module::with('route')->get();
    	return view('organization.role_permisson.permisson', ['role_data'=>$role_data, 'role_data_keys_module_id'=> $role_data_keys_module_id, 'module_data'=>$module_data ]);
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
        return redirect()->route('list.role');
    }
}
