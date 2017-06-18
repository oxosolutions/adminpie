<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ListOfHoliday extends Model
{
	use SoftDeletes;
    protected $fillable = ['date_of_holiday', 'title', 'holiday_status', 'status'];
    protected $softDelete = true;
    protected $dates = ['deleted_at'];

}

