<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class CustomMaps extends Model
{
    protected $table = 'global_maps';
	protected $fillable = ['table_code','code','code_albha_2','code_albha_3','code_numeric','parent','title','description','map_data','status']; 

	public static function getMapsList(){
		return self::orderBy('id','asc')->pluck('title','id');
	}
}
