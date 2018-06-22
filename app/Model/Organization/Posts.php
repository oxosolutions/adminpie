<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class Posts extends Model
{
    public static $breadCrumbColumn = 'id';
   	public function __construct()
   	{
   		if(!empty(get_organization_id()))
   		{
   			$this->table = get_organization_id().'_pages';
   		}
   	}

   	protected $fillable = ['title','sub_title', 'slug', 'content', 'tags', 'categories', 'post_type', 'attachments', 'version', 'revision', 'created_by', 'post_status', 'status','type'];
}
