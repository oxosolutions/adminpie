<?php

namespace App\Http\Controllers\Organization\project;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Client\ClientRepositoryContract;
use App\Model\Organization\Project;
use Session;
use App\Model\Organization\ProjectMeta as PM;
use Auth;
use App\Model\Organization\User;
use App\Model\Organization\ProjectCategory as CAT;
use App\Model\Organization\Todo as TD;
use App\Model\Organization\Tasks;
use Carbon\Carbon;
use Artisan;
use App\Model\Organization\ProjectAttachment;
use App\Model\Organization\ProjectCredentials;

class ProjectController extends Controller
{
    protected $user;
    protected $client;
    
    public function __construct(UserRepositoryContract $user ,ClientRepositoryContract $client)
    {
        $this->user = $user;
        $this->client = $client;
    }
  	public function create()
  	{
  		return view('organization.project.create');
  	}
    public function validation(Request $request)
    {
        $pro_table = Session::get('organization_id');
        $validation = [
                                'name' => 'required|unique:'.$pro_table.'_projects',
                                'category' => 'required'
                            ];
        return $this->validate($request, $validation);
    }
    public function save(Request $request)
    {
      $this->validation($request);
    	$project = new Project();
    	$project->fill($request->all());
        $project->tags = json_encode(['abc','cde']);
    	$project->save();
    	Session::flash('success','successfully created project');
    	return redirect()->route('list.project');
    }
    public function add_client(Request $request)
    {
        $this->user->create($request->all(),3); 
        $this->client->create($request->all());
        return redirect()->route('list.project');

    }

    public function listProject(Request $request , $id = null)
    {
        $data = "";
        if(@$id){
            $data = $this->getProjectById($id);
        }
        $datalist= [];
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
                  $model = Project::where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                  $model = Project::where('name','like','%'.$request->search.'%')->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = Project::orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                   $model = Project::paginate($perPage);
              }
          }
          $datalist =  [
                          'datalist'=>  $model,
                          'showColumns' => ['name'=>'Name','created_at'=>'Created At'],
                          'actions' => [
                                          // 'edit' => ['title'=>'Edit','route'=>'list.project' , 'class' => 'edit'],
                                          'edit' => ['title'=>'Edit','route'=>'details.project' , 'class' => 'edit'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.project']
                                       ],
                          'js'  =>  ['custom'=>['list-designation']],
                          'css'=> ['custom'=>['list-designation']]
                      ];
                  // dd($datalist);
      return view('organization.project.list',$datalist)->with(['categories' => CAT::all() , 'data' => $data]);
      /*$categories =  CAT::all();
      $clients = $this->client->get_client();
      $plugins = [
              'js' => ['custom'=>['list']]
      ];
      return view('organization.project.list',['clients'=>@$clients,'categories'=>@$categories, 'tags' => @$tag_final_data,'plugins'=>$plugins]);*/
    }

    /*
    * To load list project for ajax
    * 
     */
    // public function projectsList(Request $request){
    //     if($request->has('order')){
    //         $order = $request->order;
    //     }else{
    //         $order = 'desc';
    //     }
    //     $projects = Project::orderBy('name',$order);

    //     if($request->has('q')){
    //         $projects = $projects->orWhere('name','like','%'.$request->q.'%');
    //     }
    //     if($request->has('tags')){
    //         foreach($request->tags as $tag){
    //             $projects->orWhere('tags','like','%'.$tag['tag'].'%');
    //         }
    //     }
    //     $projects = $projects->paginate(10);
    //     return view('organization.project.ajax.projects',['projects'=>$projects]);
    // }
   

    public function edit($id)
    {
    	try{
    		 $edit = Project::findOrFail($id);
    		 return view('organization.project.edit',['model'=>$edit]);
    		}catch(Exception $e)
    		{
    			throw $e;	
    		}
    }

    public function update(Request $request, $id)
    {
        foreach($request->except('_token') as $key => $value){
            $model = PM::firstOrNew(['project_id'=>$id,'key'=>$key]);
            $model->project_id = $id;
            $model->key = $key;
            $model->value = ($value == null)?'':$value;
            $model->type = 'test';
            $model->save();
        }
        return back();
        /*$id = $request->id;
    	$project = Project::findOrFail($id);
    	$project->fill($request->all());
    	$project->save();
    	Session::flash('success','successfully update project');
    	return redirect()->route('list.project');*/
    }

    public function add_project_info($id)
    {
        $model = null;
        $project = PM::where('project_id',$id);
           if($project->count() >0)
           {
                $data = json_decode($project->get(),true);
                $model = array_column($data, 'value','key');
           }
       return view('organization.project.info.project_info',['id'=>$id , 'model'=>$model]);
    }

   

    public function save_project_meta(Request $request)
    {
       if($request->file('document'))
       {
            $org_path =  public_path().'/files/organization_'.Session::get('organization_id');
            if(!is_dir($org_path))
            {
                mkdir($org_path , 0777 ,true);
            }
            
            if($request->file('document') )
            {
                $file = $request->file('document');
                $OriginalName =   $file->getClientOriginalName();
                $filename = str_random(8) . '_' . $OriginalName;
                $file->move($org_path,$filename);
                $doc_array =   ['key'=>'doc_1' , 'value'=>$filename, 'type'=>$request->type, 'project_id'=>$request->project_id];
                $project_file = PM::where(['key'=>'doc_1','type'=> $request->type, 'project_id'=>$request->project_id]);
                if($project_file->count()>0)
                {
                    $project_file->update($doc_array);
                    return redirect()->route('add_project_info.project',['id'=>$request->project_id]);

                }
                else{
                PM::insert($doc_array);
                }
            }
       }else{
        
        $all_data = $request->all();
        $type = $all_data['type'];
        $project_id = $all_data['project_id'];
        $project = PM::where(['type'=> $type, 'project_id'=>$project_id]);
       if($project->count() >0)
       {
            $project->delete();
       }
        unset($all_data['type'],$all_data['project_id'],$all_data['_token']);
        foreach ($all_data as $key => $value) {
            if(!empty($value))
            {
                $insert = ['key'=>$key ,'value'=>$value,'project_id'=>$project_id, 'type'=>$type];
                $pm = new PM();
                $pm->fill($insert);
                $pm->save();
            }
        }


        //PM::insert($insert);
        return redirect()->route('add_project_info.project',['id'=>$project_id]);
    }
       
    }

    public function upload(Request $request, $id)
    {
        $settings = Setting::findOrFail(1);
        $companyname = $settings->company;
        if (!is_dir(public_path() . '/files/' . $companyname)) {
            mkdir(public_path() . '/files/' . $companyname, 0777, true);
        }
        $file = $request->file('file');
        $destinationPath = public_path() . '/files/' . $companyname;
        $filename = str_random(8) . '_' . $file->getClientOriginalName();
        $fileOrginal = $file->getClientOriginalName();
        $file->move($destinationPath, $filename);
        $size = $file->getClientSize();
        $mbsize = $size / 1048576;
        $totaltsize = substr($mbsize, 0, 4);
        if ($totaltsize > 15) {
            Session::flash('flash_message', 'File Size can not be bigger then 15MB');
            return redirect()->back();
        }
        $input = array_replace(
            $request->all(),
            ['path' => "$filename", 'size' => "$totaltsize", 'file_display' => "$fileOrginal", 'client_id' => $id]
        );
        $document = Document::create($input);
        Session::flash('flash_message', 'File successfully uploaded');
    }

    function view(){
        return view('organization.project.view');
    }
    function delete($id){
        $model = Project::where('id',$id)->delete();
        return back();
    }
    function getProjectById($id){
        $model = Project::where('id',$id)->get();
        return $model;
    }
    function editProject(){
        // update.project
    }

    public function categories(Request $request){
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
              $model = CAT::where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
          }else{
              $model = CAT::where('name','like','%'.$request->search.'%')->paginate($perPage);
          }
      }else{
          if($sortedBy != ''){
              $model = CAT::orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
          }else{
               $model = CAT::paginate($perPage);
          }
      }
      $datalist =  [
                      'datalist'=>  $model,
                      'showColumns' => ['name'=>'Name','created_at'=>'Created At'],
                      'actions' => [
                                      'edit' => ['title'=>'Edit','route'=>'designations' , 'class' => 'edit'],
                                      'delete'=>['title'=>'Delete','route'=>'delete.designation']
                                   ],
                      'js'  => ['custom'=>['project-categories']],
                      
                  ];
  /*  if(!empty($id) || $id != null || $id != ''){
      $data['data'] = CAT::where('id',$id)->first();
    }*/
      

         return view('organization.categories.list',$datalist);
    }

    public function saveCategory(Request $request){
        $rules = [
                'name' => 'required',
        ];
        $this->validate($request, $rules);
        $model = new CAT;
        $model->fill($request->except('_token','action'));
        $model->status = 1;
        $model->save();
        return redirect()->route('categories.project');
    }

    public function updateCategory(Request $request){
        $model = CAT::find($request->id);
        $model->name = $request->value;
        $model->save();
        return $request->value;
    }
    public function tasks($id = null)
    {
      $model = Tasks::where('project_id',$id)->get();
      $plugins = [

      			'js' => ['custom'=>['tasks']]
      ];
      return view('organization.project.tasks',['plugins'=>$plugins,'model'=>$model]);
    }
    public function details($id){
        $model = Project::with('projectMeta')->find($id);
        if(!$model->projectMeta->isEmpty()){
            foreach($model->projectMeta as $key => $value){
                if(in_array($value->key,['start_date','end_date'])){
                    $model->{$value->key} = Carbon::parse($value->value)->format('Y-m-d');
                }else{
                    json_decode($value->value);
                    if(json_last_error() == JSON_ERROR_NONE){
                      $model->{$value->key} = json_decode($value->value);
                    }else{
                      $model->{$value->key} = $value->value;
                    }
                }
            }
        }
        return view('organization.project.details',['model'=>$model]);
    }

    public function activities(){
         return view('organization.project.activities');
    }
    public function calender(){
         return view('organization.project.calender');   
    }
   
    public function documentation(){
        return view('organization.project.documentation');
    }
    public function todo(Request $request , $id=null){
      $plugins = ['js' => ['custom'=>['todo']]];
      if($id != null || $id != "" || !empty($id) ){
        $list = TD::where('project_id',$id)->get();
        return view('organization.project.todo',['plugins' => $plugins , 'list' => $list ]);
      }else{
        $list = TD::where('user_id',Auth::guard('org')->user()->id)->get();
        return view('organization.profile.to-do',['plugins' => $plugins , 'list' => $list ]);
      }
    }

    public function updateTeam(Request $request, $id){

        foreach($request->except(['_token','action']) as $key => $value){
            $model = PM::firstOrNew(['project_id'=>$id,'key'=>$key]);
            $model->project_id = $id;
            $model->key = $key;
            $model->value = json_encode($value);
            $model->type = 'test';
            $model->save();
        }
        return back();
    }



    //attachment 
    public function attachments(Request $request)
    {
      $project_id = request()->route()->parameters()['id'];

        $datalist= [];
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
                  $model = ProjectAttachment::where(['project_id' => $project_id ,'name','like','%'.$request->search.'%'])->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                  $model = ProjectAttachment::where(['project_id' => $project_id ,'name','like','%'.$request->search.'%'])->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = ProjectAttachment::orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                   $model = ProjectAttachment::paginate($perPage);
              }
          }
          $datalist =  [
                      'datalist'=>  $model,
                      'showColumns' => ['name'=>'Name','description' => 'Description','type' => ['title' => 'Type','type' => 'image','imagePath' => 'images/fileIcons/'],'file'=>'file','created_at'=>'Created At'],
                      // 'columnType' => ['type' => 'image'],
                      'actions' => [
                                      'download' => ['title'=>'Download', 'route'=>'redirect.back' ,'class' => 'download' ,'destinationPath' => 'projectAttachments'],
                                      // 'edit' => ['title'=>'Edit','route'=>'details.project' , 'class' => 'edit'],
                                      'delete'=>['title'=>'Delete','route'=>'delete.attachment']
                                   ],
                      'js'  =>  ['custom'=>['list-designation']],
                      'css'=> ['custom'=>['list-designation']]
                  ];
                  // dd($datalist);
      return view('organization.project.Attachemnts',$datalist)->with(['categories' => CAT::all() ]);
    }
    
    //save Attachment
    public function saveAttachment(Request $request)
    {

      $file = $request->file;
      $fileName = $request->project_id.'_'.$file->getClientOriginalName();
      $allowedExtension = ['jpg','jpeg','pdf','png','doc','docx'];
      $fileExtention = $file->getClientOriginalExtension();
      
      if($fileExtention == 'jpg' || $fileExtention == 'jpeg'){
        $type = 'jpg.png';
      }elseif($fileExtention == 'png'){
        $type = 'png.png';
      }elseif($fileExtention == 'doc'){
        $type = 'doc.jpg';
      }elseif($fileExtention == 'docx'){
        $type = 'docx.png';
      }

      $destinatinPath = 'projectAttachments';
      if(in_array($fileExtention, $allowedExtension)){
        $file->move($destinatinPath , $fileName);
        $model = new ProjectAttachment;
        $model->project_id = $request->project_id;
        $model->name = $request->name;
        $model->description = $request->description;
        $model->type = $fileExtention;
        $model->file = $fileName;
        $model->save();
        return back();
      }else{
        dd('file format not valid');
      }
    } 
    public function deleteAttachment($id)
    {
      $model = ProjectAttachment::find($id)->delete();
      return back();
    }

    //credientals
    public function saveCredientals(Request $request)
    {
      // dd($request->all());

      $data = [] ;
      $data2 = [] ;

      foreach($request->all() as $k => $val){
        if(is_array($val)){
          $data[$k] = $val;
        }
      }
      // dd($data);
      $userDataArray = [];
      for($index = 0; $index < count($data['title']); $index++){
        $tempArray = [];
        foreach ($data as $key => $vals) {
            $tempArray[$key] = $vals[$index];
        }
        $userDataArray[] = $tempArray;
      }
      $model = new ProjectCredentials;
      $model->fill($request->except('_token','action','email','password','title'));
      $model->data = json_encode($userDataArray);
      $model->save();
      return back();
    }
    public function credentials(Request $request)
    {
      $project_id = request()->route()->parameters()['id'];

        $datalist= [];
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
                  $model = ProjectCredentials::where(['project_id' => $project_id ,'name','like','%'.$request->search.'%'])->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                  $model = ProjectCredentials::where(['project_id' => $project_id ,'name','like','%'.$request->search.'%'])->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = ProjectCredentials::orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                   $model = ProjectCredentials::paginate($perPage);
              }
          }
          // dump($model);
          $datalist =  [
                      'datalist'=>  $model,
                      'showColumns' => ['website_title' =>'Title','created_at'=>'Created At'],
                      'actions' => [
                                      'edit' => ['title'=>'Edit','route'=>'details.crediental' , 'class' => 'edit'],
                                      'delete'=>['title'=>'Delete','route'=>'delete.crediental']
                                   ],
                      'js'  =>  ['custom'=>['list-designation']],
                      'css'=> ['custom'=>['list-designation']]
                  ];
                  // dd($datalist);

      return view('organization.project.credentials',$datalist)->with(['categories' => CAT::all() ]);
    }
    public function deleteCredentials($id)
    {
      $model = ProjectCredentials::find($id)->delete();
      return back();
    }
    public function editCrediental($id)
    {
      $model = ProjectCredentials::where('id',$id)->get();
      return view('organization.project.editCredentials',['model'=>$model]);
    }
    public function updateCredientals(Request $request)
    {

      $data = [] ;
      $data2 = [] ;

      foreach($request->all() as $k => $val){
        if(is_array($val)){
          $data[$k] = $val;
        }
      }
      // dd($data);
      $userDataArray = [];
      for($index = 0; $index < count($data['title']); $index++){
        $tempArray = [];
        foreach ($data as $key => $vals) {
            $tempArray[$key] = $vals[$index];
        }
        $userDataArray[] = $tempArray;
      }
      $request['data'] = json_encode($userDataArray);
      // dd($request->all());
      $model = ProjectCredentials::where('id',$request->id)->update($request->except('submit','_token','action','email','password','title'));
      // $model = new ProjectCredentials;
      // $model->fill($request->except('_token','action','email','password','title'));
      // $model->data = json_encode($userDataArray);
      // $model->save();
      return back();
    }

}