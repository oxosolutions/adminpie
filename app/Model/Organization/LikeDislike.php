<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class LikeDislike extends Model
{
 
 public function __construct(){
 	if(!empty(get_organization_id()))
   		{
   			$this->table = get_organization_id().'_like_dislikes';
   		}
 }
 // public function commentable(){

 // 	return $this->morphTo();
 // }

 // public function comment(){

 // 	return $this->belongsTo();
 // }

 
}
