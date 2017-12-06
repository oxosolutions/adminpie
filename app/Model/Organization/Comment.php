<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class Comment extends Model
{
 
 public function __construct(){
 	if(!empty(Session::get('organization_id')))
   		{
   			$this->table = Session::get('organization_id').'_comments';
   		}
 }
 public function commentable(){

 	return $this->morphTo();
 }
}