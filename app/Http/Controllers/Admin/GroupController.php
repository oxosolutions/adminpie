<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\GlobalGroup as Group;
use App\Model\Group\AdminUsers;
use DB;
use Hash;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('items')){
          $perPage = $request->items;
          if($perPage == 'all'){
            $perPage = 999999999999999;
          }
        }else{
          $perPage = 5;
        }
        $sortedBy = @$request->orderby;
        if($request->has('search')){
            if($sortedBy != ''){
                $model = Group::where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                $model = Group::where('name','like','%'.$request->search.'%')->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $exploded = @explode(':',$sortedBy);
                if(isset($exploded[1])){
                    $sortedBy = $exploded[0];
                }
                $model = Group::orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                 $model = Group::paginate($perPage);
            }
        }
        $datalist =  [
                        'datalist'=>$model,
                        'showColumns' => ['name'=>'Title','description'=>'Description','created_at'=>'Created At'],
                        'actions' => [
                                        // 'edit' => ['title'=>'Edit','route'=>'list.holidays'],
                                        // 'delete'=>['title'=>'Delete','route'=>'delete.holiday']
                                     ]
                    ];

        return view('group.group.index' , $datalist); 
        // return view('group.group.index');
    }

    public function create()
    {   
        return view('group.group.create');
    }
    public function store(Request $request)
    {

        $model = new Group;
        $model->fill($request->all('_token','modules','email','password'));
        $model->modules = json_encode($request['modules']);
        $model->save();
        $groupId = $model->id;

        // email apasswor group_id
            $AdminUserData = ['email' => $request['email'] , 'password' => Hash::make($request['password'])];
            $AdminUsers = new AdminUsers;
            $AdminUsers->fill($AdminUserData);
            $AdminUsers->role_id = 1;
            $AdminUsers->group_id = $groupId;
            $AdminUsers->save();


        // // ocrm_{id}_group_users
            DB::statement('CREATE TABLE ocrm_'.$groupId.'_group_users (id INT(11) AUTO_INCREMENT PRIMARY KEY, name VARCHAR(200) , email VARCHAR(200), api_token VARCHAR(200), role_id INT(11), password VARCHAR(200), remember_token VARCHAR(100), created_at timestamp ,updated_at timestamp)');
            return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
