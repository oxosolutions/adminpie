<?php 
namespace App\Repositories\User;

interface UserRepositoryContract{
	public function create($data=null,$type);
	public function get_user_by_type($type);
	public function user_meta($data);
	public function employee_designation($id);
	public function user_pluck_type($type);
}
?>