<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class Category extends Model
{
	public static $breadCrumbColumn = 'name';
    public function __construct()
	{
	    if(!empty(Session::get('organization_id')))
	    {
	    	$this->table = Session::get('organization_id').'_categories';
	    }
	}
	protected $fillable = ['name', 'description', 'type', 'status'];

	public function meta()
    {
    	return $this->hasMany('App\Model\Organization\CategoryMeta','category_id','id');
    }
    public function getList()
    {
    	return self::pluck('name','id');
    }
    public static function getCategories()
    {
       return self::where('type','bookmark')->pluck('name','id');
    }
    public static function Categories($type)
    {
       return self::where(['type'=>$type, 'status'=>1])->pluck('name','id');
    }

    public static function getListByTypePage()
    {
    	return self::where('type','page')->pluck('name','id');
    }

    public static function category_list_by_type($type)
    {
            return self::whereType($type)->pluck('name','id');

    }
}
