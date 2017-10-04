<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
	protected $table = 'global_pages';
   	protected $fillable = ['title','sub_title', 'slug', 'content', 'tags', 'categories', 'post_type', 'attachments', 'version', 'revision', 'created_by', 'post_status', 'status','type'];
}
