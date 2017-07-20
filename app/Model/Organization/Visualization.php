<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class Visualization extends Model
{
	public static $breadCrumbColumn = 'name';
    public function __construct(){

	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_visualizations';
	   	}
   }

   public function dataset(){

   		return $this->belongsTo('App\Model\Organization\Dataset','dataset_id','id');
   }

   public static function chartTypes(){

   		return [
   		
   			"ColumnChart" 	=> 	"Column Chart",
            "BarChart" 		=> 	"Bar Chart",
            "AreaChart" 	=> 	"Area Chart",
            "PieChart" 		=> 	"Pie Chart",
            "LineChart"		=> 	"line Chart",
            "CustomMap" 	=> 	"Custom Map",
            "TableChart" 	=> 	"Table chart",
            "ListChart" 	=> 	"List chart"
   		];
   }

   public static function formulas(){

      return [
            'no' => 'No Formula',
            'count' => 'Count',
            'addition' => 'Addition',
            'percent' => 'Percent'
      ];
   }

   public static function filterTypes(){

      return [
            'range' => 'Range',
            'dropdown' => 'Single Select',
            'mdropdown' => 'Multi Select'
      ];
   }


}
