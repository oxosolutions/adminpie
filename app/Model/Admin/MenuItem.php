<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable =['menu_id','page_id', 'label', 'description', 'title', 'class', 'title_attribute', 'link', 'target', 'type', 'parent', 'order', 'icon', 'status'];
    protected $table = 'global_menu_items';
}
