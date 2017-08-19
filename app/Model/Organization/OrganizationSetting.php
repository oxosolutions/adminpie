<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class OrganizationSetting extends Model
{
	public static $breadCrumbColumn = 'id';
   public function __construct()
   {	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_organization_settings';
	   	}
   }
   protected $fillable = ['key', 'value'];


   public static function getSettings($key){
      // dd(Self::all());
      // dd(get_organization_id());
   		try{
   			return self::where('key',$key)->first()->value;
   		}catch(\exception $e){
   			return '';
   		}
   		
   }
}
