<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use App\Model\Organization\PageMeta;
use Config;
use Session;
use File;
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

    public function comments(){
      return $this->morphMany('App\Model\Organization\Comment', 'commentable');//->orderBy('id','DESC');
    }
    public function coments(){
      return $this->hasMany('App\Model\Organization\Comment', 'page_id','id')->whereNull('reply_id');//->whereNotNull('reply_id');//->orderBy('id','DESC');
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

    public static function getThemeFiles(){
        $path = Config::get('view.paths')[0].'/layouts/themes';
        $directory = File::directories($path);
        $themesArray = [];
        foreach($directory as $k => $dir){
            $splitedArray = explode('/',$dir);
            $themeName = $splitedArray[count($splitedArray)-1];
            $themesArray[$themeName] = $themeName;
        }
        return $themesArray;
    }

}
