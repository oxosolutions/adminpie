<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class GlobalGroup extends Model
{
    protected $fillable = ['name','description','modules','status','created_by'];
    protected $table	= 'groups';

    public function group_list(){
    	return self::where('status',1)->pluck('name', 'id');
    }
    

}
