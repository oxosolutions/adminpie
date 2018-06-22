<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class VisualizationMeta extends Model
{
    public function __construct(){

	   	if(!empty(get_organization_id()))
	   	{
	       $this->table = get_organization_id().'_visualization_meta';
	   	}
   }
}
