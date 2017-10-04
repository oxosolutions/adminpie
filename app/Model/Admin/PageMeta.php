<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class PageMeta extends Model
{
	protected $table	= 'global_page_metas';
	protected $fillable = ['page_id', 'key', 'value'];

    public function __construct()
    {
    }

    public function MenuList(){
        return $this->belongsTo('App\Model\Organization\Cms\Menu\Menu','page_id','id');
    }
}
