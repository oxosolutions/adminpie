<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeLeave extends Model
{
    use SoftDeletes;
    Protected $dates = ['deleted_at'];
    Protected $softDeletes =true;
    Protected $fillable = ['employee_id', 'total_day_of_leave', 'from', 'to', 'reason_of_leave', 'description'];


}
