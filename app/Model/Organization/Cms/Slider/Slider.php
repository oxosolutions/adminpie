<?php

namespace App\Model\Organization\Cms\Slider;

use Illuminate\Database\Eloquent\Model;
use Session;
class Slider extends Model
{
	protected $fillable = ['name', 'description','slug', 'slider', 'options', 'settings','status'];
    public function __construct(){
    	if(!empty(get_organization_id())){
			$this->table = get_organization_id().'_sliders';
    	}
    }
    public function listSlider()
    {
    	return self::pluck('name','id');
    }
}