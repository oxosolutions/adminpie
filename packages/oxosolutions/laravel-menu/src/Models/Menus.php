<?php

namespace OxoSolutions\Menu\Models;

use Illuminate\Database\Eloquent\Model;
use Session;
use Auth;
class Menus extends Model
{
    protected $table = '_menus';

    public function __construct( array $attributes = [] ){
    	//parent::construct( $attributes );
    	// $this->table = config('menu.table_prefix') . $this->table;
    	$this->table = get_organization_id().$this->table;
    }
}
