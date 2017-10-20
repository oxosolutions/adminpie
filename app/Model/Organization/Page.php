<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use App\Model\Organization\PageMeta;

use Session;

class Page extends Model
{
	public static $breadCrumbColumn = 'id';
   	public function __construct()
   	{
   		if(!empty(Session::get('organization_id')))
   		{
   			$this->table = Session::get('organization_id').'_pages';
   		}
   	}

   	protected $fillable = ['title','sub_title', 'slug','description', 'content', 'tags', 'categories', 'post_type', 'attachments', 'version', 'revision', 'created_by', 'post_status', 'status','type'];

      
   	public function MenuItem()
   	{
   		return $this->belongsTo('App\Model\Organization\Cms\Menu\MenuItem' , 'id' , 'page_id');
   	}

      public function pageMeta()
      {
         return $this->hasMany('App\Model\Organization\PageMeta','page_id','id');
      }

      public static function pagesList(){

         return Self::pluck('title','id');
      }

}
