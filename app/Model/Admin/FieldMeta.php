<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class FieldMeta extends Model
{
	protected $table = 'global_form_field_meta';
	protected $fillable = ['form_id','section_id','field_id','key','value']; 

	
	public static function getMetaByKey($metaArray, $metaKey){
		$metaData = $metaArray->where('key',$metaKey);
		$metaValue = false;
		foreach($metaData as $key => $value){
			$metaValue = $value->value;
		}
		return $metaValue;
	}

}
