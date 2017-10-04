<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    public $table = 'global_medias';
	protected $fillable = ['title', 'slug', 'original_name', 'type', 'extension', 'mime_type', 'dimension', 'size'];

    function mediaMeta(){
    	return $this->hasMany('App\Model\Cms\MediaMeta','media_id','id');
    }
}
