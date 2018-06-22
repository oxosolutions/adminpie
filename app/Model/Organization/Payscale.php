<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class Payscale extends Model
{
	public static $breadCrumbColumn = 'id';
    protected $fillable = ['title', 'description', 'currency', 'pay_cycle', 'pay_scale', 'basic_pay', 'grade_pay', 'ta', 'da', 'sa', 'hra', 'epf_addiction', 'epf_deducation', 'sa_details', 'total_salary', 'gross_salary'];
    
    public function __construct(){
    	if(!empty(get_organization_id())){
    		$this->table = get_organization_id().'_pay_scale';
    	}
    }

    public static function listing_payscale(){
    	return self::pluck('title','id');
    }

    public function user_meta()
    {
    	return $this->hasMany('App\Model\Organization\Payscale','value','id');
    }
}
