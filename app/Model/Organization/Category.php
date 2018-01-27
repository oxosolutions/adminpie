<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
use App\Model\Admin\Category as AdminCategory;
use Auth;

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

    // public function leave_meta(){
    //   return $this->hasMany('App\Model\Organization\CategoryMeta','category_id','id');
    // }
    public function category_leave(){
        return $this->hasMany('App\Model\Organization\Leave','leave_category_id','id');
    }
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
        if(Auth::guard('admin')->check()){
            return AdminCategory::where('type','page')->pluck('name','id');
        }else{
    	   return self::where('type','page')->pluck('name','id');
        }
    }

    public static function category_list_by_type($type)
    {
            return self::whereType($type)->pluck('name','id');

    }
}
