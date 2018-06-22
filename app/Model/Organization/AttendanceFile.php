<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class AttendanceFile extends Model
{
    public function __construct(){
    	if(!empty(get_organization_id())){
    		$this->table = get_organization_id().'_attendance_files';
    	}
    }
}
