<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class OrganizationSetting extends Model
{
	public static $breadCrumbColumn = 'id';
   public function __construct()
   {	
	   	if(!empty(get_organization_id()))
	   	{
	       $this->table = get_organization_id().'_organization_settings';
	   	}
   }
   protected $fillable = ['key', 'value'];


   public static function getSettings($key){
   		try{
   			return self::where('key',$key)->first()->value;
   		}catch(\exception $e){
   			return '';
   		}
   		
   }


   public static function getAndroidApp(){
      $file = scandir('application/android/',SCANDIR_SORT_DESCENDING);
      if($file[0] != '..' && $file[0] != '.'){
         return $file[0];
      }else{
         return '';
      }
   }
}
