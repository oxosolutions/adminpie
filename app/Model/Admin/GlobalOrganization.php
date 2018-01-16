<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Session;

class GlobalOrganization extends Model
{
  protected $fillable =['group_id', 'name', 'description', 'email', 'modules', 'slug', 'primary_domain', 'secondary_domains','active_code'];

  	public function orgList(){
      return self::orderBy('id','asc')->pluck('name','id');
    }
    public static function organizationsList(){
		  return self::orderBy('id','asc')->pluck('name','id');
  	}

  	public static function organization_module()
  	{
  		if(!empty(Session::get('organization_id'))){
			$modules = self::where('id',Session::get('organization_id'))->first()->modules;
      if($modules != null){
        return $moduleData = array_map('intval',json_decode($modules,true));
      }else{
        return [];
      }
		}

		return false;
  	}

    public function group_relation(){
        return $this->belongsTo('App\Model\Admin\GlobalGroup','group_id','id');
    }


}
