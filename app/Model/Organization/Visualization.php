<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;
use App\Model\Admin\CustomMaps;
class Visualization extends Model
{
   protected $fillable= ['dataset_id','name','description','created_by'];
	public static $breadCrumbColumn = 'name';
    public function __construct(){

	   	if(!empty(get_organization_id()))
	   	{
	       $this->table = get_organization_id().'_visualizations';
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
            "ListChart" 	=> 	"List chart",
            "NumberChart"   =>  "Number Chart"
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

   public function meta(){

      return $this->hasMany('App\Model\Organization\VisualizationMeta','visualization_id','id');
   }

   public function charts(){

      return $this->hasMany('App\Model\Organization\VisualizationCharts','visualization_id','id');
   }

   public static function getXColumns(){
      $id = request()->route()->parameters()['id'];
      $charts = VisualizationCharts::with(['meta'])->where('visualization_id',$id)->get();
      $model = Visualization::with(['dataset','meta'])->find($id);
      $dataset = DB::select('SELECT * FROM ocrm_'.str_replace('ocrm_','',$model->dataset->dataset_table).' LIMIT 1');
      $dataset = (array)$dataset[0];
      unset($dataset['id']);
      unset($dataset['status']);
      unset($dataset['parent']);
      $columns = $dataset;
      return $columns;
   }

   public static function getYColumns(){
      $id = request()->route()->parameters()['id'];
      $charts = VisualizationCharts::with(['meta'])->where('visualization_id',$id)->get();
      $model = Visualization::with(['dataset','meta'])->find($id);
      $dataset = DB::select('SELECT * FROM ocrm_'.str_replace('ocrm_','',$model->dataset->dataset_table).' LIMIT 1');
      $dataset = (array)$dataset[0];
      unset($dataset['id']);
      unset($dataset['status']);
      unset($dataset['parent']);
      $columns = $dataset;
      return $columns;
   }

   public static function mapsList(){
      $maps = CustomMaps::get();
      return $maps;
   }

   public static function visualizationList(){
        return self::pluck('name','id');
   }


}
