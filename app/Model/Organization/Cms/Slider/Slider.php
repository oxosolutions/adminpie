<?php

namespace App\Model\Organization\Cms\Slider;

use Illuminate\Database\Eloquent\Model;
use Session;
class Slider extends Model
{
	protected $fillable = ['name', 'description','slug', 'slider', 'options', 'settings','status'];
    public function __construct(){
    	if(!empty(Session::get('organization_id'))){
			$this->table = Session::get('organization_id').'_sliders';
    	}
    }
}