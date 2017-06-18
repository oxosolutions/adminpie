<?php 
namespace App\Repositories\Client;
use App\Model\Organization\Client;

class ClientRepository implements ClientRepositoryContract
{
	
	public function create($data=null)
	{
		
		$client = new Client();
		$client->fill($data);
		$client->save();
		
	}
	public function get_client()
	{
		return $user_list = Client::all();
	}


}

?>