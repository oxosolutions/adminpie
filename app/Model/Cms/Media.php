<?php

namespace App\Model\Cms;

use Illuminate\Database\Eloquent\Model;
use App\Model\Cms\Media;
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
}
