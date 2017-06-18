<?php 
namespace App\Repositories\Client;

interface ClientRepositoryContract{
	public function create($data=null);
	public function get_client();
}
?>