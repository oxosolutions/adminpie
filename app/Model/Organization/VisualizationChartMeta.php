<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class VisualizationChartMeta extends Model
{
    //public static $breadCrumbColumn = 'chart_title';
    public function __construct(){

	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_visualization_chart_meta';
	   	}
   }
}
