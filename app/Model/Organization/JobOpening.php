<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class JobOpening extends Model
{
   public static $breadCrumbColumn = 'id';
   public function __construct()
   {	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_openings';
	   	}
   }
   protected $fillable = [  'title', 'department', 'designation', 'skills', 'job_type', 'location', 'number_of_post', 'minimum_qualification', 'experience_month', 'experience_year', 'working_day', 'working_hour', 'office_hour_start', 'office_hour_end', 'package_type', 'minimum_package', 'maximum_package', 'minimum_age_for_apply', 'maximum_age_for_apply', 'interview_mode', 'opening_open', 'opening_close', 'email', 'phone', 'hr_name', 'description'];
}
