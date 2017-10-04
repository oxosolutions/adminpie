<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	protected $table	= 'global_pages';
   	protected $fillable = ['title','sub_title', 'slug','description', 'content', 'tags', 'categories', 'post_type', 'attachments', 'version', 'revision', 'created_by', 'post_status', 'status','type'];

   	public function MenuItem()
   	{
   		return $this->belongsTo('App\Model\Admin\MenuItem' , 'id' , 'page_id');
   	}

	public function pageMeta()
	{
		return $this->hasMany('App\Model\Admin\PageMeta','page_id','id');
	}
}
