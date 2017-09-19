<?php

namespace App\Model\Organization\Cms\Menu;

use Illuminate\Database\Eloquent\Model;
use Session;

class Menu extends Model
{
	protected $fillable = ['title', 'description', 'order'];
	public function __construct(){
		if(!empty(Session::get('organization_id'))){
			$this->table = Session::get('organization_id').'_menus';
		}
	}
	function menuItem(){
		return $this->hasMany('App\Model\Organization\Cms\Menu\MenuItem','menu_id','id');
	}
	function menuList(){
		return $this->pluck('title','id');
	}
}
