<?php

namespace App\Http\Controllers\Organization\cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Cms\Media;
use Session;

class MediaController extends Controller
{
    public function index(Request $request)
    {
    	$datalist= [];
        $data= [];
          if($request->has('per_page')){
                $perPage = $request->per_page;
                if($perPage == 'all'){
                  $perPage = 999999999999999;
                }
              }else{
                $perPage = 5;
              }
          $sortedBy = @$request->sort_by;
          if($request->has('search')){
              if($sortedBy != ''){
                  $model = Media::where('id','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                  $model = Media::where('id','like','%'.$request->search.'%')->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = Media::orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                   $model = Media::paginate($perPage);
              }
          }
                  $datalist =  [
                          'datalist'=>  $model,
                          'showColumns' => ['id'=>'id', 'created_at'=>'Created At'],
                          'actions' => [
                                          'view' => ['title'=>'View Details','route'=>'view.applicantion' , 'class' => 'edit'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.applicantion']
                                       ],
                          'js'  =>  ['custom'=>['list-designation']],
                          'css'=> ['custom'=>['list-designation']]
                      ];
    	
            return view('cms.media.list_media',$datalist);
    }

    public function create(Request $request){

    	if($request->file('file'))
		{	
			$orgID = Session::get('organization_id');
			$storage_path = upload_path().'/media';
			$file = $request->file('file');
			$file_name = str_random(13).$file->getClientOriginalName();
			$file->move($storage_path, $file_name);	
			dd();

		}
    	// if($request->isMethod('post')){
    	//   return $path = $request->file('file')->store('media');
    	// 	dump($request->all());    		
    	// }
    	return view('cms.media.create');
    	echo "workings";
       // return $path;
    }
}
