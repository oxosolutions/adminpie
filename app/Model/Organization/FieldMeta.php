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
                if(!empty(get_organization_id())){
                    $this->table = get_organization_id().'_form_field_meta';
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

    public function field(){
        return $this->belongsTo('App\Model\Organization\FormBuilder','field_id','id');
    }

}
