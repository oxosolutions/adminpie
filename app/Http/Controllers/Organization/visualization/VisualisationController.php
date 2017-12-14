<?php

namespace App\Http\Controllers\Organization\visualization;

use Illuminate\Http\Request;
use App\Model\Organization\Visualization;
use Auth;
use App\Model\Organization\Dataset as DL;
use Session;
use DB;
use Carbon\Carbon AS TM;
use Lava;
use Excel;
use App\Http\Controllers\Controller;
use App\Model\Admin\CustomMaps;
use App\Model\Organization\VisualizationCharts;
use App\Model\Organization\VisualizationChartMeta;
use App\Model\Organization\VisualizationMeta;
use File;
use Validator;
class VisualisationController extends Controller
{
	protected $ipAdress;
	protected $errors_list = [];
	public function __construct(Request $request)
	{ 
	  $this->ipAdress =  $request->ip();
	  DB::enableQueryLog();  
	}


	

	public function index(Request $request){
		
		if($request->has('per_page')){
            $perPage = $request->per_page;
            if($perPage == 'all'){
              $perPage = 999999999999999;
            }
          }else{
            $perPage = get_items_per_page();;
          }
          $sortedBy = @$request->sort_by;
          if($request->has('search')){
              if($sortedBy != ''){
                  $model = Visualization::with(['dataset'])->where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                  $model = Visualization::with(['dataset'])->where('name','like','%'.$request->search.'%')->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = Visualization::with(['dataset'])->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                   $model = Visualization::with(['dataset'])->orderBy('id','DESC')->paginate($perPage);
              }
          }
          // dd($model);
          $datalist =  [
                          'datalist'=>$model,
                          'showColumns' => ['name'=>'Name', 'dataset.dataset_name' => 'Dataset','description'=>'Description','created_by'=>'Created By','created_at'=>'Created'],
                          'actions' => [
                                          'view' => ['title'=>'View','route'=>'visualization.view','class' => 'edit'],
                                          'edit' => ['title'=>'Edit','route'=>'edit.visualization','class' => 'edit'],
                                          'setting' => ['title'=>'Settings','route'=>'setting.visualization','class' => 'edit'],
                                          'collaborate' => ['title'=>'Collaborate ','route'=>'collaborate.visualization','class' => 'edit'],
                                          'customize' => ['title'=>'Customize ','route'=>'customize.visualization','class' => 'edit'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.visualization']
                                       ]
                      ];
		return view('organization.visualization.list',$datalist);

	}

	public function store(Request $request){
		$this->modelValidate($request);
		DB::beginTransaction();
		try{

			$model = new VS();
			$model->fill($request->except(['_token']));
			$model->created_by = Auth::user()->id;
			$model->save();
            $metaModel = new VisualizationMeta;
            
			DB::commit();
			Session::flash('success','Successfully created!');
			return redirect()->route('visualisation.list');
		}catch(\Exception $e){

			DB::rollback();

			throw $e;
		}
	}


	protected function modelValidate($request){

		$rules = [
				'dataset_id'  => 'required',
				'visual_name' => 'required',
				'settings'    => 'required',
				'options'     => 'required'
		];

		$this->validate($request,$rules);
	}

	/**
	 * Visualization edit charts
	 * @param  [integer] $id [visualization id]
	 * @return [type]  rendered view
	 * @author Rahul
	 */
	public function edit($id){
		$charts = VisualizationCharts::with(['meta'])->where('visualization_id',$id)->get();
		$model = Visualization::with(['dataset','meta'])->find($id);
		if($model->dataset == null){
			return error(['message'=>'No dataset found','link'=>'visualizations']);
		}
		$dataset = DB::select('SELECT * FROM ocrm_'.str_replace('ocrm_','',$model->dataset->dataset_table).' LIMIT 1');
		$dataset = (array)$dataset[0];
		unset($dataset['id']);
		$columns = $dataset;
		$maps = CustomMaps::get();
		$filters = $this->getMetaValue($model->meta,'filters');
		if($filters == false){
			$filters = [];
		}
		$chartsModel = $this->re_arrangeMeta($charts, $model);
		return view('organization.visualization.edit2',['columns'=>$columns,'chartsModel'=>$chartsModel, 'filters'=>$filters,'model'=>$model]);
	}


	/**
	 * will manupulate the meta data and prepare array
	 *
	 * @return array of charts
	 * @author Rahul
	 **/
	protected function re_arrangeMeta($charts, $model){
		$chartsModel = [];
        $index = 0;
        foreach($charts as $key => $chart){
            $chartsModel['available_chart'][$index]['chart_title'] = $chart->chart_title;
            $chartsModel['available_chart'][$index]['chart_type'] = $chart->chart_type;
            $chartsModel['available_chart'][$index]['variable_x_axis'] = $chart->primary_column;
            $chartsModel['available_chart'][$index]['variable_y_axis'] = json_decode($chart->secondary_column);
            $chartsModel['available_chart'][$index]['chart_id'] = $chart->id;
            $formula = $chart->meta->where('key','formula');
            $width = $chart->meta->where('key','chartwidth');

            $maparea = $chart->meta->where('key','maparea');
            $viewdata = $chart->meta->where('key','viewdata');
            $customdata = $chart->meta->where('key','customdata');
            $tooltip_data = $chart->meta->where('key','tooltip_data');
            $area_code = $chart->meta->where('key','area_code');
            if(!$viewdata->isEmpty()){
            	$chartsModel['available_chart'][$index]['viewdata'] = $viewdata->first()->value;
            }
            if(!$maparea->isEmpty()){
            	$chartsModel['available_chart'][$index]['maparea'] = $maparea->first()->value;
            }
            if(!$customdata->isEmpty()){
            	$chartsModel['available_chart'][$index]['customdata'] = json_decode($customdata->first()->value);
            }
            if(!$tooltip_data->isEmpty()){
            	$chartsModel['available_chart'][$index]['tooltip_data'] = json_decode($tooltip_data->first()->value);
            }
            if(!$formula->isEmpty()){
                $chartsModel['available_chart'][$index]['formula'] = $formula->first()->value;
            }
            if(!$width->isEmpty()){
                $chartsModel['available_chart'][$index]['chartwidth'] = $width->first()->value;
            }
            if(!$area_code->isEmpty()){
                $chartsModel['available_chart'][$index]['area_code'] = $area_code->first()->value;
            }
            $index++;
        }
        $index = 0;
        if(!$model->meta->isEmpty()){
            $filters = $model->meta->where('key','filters');
            if(!$filters->isEmpty()){
                $filtersArray = json_decode($filters->first()->value);
                foreach($filtersArray as $key => $filter){
                    $chartsModel['filters'][$index]['filter_columns'] = $filter->column;
                    $chartsModel['filters'][$index]['filter_type'] = $filter->type;
                    $index++;
                }
            }
        }
        return $chartsModel;
	}

	public function update(Request $request, $id){
		$model = VS::findOrFail($id);

		$this->modelValidate($request);

		DB::beginTransaction();

		try{

			$model->fill($request->except(['_token']));
			$model->save();
			DB::commit();
			Session::flash('success','Successfully update!!');
			return redirect()->route('visualisation.list');
		}catch(\Exception $e){

			DB::rollback();
			throw $e;
		}
	}

	public function destroy($id){

		$model = VS::findOrFail($id);

		try{

			$model->delete();
			Session::flash('success','Successfully deleted!');
			return redirect()->route('visualisation.list');
		}catch(\Exception $e){

			throw $e;
		}
	}

	/************************************************************ Complete Visualization Work ********************************************************/

	/*
	* Called internally from craeteVisualization to validate requqest
	* @param $request
	* return JSON to API
	*/
	protected function validateRequest($request){

        if($request->has('dataset') && $request->has('visual_name')){
            return ['status'=>'true','errors'=>''];
        }else{
            return ['status'=>'false','error'=>'Fill required fields!'];
        }
    }

    public function get_visualization_by_dataset($datasetid){
    	$model = Visualisation::where('dataset_id',$datasetid)->get();
    	return ['status'=>'success','list'=>$model];
    }

    protected function validateVisualizationRequest($request){
    	$rules = [
    		'name' => 'required',
    		'dataset_id' => 'required'
    	];

    	$this->validate($request,$rules);
    }

    /*
    * Used in Smaart Framework Api index.api.js to create new visualization
    * @param $request (posted request)
    * return JSON to API
    */
	public function createVisualization(Request $request)
	{		
		$this->validateVisualizationRequest($request);
        try{
            $model = new Visualization();
            $model->dataset_id = $request->dataset_id;
            $model->name = $request->name;
            $model->description = $request->description;
            $model->created_by = Auth::guard('org')->User()->id;
            $model->save();
            $metaArray = [
                'enable_header' => '1',
                'enable_copyright' => '0',
                'enable_chart_title' => '1',
                'enable_filters' => '1',
                'filter_position' => 'right',
                'show_topbar' => '1',
                'show_loading_animation' => '0',
                'show_footer' => '0'
            ];
            foreach($metaArray as $key => $value){
                $metaModel = new VisualizationMeta;
                $metaModel->visualization_id = $model->id;
                $metaModel->key = $key;
                $metaModel->value = $value;
                $metaModel->save();
            }
        }catch(\Exception $e){
        }
        Session::flash('success','Successfully created!');
        return redirect()->route('visualizations');
	}



	/*
	* Used to update visualization details like chart data and meta
	* @param $request (posted request)
	* return JSON to API
	*/
	public function saveCharts(Request $request, $visualization_id){
		$validator = Validator::make($request->all(),['available_chart'=>'required']);
		foreach ($request->available_chart as $key => $chart) {
			if($chart['chart_title'] == null || $chart['chart_title'] == ''){
				$validator->errors()->add('available_chart['.$key.'][chart_title]','Chart title is required!');
			}
			if($chart['chart_type'] == null || $chart['chart_type'] == ''){
				$validator->errors()->add('available_chart['.$key.'][chart_type]','Chart type is required!');
			}
			if($chart['variable_x_axis'] == null || $chart['variable_x_axis'] == ''){
				$validator->errors()->add('available_chart['.$key.'][variable_x_axis]','Variable x-axis is required!');
			}
			if($chart['variable_y_axis'] == null || $chart['variable_y_axis'] == '' || empty($chart['variable_y_axis']) || @$chart['variable_y_axis'][0] == null){
				$validator->errors()->add('available_chart['.$key.'][variable_y_axis]','Variable y-axis is required!');
			}
		}
		if(!$validator->errors()->isEmpty()){
			return redirect()->back()->withInput()->withErrors($validator->errors())->with(['chartsModel'=>$request->all()]);
		}

		$available_chart = array_values($request->available_chart);
		$chartToNotDelete = [];
		for($chartCount = 0; $chartCount < count($available_chart); $chartCount++){
			
			$visualization_chart = $this->createChart($request, $available_chart[$chartCount], $chartCount, $visualization_id);
			$chartToNotDelete[] = $visualization_chart->id;
			$this->createMeta($request, $available_chart[$chartCount], $chartCount, $visualization_chart, $visualization_id);
		}
		if($request->has('filters')){
			$visualizationMeta = VisualizationMeta::where(['visualization_id'=>$visualization_id,'key'=>'filters'])->first();
			if($visualizationMeta == null){
				$visualizationMeta = new VisualizationMeta;
			}
			$visualizationMeta->visualization_id = $visualization_id;
			$visualizationMeta->key = 'filters';
			$filters = [];
			for($filterCount = 0; $filterCount < count($request->filters); $filterCount++){
				$filters['filter_'.$filterCount] = ['type'=>$request->filters[$filterCount]['filter_type'],'column'=>$request->filters[$filterCount]['filter_columns']];
			}
			$visualizationMeta->value = json_encode($filters);
			$visualizationMeta->save();
		}
		$this->deleteCharts($chartToNotDelete,$visualization_id);
		Session::flash('success','Charts saved successfully!');
		return back();
	}

	protected function deleteCharts($chartIds,$visualization_id){
		$model = VisualizationCharts::whereNotIn('id',$chartIds)->where('visualization_id',$visualization_id)->with(['meta'=>function($query){
			$query->delete();
		}])->delete();
	}

	public function saveVisualizationSettings(Request $request, $id){
		$settings = $request->except(['_token']);
		foreach($settings as $key => $value){
			$model = VisualizationMeta::firstOrNew(['key'=>$key,'visualization_id'=>$id]);
			$model->key = $key;
			$model->value = ($value == null)?'':$value;
			$model->visualization_id = $id;
			$model->save();
		}
		return back();
	}

	protected function createMeta($request, $chartData, $chartCount, $visualization_chart, $visualization_id){
		//Unsetting Data From Array
		$chartId = $chartData['chart_id'];
		$metaData = $chartData;
		unset($metaData['chart_title']);unset($metaData['variable_x_axis']);unset($metaData['variable_y_axis']);unset($metaData['chart_type']);unset($metaData['_token']);unset($metaData['filter_columns']);unset($metaData['filter_type']);unset($metaData['chart_id']);
		
		foreach ($metaData as $chart_meta_key => $chart_meta_value) {
			if($chartId != ''){
				$visualization_chart_meta = VisualizationChartMeta::where(['visualization_id'=>$visualization_id,'chart_id'=>$chartId,'key'=>$chart_meta_key])->first();
				if($visualization_chart_meta == null){
					$visualization_chart_meta = new VisualizationChartMeta();
				}
			}else{
				$visualization_chart_meta = new VisualizationChartMeta();
			}
			$visualization_chart_meta->visualization_id = $visualization_id;
			$visualization_chart_meta->chart_id = $visualization_chart->id;
			$visualization_chart_meta->key = $chart_meta_key;
			if(is_array($chart_meta_value)){
				$chart_meta_value = json_encode($chart_meta_value);
			}else{
				$chart_meta_value = $chart_meta_value;
			}
			$visualization_chart_meta->value = $chart_meta_value;
			
			$visualization_chart_meta->save();
		}
	}

	protected function createChart($request, $chartData, $chartCount, $visualization_id){
		if($chartData['chart_id'] != ''){
			$visualization_chart = VisualizationCharts::find($chartData['chart_id']);
		}else{
			$visualization_chart = new VisualizationCharts();
		}
		$chartType = $chartData['chart_type'];
		$visualization_chart->visualization_id = $visualization_id;
		$visualization_chart->chart_title = ($chartData['chart_title'] == null || $chartData['chart_title'] == '')?'(no title)':$chartData['chart_title'];
		$primaryColumn = ($chartType == 'CustomMap')?@$chartData['area_code']:@$chartData['variable_x_axis'];
		$primaryColumn = $primaryColumn;
		$visualization_chart->primary_column = ($primaryColumn != null)?$primaryColumn:'{}';
		$visualization_chart->secondary_column = ($chartType == 'CustomMap')?json_encode(@$chartData['tooltip_data']):json_encode(@$chartData['variable_y_axis']);
		$visualization_chart->chart_type = (@$chartData['chart_type'] != null && $chartData['chart_type'] != '')?@$chartData['chart_type']:'not defined';
		$visualization_chart->status = 'true';
		$visualization_chart->save();
		return $visualization_chart;
	}

	/*
	* To display pre-filled details in edit visualization 
	* $param $id (visualization id)
	* return JSON to API
	*/
	public function visualization_details($id){
		try{
			$model = Visualisation::with(['dataset','charts','meta','chart_meta'])->find($id);
			$dataset_table = $model->dataset->dataset_table; //get dataset table name from visualization table with relation (with('dataset'))
			$dataset_model = DB::table($dataset_table)->first();
        	unset($dataset_model->id);
        	$responseArray = [];
        	$responseArray['dataset_columns'] = (array)$dataset_model;
        	$charts = [];
        	$chartIndex = 0;
        	if(!$model->charts->isEmpty()){
        		foreach($model->charts as $chart_key => $chart_value){
        			$charts[$chartIndex]['title'] = $chart_value->chart_title;
        			$charts[$chartIndex]['column_one'] = $chart_value->primary_column;
        			$charts[$chartIndex]['columns_two'] = json_decode($chart_value->secondary_column);
        			$charts[$chartIndex]['chartType'] = $chart_value->chart_type;
        			$chart_meta = VisualizationChartMeta::where('chart_id',$chart_value->id)->get();
        			if(!$chart_meta->isEmpty()){
        				foreach($chart_meta as $meta_key => $chart_meta_value){
        					json_decode($chart_meta_value->value);
        					if(json_last_error() == JSON_ERROR_NONE){
        						$charts[$chartIndex][$chart_meta_value->key] = json_decode($chart_meta_value->value);
        					}else{
        						$charts[$chartIndex][$chart_meta_value->key] = $chart_meta_value->value;
        					}
        				}
        			}
        			$chartIndex++;
        		}
        	}
        	
        	$responseArray['charts'] = $charts; // gettings all chart of this visualizaton with 'hasMany' eloquent relation
        	$responseArray['visualization_meta'] = [];
        	if(!$model->meta->isEmpty()){
        		foreach($model->meta as $key => $meta_data){
        			$responseArray['visualization_meta'][$meta_data->key] = $meta_data->value; //get all visualization_meta data from relation
        		}
        	}
        	$responseArray['maps'] = [
        								'organization_maps'=>Map::select(['id','title'])->where('status','enable')->get(),
        								'global_maps'=>GMap::select(['id','title'])->where('status','enable')->get()
        							];
        	$responseArray['chart_settings'] = GlobalSetting::where('meta_key','visual_setting')->first()->meta_value;
        	return ['status'=>'success','data'=>$responseArray];
		}catch(\Exception $e){
			return ['status'=>'error','message'=>$e->getMessage()];
		}
	}

	public function visualization_list(){

		$responseArray = [];
		$model = Visualisation::with('dataset')->get();
		foreach ($model as $key => $value) {
			$responseArray['visuals'][] = $value;
			$responseArray['dataset'][] = $value->dataset;
		}
		return ['status'=>'success','list'=>$responseArray];
	}

	public function delete_visualization($visualization_id){
		
		Visualization::where('id',$visualization_id)->delete();
		Session::flash('success','Successfully Deleted!');
		return back();
		/*$visual = Visualisation::where('id',$visualization_id)->with([
			'charts'=>function($query) use ($visualization_id){
				$query->where('visualization_id',$visualization_id)->forceDelete();
		},
			'chart_meta'=>function($query) use ($visualization_id){
				$query->where('visualization_id',$visualization_id)->delete();
		},
			'meta'=>function($query) use ($visualization_id){
				$query->where('visualization_id',$visualization_id)->delete();
		}])->forceDelete();

		return ['status'=>'success','message'=>'Visualization deleted successfully!'];*/
	}

	public function generateEmbed(Request $request){
        $user = Auth::user();
        $org_id = $user->organization_id;
        $exist = Embed::where(['user_id'=>$user->id,'visual_id'=>$request->visual_id])->first();
        if($exist == null){
            $model = new Embed;
            $embed_token = str_random(20);
            $model->visual_id = $request->visual_id;
            $model->org_id  = $org_id;
            $model->user_id = $user->id;
            $model->embed_token = $embed_token;
            $model->save();
        }else{
            $embed_token = $exist->embed_token;
        }

        return ['status'=>'success','message'=>'Successfully generated!','token'=>$embed_token];
    }

	protected function put_in_errors_list($error = '', $break = false){
		array_push($this->errors_list, $error);
		if($break == true){
			echo view('organization.visualization.errors',['errors'=>$this->errors_list])->render(); // load error view
			// echo view('web_visualization.errors',['errors'=>$this->errors_list])->render(); // load error view
			die;
		}else{
			echo view('organization.visualization.errors',['errors'=>$this->errors_list])->render(); // load error view
			// echo view('web_visualization.errors',['errors'=>$this->errors_list])->render(); // load error view
			return true;
		}
	}

	protected function getMetaValue($metaArray, $metaKey){
		$metaArray = collect($metaArray);
		$metaData = $metaArray->where('key',$metaKey);
		$metaValue = false;
		foreach($metaData as $key => $value){
			$metaValue = $value->value;
		}
		return $metaValue;
	}

	protected function get_meta_in_correct_format($visualMetas){
		$visualMetas = json_decode(json_encode($visualMetas),true);
		$valueColumns = array_column($visualMetas, 'value');
		$keyColumns = array_column($visualMetas, 'key');
		return array_combine($keyColumns,$valueColumns);
	}

	public function getFIlters($table, $columns, $columnNames){
        $data = [];
        $columnsWithType = $columns;
        $columns = (array)$columns;
        $columns = array_column($columns, 'column');
        if($columns[0] == null){
        	return [];
        }
        $resultArray = [];
        $model = DB::table($table)->select($columns)->get()->toArray();
        if(!empty($model)){
            unset($model[0]);
        }
        // dd($model[0]);
        $tmpAry = [];
        $max =0;
        foreach($model as $k => $v){
            
            $tmpAry[] = (array)$v;
        }
        $index = 0;
        foreach($columns as $key => $value){           
            $filter = [];
            if($columnsWithType['filter_'.$index]['type'] == 'range'){
               
                $allData = array_column($tmpAry, $value);
                $min = min($allData);
                $max = max($allData);
                $filter['column_name'] = $columnNames[$value];
                $filter['column_min'] = (int)$min;
                $filter['column_max'] = (int)$max;
                $filter['column_type'] = $columnsWithType['filter_'.$index]['type'];
            }else{
                $filter['column_name'] = $columnNames[$value];
                $filter['column_data'] = array_unique(array_column($tmpAry, $value));
                $filter['column_type'] = $columnsWithType['filter_'.$index]['type'];
            }
            $index++;
            $data[$value] = $filter;
        }
        return $data;
    }

    protected function apply_filters($request, $dataset_table, $columns){
    	/* 
    	* Sample data array of filters
    	* 
    	*array:2 [▼
		*  "singledrop" => array:1 [▼
		*    0 => array:1 [▼
		*      "column_3" => array:1 [▼
		*        0 => "Designing"
		*      ]
		*    ]
		*  ]
		*  "multipledrop" => array:1 [▼
		*    0 => array:1 [▼
		*      "column_4" => array:2 [▼
		*        0 => "Senior"
		*        1 => "Junior"
		*      ]
		*    ]
		*  ]
		*]
		*/
    	$filterColumns = [];
    	$filterRanges = [];
    	$requested_filters = $request->except(['_token','applyFilter']);
    	$filterKeys = ['dropdown','mdropdown','checkbox','radio'];
    	foreach ($filterKeys as $key) { // $key contains filters key --> singledrop, multidrop etc
    		if(array_key_exists($key, $requested_filters)){ // check if the specific key exist in requested filters
    			foreach ($requested_filters[$key] as $k => $column) { // if key exist in request filter then get that all columns of that key
    				foreach($column as $columnName => $columnValue){
    					// array_filter removing all empty values from $columnValue, in case if user selected "All" in filters
    					$filterColumns[$columnName] = array_filter($columnValue); // create a single array of all selected filters columns
    				}
    			}
    		}
    	}
    	if($request->has('range')){
    		foreach ($request->range as $k => $column) { // if key exist in request filter then get that all columns of that key
				foreach($column as $columnName => $columnValue){
					$exploded_date = explode(';', $columnValue);
					$filterRanges[$columnName] = $exploded_date;
				}
			}
    	}
    	$with_whereIn = false; // with_whereId for check the status if whereIn added in query or not
    	$db = DB::table($dataset_table);
    	foreach($filterColumns as $columnName => $columnsData){
    		if(!empty($columnsData)){ // if $columnData array is empty that means user selected "All" in this filter, so we do not need to add in "whereIn" clause
    			$db->whereIn($columnName, $columnsData); // will create multiple "where in" clause in query 
    			$with_whereIn = true; // set status true if query have where in clause
    		}
    	}
    	if(!empty($filterRanges)){
    		foreach($filterRanges as $column => $values){
    			$db->whereBetween($column, $values);
    		}
    	}
    	if($with_whereIn == true){ // if there is whereIn clause then we need to get the id row also, otherwise select all data from table 
    		$db->orWhere('id',1); // for also get the columns header we need to get first record from datatable
    	}

    	// Finaly it will generate query: "select * from `126_data_table_1495705270` where `column_3` in (?) and `column_4` in (?, ?) or `id` = ?"
    	// dd($db->toSql());
    	return $db->select($columns)->whereIn('status',['status',1])->whereIn('parent',['parent',0])->get()->toArray(); // return final query result in the form or array
    	
    }

   
    protected function getSVGMaps($chartMeta){
    	$map = '';
    	$mapId = $this->getMetaValue($chartMeta,'maparea');
    	$model = CustomMaps::find($mapId);
    	return $model->map_data;
    }

    protected function apply_formula($records, $formula){
    	$records_array = [];
		foreach(json_decode(json_encode($records),true) as $record){ // convert associative array into indexd array
			$records_array[] = array_values($record);
		}
    	if($formula == 'count'){
    		
    		$collection = collect($records_array); // convert simple array to laravel collection
    		$countedArray = [];
    		$index = 0;
    		foreach($collection->groupBy(0) as $key => $value){ // getting data from collection with group by first column or primary column
    			$countedArray[$index][] = $key;
    			$countedArray[$index][] = $value->count();
    			$index++;
    		}
    		return $countedArray;
    	}
    	if($formula == 'addition'){
    		$collection = collect($records_array); // convert simple array to laravel collection
    		$recordsToSum = count(json_decode(json_encode($records[0]),true))-1;
			$preparedArray = [];
			$headers = $collection->pull(0); // get headers from collection
			$index = 0;
			foreach ($collection->groupBy(0) as $key => $value) {
				for($i = 1; $i <= $recordsToSum; $i++){ // recordsToSum contain that how much secondory columns we have selected 
					if($i == 1){
						$preparedArray[$index][] = $key;
					}
					$preparedArray[$index][] = $value->sum($i);
				}
				$index++;
			}
    		$records_array = collect($preparedArray);
    		$records_array->prepend($headers);
    		return $records_array;
    	}

    	if($formula == 'percent'){
    		$columns = count($records_array[0])-1;
    		$collection = collect($records_array);
    		$records_total_array = [];
    		for($i = 1; $i <= $columns; $i++){
    			$records_total_array[$i] = $collection->sum($i);
    		}
    		$headers = $collection->pull(0);
    		$records_array = [];
    		foreach($collection as $key => $value){
    			$tempArray = [];
    			foreach($value as $k => $v){
    				if(array_key_exists($k, $records_total_array)){
    					$tempArray[] = ($v*100)/$records_total_array[$k];
    				}else{
    					$tempArray[] = $v;
    				}
    			}
    			$records_array[] = $tempArray;
    		}
    		$records_array = collect($records_array);
    		$records_array->prepend($headers);
    		return $records_array;
    	}
    }

    protected function string_number_to_numeric($array_data){
    	$array_data = $array_data['chart_settings'];
    	//dd($array_data);
    	unset($array_data['forceIFrame']);
    	unset($array_data['areaOpacity']);
    	unset($array_data['enableInteractivity']);
    	unset($array_data['keepAspectRatio']);
    	unset($array_data['colorAxis']);
    	unset($array_data['sizeAxis']);
    	if(!empty($array_data)){
    		
    		$settings_array = [];
    		foreach($array_data as $key => $value){
    			if(is_array($value)){
    				foreach($value as $k => $v){
    					if(is_numeric($v)){
		    				$settings_array[$key][$k] = (int)$v;
		    			}else{
		    				$settings_array[$key][$k] = $v;
		    			}
    				}
    			}else{
    				if(is_numeric($value)){
	    				$settings_array[$key] = (int)$value;
	    			}else{
	    				if($key == 'colors'){
	    					$explodeColor = explode(',',$value);
	    					$settings_array[$key] = $explodeColor;
	    				}elseif($key == 'legend'){
	    					$legendArray = [];
	    					$legendArray['position'] =  $value;
	    					$settings_array[$key] = $legendArray;
	    				}elseif($key == 'backgroundColor'){
	    					$settings_array[$key] = (array)$value;
	    				}elseif($key == 'isStacked'){
	    					$settings_array[$key] = ($value == 'true')?true:false;
	    				}else{
	    					$settings_array[$key] = ($value != '')?$value:0;
	    				}
	    			}
    			}
    		}
    		return $settings_array;
    		// dd($settings_array);
    	}else{
    		return [];
    	}
    }

	public function embedVisualization(Request $request){

		$visualization = Visualization::with([

		'dataset','charts'=>function($query){

				$query->with('meta');

		},'meta'])->find($request->id); //getting dataset, visualization charts and meta from eloquent relations

		if($visualization->charts->isEmpty()){ //if there is not chart exist in generated visualization

			$this->put_in_errors_list('No charts found!', true);
		}

		if(empty($visualization->dataset)){

			$this->put_in_errors_list('No dataset found', true);
		}
		$dataset_table = str_replace('ocrm_', '', $visualization->dataset->dataset_table); //getting dataset table name from visualization query
		$drawer_array = [];
		$chartTitles = [];
		$javascript = [];
		$visualization_settings = [];
		$drawer_array['visualization_name'] = $visualization->name;
		$drawer_array['visualization_id'] = $visualization->id;
		$drawer_array['visualization_meta'] = $this->get_meta_in_correct_format($visualization->meta);
		$drawer_array['visualizations'] = [];
		foreach ($visualization->charts as $key => $chart) {
			$columns = [];
			$columns[] = $chart->primary_column;
			foreach(json_decode($chart->secondary_column) as $column){
				$columns[] = $column;
			}
			if($chart->chart_type == 'CustomMap'){

				$viewData_meta = $this->getMetaValue($chart->meta,'viewdata');
				$customData_meta = json_decode($this->getMetaValue($chart->meta,'customdata'));

				if($viewData_meta != false){
					$columns[] = $viewData_meta;
				}
				if(!empty($customData_meta)){
					foreach ($customData_meta as $customColumn) {
						$columns[] = $customColumn;
					}
				}
				$columns = array_unique($columns);
			}

			try{
				/*
				*	if request has any filter
				*/
				if($request->has('applyFilter')){
					$dataset_records = $this->apply_filters($request, $dataset_table, $columns);
				}else{
					$dataset_records = DB::table($dataset_table)->select($columns)->whereIn('status',['status',1])->orWhereIn('parent',['parent',1])->get()->toArray(); //getting records with selected columns from dataset table
				}
				$formula = $this->getMetaValue($chart->meta,'formula');
				if($formula != 'no' && $formula != false){
					$dataset_records = $this->apply_formula($dataset_records, $formula);
				}
				$dataset_records = json_decode(json_encode($dataset_records),true); // generating pure array from colection of stdClass object

				$headers = array_shift($dataset_records);
				if($chart->chart_type != 'CustomMap'){
					$lavaschart = Lava::DataTable();
					$index = 0;
					foreach ($headers as $header) { // to add headers into lavacharts datatable
						if($index == 0){
							$lavaschart->addStringColumn($header); //for string header
						}else{
							if($chart->chart_type == 'TableChart'){
								$lavaschart->addStringColumn($header); //for string header
							}else{
								$lavaschart->addNumberColumn($header); //for all numeric headers
							}
						}
						$index++;
					}
				}

				$records_array = [];
				foreach($dataset_records as $record){ // convert associative array into indexd array
					$records_array[] = array_values($record);
				}
				if(!empty($records_array)){ // if after filter or without filter there is no data in records list
					if(!in_array($chart->chart_type, ['CustomMap','ListChart'])){
						$lavaschart->addRows($records_array); // lavachart add only indexed array of arrays (inserting multiple rows in to lavacharts datatable)
						$visualization_settings = $this->getMetaValue($chart->meta,'chart_settings');

						if(!empty($visualization_settings) && $visualization_settings != false){
							$visualization_settings = $this->string_number_to_numeric(json_decode($visualization_settings,true));
						}else{
							$visualization_settings = [];
						}
						lava::{$chart->chart_type}('chart_'.$key,$lavaschart)->setOptions($visualization_settings);
					}elseif($chart->chart_type == 'CustomMap'){
						$drawer_array['visualizations']['chart_'.$key]['map'] = $this->getSVGMaps($chart->meta); // get svg maps global or local
						$mapSettings = $this->getMetaValue($chart->meta,'chart_settings');
						
						$drawer_array['visualizations']['chart_'.$key]['chart_settings'] = $mapSettings;
						$header_with_column = $headers;
						$headers = array_values($headers);
						$customMapDate = $this->create_map_array($dataset_records, $headers, $chart, $header_with_column);
						$javascript['chart_'.$key] = ['type'=>$chart->chart_type,'id'=>'chart_'.$key,'data'=>$records_array,'headers'=>$headers, 'arranged_data'=>$customMapDate];
					}elseif($chart->chart_type == 'ListChart'){
						$list_array = [];
						foreach($records_array as $ky => $inner_array){
							$list_array[] = array_combine($headers, $inner_array);
						}
						$drawer_array['visualizations']['chart_'.$key]['list'] = $list_array;
					}
					/*
					* Prepare data for draw visualization
					* on front
					*/
					$chartTitles['chart_'.$key] = $chart->chart_title; //collect all chart titles in single array
					$drawer_array['visualizations']['chart_'.$key]['chart_type'] = $chart->chart_type;
					$drawer_array['visualizations']['chart_'.$key]['chart_id'] = $chart->id;
					$drawer_array['visualizations']['chart_'.$key]['title'] = $chart->chart_title;
					$drawer_array['visualizations']['chart_'.$key]['enableDisable'] = $this->getMetaValue($chart->meta,'enableDisable');
				}else{
					$drawer_array['visualizations']['chart_'.$key]['error'] = 'No records found with selected filters';
					//$this->put_in_errors_list('No records found with selected filters');
				}

			}catch(\Exception $e){
				$drawer_array['visualizations']['chart_'.$key]['error'] = $e->getMessage();
				//$this->put_in_errors_list($e->getMessage());
				throw $e;
			}
		}
		/*
		* Prepare filters for front view
		 */
		$datasetColumns = (array)DB::table($dataset_table)->first();
		$filter_columns = $this->getMetaValue($visualization->meta,'filters');
		$filters = [];
		if(!empty(json_decode($filter_columns,true))){
			$filters = $this->getFIlters($dataset_table, json_decode($filter_columns, true),$datasetColumns);
		}
		
		// adding selected values of filters in filters array
		$selectedFilters = $request->except(['_token','applyFilter']);
		foreach ($selectedFilters as $type => $array) {
			foreach($array as $indexedkey => $columnNames){
				foreach($columnNames as $colKey => $colArray){
					if($filters[$colKey]['column_type'] == $type){
						$filters[$colKey]['selected_value'] = $colArray;
					}
				}
			}
		}
		//Finaly load view
		return view('organization.visualization.visualization',
								[
									'filters'=>$filters, // contain all filters
									'titles'=>$chartTitles, // contains all titles 
									'visualizations'=>$drawer_array, // data for draw all charts from lava charts
									'javascript'=>$javascript, //data for custom map popup details
									'custom_map_data'=>[] //data for pop click event
								]
					);
	}

	public function create_map_array($records, $headers, $chart, $header_with_column){
		$records = collect($records);
		$getFirstPrimaryColumn = collect($records);
		$collectionData = collect($getFirstPrimaryColumn->first());
		$columnForGroup = $collectionData->keys()->first();
	

		$viewData_meta[] = $this->getMetaValue($chart->meta,'viewdata');
		$tooltipData = json_decode($chart->secondary_column);
		$popupData = json_decode($this->getMetaValue($chart->meta,'customdata'));
		$viewData_array = [];
		$tooltipData_array = [];
		$popupData_array = [];
		$recordsArray = $records->groupBy($columnForGroup)->toArray();
		$index = 0;
		foreach($recordsArray as $key => $record){
			foreach($record as $k => $value){
				foreach($viewData_meta as $ck => $column_key){
					$viewData_array[$key][str_replace(' ', '_', $k)] = $value[$column_key];
				}
				foreach ($tooltipData as $ck => $column_key) {
					// dd($value);
					$tooltipData_array[$key][str_replace(' ', '_', $k)][$header_with_column[$column_key]] = $value[$column_key];
				}
				
				foreach ($popupData as $ck => $column_key) {
					$popupData_array[$key][str_replace(' ', '_', $k)][$header_with_column[$column_key]] = $value[$column_key];
				}
				$recordsArray[$key][str_replace(' ', '_', $k)] = array_combine($headers, $value);
				$index++;
			}
		}

		//$viewData_array = collect($viewData_array);
		
		$viewData_array = array_map(function($item){
			return collect($item)->sum();
		}, $viewData_array);

		//Don't remove this, this is working code
		/*$records_array = [];
		foreach ($records as $key => $record) {
			foreach($record as $k => $value){
				if($k != 0){
					$records_array[$record[0]][$headers[$k]][] = $value;
				}
			}
		}*/
		/*dump('View Data Array');
		dump($viewData_array);
		dump('Tooltip Data Array');
		dump($tooltipData_array);
		dump('Popup Data Array');
		dump($popupData_array);
		dump('Final Data Array');
		dd($recordsArray);*/
		return ['view_data'=>$viewData_array, 'tooltip_data'=>$tooltipData_array,'popup_data'=>$popupData_array];
	}
	public function setting_visualization($id)
	{	
		$formModel = [];
		$model = VisualizationMeta::where('visualization_id',$id)->get();
		foreach($model as $key => $value){
			$formModel[$value->key] = $value->value;
		}
		return view('organization.visualization.visualization-setting',['model'=>$formModel]);
	}
	public function collaborate_visualization($id){
		$model = Visualization::find($id);
		if($model->embed_token == null){
			$model->embed_token = str_random();
			$model->save();
		}
		return view('organization.visualization.collaborate',['model'=>$model]);
	}
	public function getDataByAjax($id, $length){

		$model = Visualization::with('dataset')->find($id);
		$dataset = DB::select('SELECT * FROM ocrm_'.str_replace('ocrm_','',$model->dataset->dataset_table).' LIMIT 1');
		$dataset = (array)$dataset[0];
		unset($dataset['id']);
		$columns = $dataset;
		$maps = CustomMaps::get();

    	return view('organization.visualization.chart-append',['columns'=>$columns,'length'=>$length])->render();
    }
    public function getFilterByAjax($id)
    {	
    	$model = Visualization::with('dataset')->find($id);
		$dataset = DB::select('SELECT * FROM '.$model->dataset->dataset_table.' LIMIT 1');
		$dataset = (array)$dataset[0];
		unset($dataset['id']);
		$columns = $dataset;
		$maps = CustomMaps::get();
    	return view('organization.visualization.filter-append',['columns'=>$columns])->render();
    }
    public function getDataById($id)
    {
    	$model = Visualization::find($id);
    	return view('organization.visualization.edit-form',compact('model'));
    }
    public function updateVizDetails(Request $request)
    {

		$data = Visualization::where('id',$request->id)->update($request->except(['_token','id']));
		return back();
    }
    public function addVisual($datasetId = null)
    {	
    	return view('organization.visualization.create',['datasetid'=>$datasetId]);
    }
    public function customize_visualization($id)
    {
    	$model = VisualizationMeta::where('visualization_id',$id)->get();
    	return view('organization.visualization.customize',['model'=>$model,'id'=>$id]);
    }

    public function udpateCustomize(Request $request, $id){
    	foreach($request->except(['_token']) as $key => $value){
    		$model = VisualizationMeta::firstOrNew(['key'=>$key,'visualization_id'=>$id]);
    		$model->key = $key;
    		$model->value = $value;
    		$model->visualization_id = $id;
    		$model->save();
    	}
    	return back();
    }

    /**
     * Save charts settings
     * @param  Request $request [posted data]
     * @return [back]           [back]
     * @author Rahul
     */
    public function saveChartSettings(Request $request){
    	// VisualizationChartMeta
		$model = VisualizationChartMeta::firstOrNew(['key'=>'chart_settings','chart_id'=>$request->chart_id,'visualization_id'=>$request->visual_id]);
		$model->key = 'chart_settings';
		$model->value = json_encode($request->except(['_token','chart_id','visual_id','submit']));
		$model->chart_id = $request->chart_id;
		$model->visualization_id = $request->visual_id;
		$model->save();
    	return back();
    }

    /**
     * get chart settings function
     * @param  Request $request [posted data]
     * @return [view]           [blade view output]
     * @author Rahul
     */
    public function getChartSettings(Request $request){
    	$model = VisualizationChartMeta::where(['key'=>'chart_settings','chart_id'=>$request->chartid,'visualization_id'=>$request->visualid])->first();
    	if($model != null){
    		$model = json_decode($model->value,true);
    	}else{
    		$model = [];
    	}
    	$jsonData = File::get('json.php');
    	$jsonData = collect(json_decode($jsonData));
    	return view('organization.visualization.chart-settings',['jsonData'=>$jsonData,'chart_type'=>$request->charttype,'request'=>$request,'model'=>$model]);
    }

}