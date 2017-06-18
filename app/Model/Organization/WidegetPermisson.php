<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class WidegetPermisson extends Model
{
	public function __construct()
	{
		if(!empty(Session::get('organization_id')))
		{
			$this->table = Session::get('organization_id')."_widget_permissons";
		}
	}
    protected $fillable =['role_id', 'widget_id', 'permisson'];

    public function widget()
    {
    	return $this->belongsTo('App\Model\Admin\GlobalWidget', 'widget_id','id');
	}
}
