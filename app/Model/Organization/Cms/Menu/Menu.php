<?php

namespace App\Model\Organization\Cms\Menu;

use Illuminate\Database\Eloquent\Model;
use Session;
use Auth;
use App\Model\Admin\Menu as AdminMenu;
class Menu extends Model
{
	protected $fillable = ['title','order'];
	public function __construct(){
		if(!empty(get_organization_id())){
			$this->table = get_organization_id().'_menus';
		}
	}
	function menuItem(){
		return $this->hasMany('App\Model\Organization\Cms\Menu\MenuItem','menu','id');
	}
	public function menuAlign()
	{
		$align = ['left' => 'Left','right' => 'Left','middle' => 'Middle'];
		return $align;
	}
	function menuList(){
		if(Auth::guard('admin')->check()){
            return AdminMenu::pluck('title','id');
        }else{
            return $this->pluck('name','id');
        }
		
	}
}
