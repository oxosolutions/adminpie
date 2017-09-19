<?php

namespace App\Model\Organization\Cms\Menu;

use Illuminate\Database\Eloquent\Model;
use Session;
class MenuSetting extends Model
{
	protected $fillable =[ 'menu_id', 'key', 'value'];
   public function __construct(){
   	if(!empty(Session::get('organization_id'))){

   		$this->table = Session::get('organization_id')."_menu_settings"
   	}
   }
}
