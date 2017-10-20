<?php

namespace App\Model\Group;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;
class GroupUserMeta extends Model
{
    protected $fillable = ['user_id','key','value'];

    public function __construct(){
    	if(Auth::guard('group')->check()){
    		$this->table = 'group_'.Auth::guard('group')->user()->group_id.'_user_meta';
    	}else{
    		$this->table = 'group_'.Session::get('group_id').'_user_meta';
    	}
    }

}
