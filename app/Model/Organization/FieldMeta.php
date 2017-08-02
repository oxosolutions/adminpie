<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;
class FieldMeta extends Model
{
	protected $table = 'global_form_field_meta';
	protected $fillable = ['form_id','section_id','field_id','key','value']; 

	public function __construct(){
        try{
            if(Auth::guard('org')->check()){
                if(!empty(Session::get('organization_id'))){
                    $this->table = Session::get('organization_id').'_form_field_meta';
                }
            }
        }catch(\Exception $e){
            
        }
    }
	public static function getMetaByKey($metaArray, $metaKey){
		$metaData = $metaArray->where('key',$metaKey);
		$metaValue = false;
		foreach($metaData as $key => $value){
			$metaValue = $value->value;
		}
		return $metaValue;
	}

}
