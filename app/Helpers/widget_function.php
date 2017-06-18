<?php 
use App\Model\Admin\GlobalWidget as GW;

function global_draw_widget($slug)
{

	$models ="";
	$data = GW::where('slug',$slug)->first();
	if(!empty($data))
	{	
		$model_name = $data['model'];
		$models =  "App\\Model\\Organization\\$model_name";
		$data['count'] = $models::get()->count();
		$data['list'] = $models::get()->take(2);
		return view('admin.widget.view_widget',['data'=>$data]);
	} 
}



?>