<?php
namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\UsersRole as Role;
use App\Model\Organization\RolePermisson as Permisson;
use App\Model\Admin\GlobalModule as Module;


class UserRoleController extends Controller
{
    public function list()
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
       // dump($role_data);
        $module_data = Module::with('route')->get();
    	return view('organization.role_permisson.create', ['role_data'=>$role_data, 'module_data'=>$module_data ]);
    }

    public function role_permisson_save(Request $request)
    {
        //$permisson = new Permisson();
        // foreach ($request['module'] as $key => $value) {

        //             dump($value);
        //    $permisson = new Permisson();
        //    $permisson->module_id  = $value['module_id'];
        //    $permisson->reaad  = $value['reaad'];
        //    $permisson->write  = $value['write'];
        //    $permisson->save();
        // }
           //$permisson->fill($value);
           // $permisson->fill($value);
           // $permisson->save();
       
        Permisson::insert($request['module']);
        dump($request->all());
    }
}
