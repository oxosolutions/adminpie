<?php

namespace App\Model\Organization\Cms\Menu;

use Illuminate\Database\Eloquent\Model;
use Session;
class MenuItem extends Model
{	
	protected $fillable =['menu_id','page_id', 'label', 'description', 'title', 'class', 'title_attribute', 'link', 'target', 'type', 'parent', 'order', 'icon', 'status'];
	
    public function __construct(){
    	$this->table = Session::get('organization_id').'_menu_items';
    }
}
