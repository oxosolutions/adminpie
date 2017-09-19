<?php

namespace App\Model\Organization\Cms;

use Illuminate\Database\Eloquent\Model;
use Session;

class MediaMeta extends Model
{
    public static $breadCrumbColumn = 'media_id';
	protected $fillable = ['media_id', 'key', 'value','status'];
    public function __construct(){
    	if(!empty(Session::get('organization_id'))){
			$this->table = Session::get('organization_id').'_media_meta';
    	}
    }
}
