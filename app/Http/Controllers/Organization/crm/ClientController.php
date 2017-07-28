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
    	return view('organization.client.create');
    }
    public function save(Request $request){
        //entry in user table with user_type 3
        $request['role_id'] = org_setting::where('key','client_role')->first()->value;
        $user_id = $this->user->create($request->all(), 3);

        //created into client rst data
            $data = new Client;
            $data->fill($request->except('_token','action','email')); 
            $data->user_id = $user_id;
            $data->save();        
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
                $perPage = 5;
        }
          $sortedBy = @$request->sort_by;
          if($request->has('search')){
              if($sortedBy != ''){
                  $model = Client::with(['getUserDataByUser_id'])->where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                  $model = Client::with(['getUserDataByUser_id'])->where('name','like','%'.$request->search.'%')->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = Client::with(['getUserDataByUser_id'])->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                   $model = Client::with(['getUserDataByUser_id'])->paginate($perPage);
              }
          }
          // dd($model);
          $datalist =  [
                          'datalist'=>  $model,
                          'showColumns' => ['name'=>'Name','getUserDataByUser_id.email'=>'Email','created_at'=>'Created At'],
                          'actions' => [
                                          'edit' => ['title'=>'Edit','route'=>'edit.client' , 'class' => 'edit'],
                                          'view' => ['title'=>'View','route'=>'view.client' , 'class' => 'view'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.client']
                                       ],
                          'js'  =>  ['custom'=>['list-designation']],
                          'css'=> ['custom'=>['list-designation']]
                      ];
          $data['data'] = Client::all();
       
        return view('organization.client.list',$datalist)->with(['data' => $data]);



    	 // $all = Client::all();
      //   return view('organization.client.list',['all_data'=>$all]);
    }
    public function edit($id){
    	$edit = Client::where('id',$id)->with('getUserDataByUser_id')->first();
        $edit->email  = $edit->getUserDataByUser_id->email;

    	return view('organization.client.edit',['model'=>$edit]); 	
    }
    public function view($id)
    {
    	$data = Client::findOrFail($id);
        return view('organization.client.view')->with('detail',$data);
    }
    public function update($id, Request $request){


    	$update = Client::findOrFail($id);
    	$update->fill($request->except('email'));
    	$update->save();

        //updae email and password and name
        $update = User::findOrFail($request->user_id);
        $update->fill($request->except('company_name','address','country','state','city','additional_info','user_id'));
        $update->save();

    	return redirect()->route('list.client');
    }
    public function delete($id)
    {
    	$data = Client::findOrFail($id);
    	$data->delete();
    	return redirect()->route('list.client');
    }
}


