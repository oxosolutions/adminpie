<?php

namespace OxoSolutions\Menu\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Auth;
class MenuItems extends Model
{


	/*public function __construct( array $attributes = [] ){
    	//parent::construct( $attributes );
    	$this->table = config('menu.table_prefix') . $this->table;
    }*/
    public function __construct( array $attributes = [] ){
    	// dd(Session::get('organization_id').'_menu_items');
    	$this->table = Session::get('organization_id').'_menu_items';
    }

    public function getsons($id) {
		return $this -> where("parent", $id) -> get();
	}
	public function getall($id) {
		return $this -> where("menu", $id) -> orderBy("sort", "asc") -> get();
	}
}
