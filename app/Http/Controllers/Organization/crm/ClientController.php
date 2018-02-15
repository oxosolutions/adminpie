<?php

namespace App\Http\Controllers\Organization\crm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Client;
use App\Model\Organization\User;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Client\ClientRepositoryContract;
use App\Model\Organization\OrganizationSetting as org_setting;
use Hash;
use Session;
use App\Model\Group\GroupUsers;
use App\Model\Organization\UsersRole;
use App\Model\Organization\UserRoleMapping;
use App\Model\Organization\UsersMeta;

class ClientController extends Controller
{
	protected  $user;
    protected  $client;
	public function __construct(UserRepositoryContract $user, ClientRepositoryContract $client )
	{
        $this->user = $user;
		$this->client = $client;
	}
    public function create(){
    	return view('organization.crm.client.create');
    }

    /**
     * [validateClientRequest client posted data]
     * @param  [type] $request having request data
     * @return [type]          object
     * @author Rahul
     */
    protected function validateClientRequest($request){
        $rules = [
            'client_name' => 'required',
            'company_name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ];

        $this->validate($request,$rules);
    }


    /**
     * save client data
     * @param  Request $request [object of posted data]
     * @return [type]           Object
     * @author Rahul
     */
    public function save(Request $request){
        $this->validateClientRequest($request);
        $groupUsers = GroupUsers::where(['email'=>$request->email])->first();
        if($groupUsers == null){
            $groupUsers = new GroupUsers;
            $groupUsers->name = $request->client_name;
            $groupUsers->email = $request->email;
            $groupUsers->password = Hash::make($request->password);
            $groupUsers->status = 1;
            $groupUsers->app_password = $request->password;
            $groupUsers->save();
        }
        $userModel = new User;
        $userModel->user_id = $groupUsers->id;
        $userModel->user_type = 'client';
        $userModel->status = 1;
        $userModel->save();

        $role_id = UsersRole::where(['slug'=>'client'])->first();
        if($role_id == null){
            $roleDetails = [
                'name' => 'Client',
                'description' => 'Client',
                'slug'  =>  'client'
            ];
            $role_id = createDefaultRoles($roleDetails);
        }else{
            $role_id = $role_id->id;
        }

        $userRoleMapping = new UserRoleMapping;
        $userRoleMapping->user_id = $groupUsers->id;
        $userRoleMapping->role_id = $role_id;
        $userRoleMapping->status = 1;
        $userRoleMapping->save();

        $dataForMeta = $request->except(['client_name','email','password','_token']);

        foreach($dataForMeta as $key => $meta){
            $userMetaModel = UsersMeta::firstOrNew(['user_id'=>$groupUsers->id,'key'=>$key]);
            $userMetaModel->user_id = $groupUsers->id;
            $userMetaModel->key = $key;
            $userMetaModel->value = $meta;
            $userMetaModel->save();
        }

        Session::flash('success','Customer created successfully!');
        return redirect()->route('list.client');
        
    }


    public function listClients(Request $request){
        $datalist= [];
        $data= [];
        if($request->has('per_page')){
            $perPage = $request->per_page;
            if($perPage == 'all'){
              $perPage = 999999999999999;
            }
        }else{
                $perPage = get_items_per_page();;
        }
          $sortedBy = @$request->sort_by;
          if($request->has('search')){
              if($sortedBy != ''){
                  $model = GroupUsers::with(['organization_user'])->where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->whereHas('organization_user',function($query){
                        $query->where(['user_type'=>'client']);
                    })->paginate($perPage);
              }else{

                  $model = GroupUsers::with(['organization_user'])->where('name','like','%'.$request->search.'%')->whereHas('organization_user',function($query){
                        $query->where(['user_type'=>'client']);
                    })->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = GroupUsers::with(['organization_user'])->orderBy($sortedBy,$request->desc_asc)->whereHas('organization_user',function($query){
                        $query->where(['user_type'=>'client']);
                    })->paginate($perPage);
              }else{
                    $model = GroupUsers::with(['organization_user'])->whereHas('organization_user',function($query){
                        $query->where(['user_type'=>'client']);
                    })->paginate($perPage);
              }
          }
          $datalist =  [
                          'datalist'=>  $model,
                          'showColumns' => ['name'=>'Name','email'=>'Email','created_at'=>'Created'],
                          'actions' => [
                                          'edit' => ['title'=>'Edit','route'=>'edit.client' , 'class' => 'edit'],
                                          'view' => ['title'=>'View','route'=>'view.client' , 'class' => 'view'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.client']
                                       ],
                          'js'  =>  ['custom'=>['list-designation']],
                          'css'=> ['custom'=>['list-designation']]
                      ];
          // $data['data'] = Client::all();
       
        return view('organization.crm.client.list',$datalist)->with(['data' => $data]);
    }


    /**
     * Edit client information
     * @param  [type] $id [having group user id]
     * @return [type]     [integer]
     * @author Rahul
     */
    public function edit($id){
        $model = GroupUsers::with(['organization_user','metas'=>function($query) use ($id){
            $query->where(['user_id'=>$id]);
        }])->whereHas('organization_user', function($query){
            $query->where(['user_type'=>'client']);
        })->where('id',$id)->first();
        $model->client_name = $model->name;
        if($model != null){
            foreach($model->metas as $key => $meta){
                $model[$meta->key] = $meta->value;
            }
        }
    	return view('organization.crm.client.edit',['model'=>$model]); 	
    }


    public function view($id)
    {
    	// $data = GroupUsers::find($id);
       $model = GroupUsers::with(['organization_user','metas'=>function($query) use ($id){
            $query->where(['user_id'=>$id]);
        }])->whereHas('organization_user', function($query){
            $query->where(['user_type'=>'client']);
        })->where('id',$id)->first();
        $model->client_name = $model->name;
        if($model != null){
            foreach($model->metas as $key => $meta){
                $model[$meta->key] = $meta->value;
            }
        }
        return view('organization.crm.client.view')->with('detail',$model);
    }

    protected function validateUpdateClientRequest($request){

        $rules = [
            'client_name' => 'required',
            'company_name' => 'required',
            'email' => 'required|email'
        ];

        $this->validate($request,$rules);
    }

    /**
     * update client information
     * @param  [integer]  $id      [grou user id]
     * @param  Request $request [having all posted data in the form of request object]
     * @return [type]           redirect back to clients list page
     * @author Rahul 
     */
    public function update($id, Request $request){
        $this->validateUpdateClientRequest($request);
    	$groupUsers = GroupUsers::find($id);
        if($groupUsers == null){
            $groupUsers->name = $request->client_name;
            //$groupUsers->email = $request->email;
            if($request->has('password') && $request->password != ''){
                $groupUsers->password = Hash::make($request->password);
                $groupUsers->app_password = $request->password;
            }
            $groupUsers->status = 1;
            $groupUsers->save();
        }
        
        // ###  In case update client there is nothing to update in users table

        // ## no need to check the role and no need to change the role

        $dataForMeta = $request->except(['client_name','email','password','_token']);

        foreach($dataForMeta as $key => $meta){
            $userMetaModel = UsersMeta::firstOrNew(['user_id'=>$groupUsers->id,'key'=>$key]);
            $userMetaModel->user_id = $groupUsers->id;
            $userMetaModel->key = $key;
            $userMetaModel->value = $meta;
            $userMetaModel->save();
        }
        Session::flash('success','Client details updated successfully!!');
    	return redirect()->route('list.client');
    }


    public function delete($id)
    {
    	$data = User::where(['user_id'=>$id])->delete();
        Session::flash('success','Client deleted successfully!!');
    	return redirect()->route('list.client');
    }
}


