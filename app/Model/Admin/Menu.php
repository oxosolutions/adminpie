<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['title', 'description', 'order','slug'];
	protected $table = 'global_menus';

	function menuItem(){
		return $this->hasMany('App\Model\Organization\Cms\Menu\MenuItem','menu_id','id');
	}
	public function menuAlign()
	{
		$align = ['left' => 'Left','right' => 'Left','middle' => 'Middle'];
		return $align;
	}
	function menuList(){
		return $this->pluck('title','id');
	}
}