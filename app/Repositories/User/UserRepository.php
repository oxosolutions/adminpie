<?php 
namespace App\Repositories\User;
use App\Model\Organization\User;
use App\Model\Organization\UsersMeta;
use Hash;

class UserRepository implements UserRepositoryContract
{
	
	public function create($data=null,$type)
	{
		$check = user::where('email',$data['email']);
		if($check->count()==0)
		{
			$user = new User();
			$user->fill($data);
			$user->password = Hash::make($data['password']);
			$user->user_type = json_encode([$type]);
			$user->role_id = $data['role_id'];
			$user->save();
			return $user->id;
		}else{

				$array = json_decode($check->first()->user_type);
				$pusharray = array_push($array,$type);
				$query = user::where('email',$data['email'])->update(['user_type' => json_encode($array)]);
				return $check->first()->id;
		}
		
	}
	public function get_user_by_type($type)
	{
		$user_list = User::where('user_type',$type)->get();
		return $user_list;
	}
	public function user_pluck_type($type)
	{
		$user_list = User::where('user_type',$type)->pluck('name','id');
		return $user_list;
	}

	public function user_meta($data)
	{
		//$type  = $data['type'];
		$user_id =	$data['user_id'];
		$checkmeta = UsersMeta::where(['user_id'=>$user_id]);
		if($checkmeta->count() >0)
		{
			$checkmeta->delete();
		}
		unset($data['user_id'],$data['_token']);
		foreach ($data as $key => $value) {
			$meta_data =['key'=>$key , 'value'=>$value , 'user_id'=>$user_id ];
			$user_meta = new UsersMeta();
			$user_meta->fill($meta_data);
			$user_meta->save();
		}
	}

	public function employee_designation($id)
	{
		$designation = UsersMeta::select('value')->where(['user_id'=>$id , 'key'=>'designation']);
		if($designation->count() > 0)
		{
			return $designation->first()->value;
		}
		return null;
	}


}

?>