<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class AttendanceFile extends Model
{
    public function __construct(){
    	if(!empty(Session::get('organization_id'))){
    		$this->table = Session::get('organization_id').'_attendance_files';
    	}
    }
}
