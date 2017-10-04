<?php

namespace App\Model\Organization\Cms;

use Illuminate\Database\Eloquent\Model;
use App\Model\Cms\MediaMeta;
use Session;

class Media extends Model
{
	public static $breadCrumbColumn = 'title';
	protected $fillable = ['title', 'slug', 'original_name', 'type', 'extension', 'mime_type', 'dimension', 'size'];
    public function __construct(){
    	if(!empty(Session::get('organization_id'))){
			$this->table = Session::get('organization_id').'_medias';
    	}
    }
    function mediaMeta(){
    	return $this->hasMany('App\Model\Cms\MediaMeta','media_id','id');
    }
}
