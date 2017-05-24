<?php

namespace App\Http\Controllers\Organization\crm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Client;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Client\ClientRepositoryContract;


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
    try{
        	$user_id = $this->user->create($request->all(),3); 
            $request->request->add(['user_id'=>$user_id]);
            $this->client->create($request->all());
        	return redirect()->route('list.client');
    	}catch(\Exception $e)
    	{
    		throw $e;    		
    	}
    }
    public function listClients(){
    	 $all = Client::all();
        return view('organization.client.list',['all_data'=>$all]);
    }
    public function edit($id){
    	$edit = Client::findOrFail($id);
    	return view('organization.client.edit',['model'=>$edit]); 	
    }
    public function view($id)
    {
    	$data = Client::findOrFail($id);
        return view('organization.client.view')->with('detail',$data);

    }
    public function update($id, Request $request){
    	$update = Client::findOrFail($id);
    	$update->fill($request->all());
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


