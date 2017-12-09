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
 // public function commentable(){

 // 	return $this->morphTo();
 // }

 public function reply(){
 	return $this->hasMany('App\Model\Organization\Comment','reply_id','id');
 }

 public function like(){
 	return $this->hasMany('App\Model\Organization\LikeDislike','comment_id','id');//->where('status',1)->count();
 }

 
}
