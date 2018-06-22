<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Session;


class Holiday extends Model
{
	public static $breadCrumbColumn = 'title';
	public function __construct()
	{
		if(!empty(get_organization_id()))
		{
			$this->table = get_organization_id().'_holidays';
		}

					//$this->table = '32_holidays';
	}
	//use SoftDeletes;
    protected $fillable = ['title', 'description', 'date_of_holiday', 'status'];
    //protected $softDelete = true;
    //protected $dates = ['deleted_at'];

}

