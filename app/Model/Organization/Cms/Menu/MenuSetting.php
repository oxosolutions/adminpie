<?php

namespace App\Model\Organization\Cms\Menu;

use Illuminate\Database\Eloquent\Model;
use Session;
class MenuSetting extends Model
{
	protected $fillable =[ 'menu_id', 'key', 'value'];
   public function __construct(){
   	if(!empty(get_organization_id())){

   		$this->table = get_organization_id()."_menu_settings"
   	}
   }
}
