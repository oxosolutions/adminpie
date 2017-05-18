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

class ProjectController extends Controller
{
    protected $user;
    protected $client;
    public function __construct(UserRepositoryContract $user ,
                                 ClientRepositoryContract $client)
    {
        $this->user = $user;
        $this->client = $client;
    }
	public function create()
	{
		return view('organization.project.create');
	}
    public function save(Request $request)
    {
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

    public function list()
    {
        $categories =  CAT::all();
        $clients = $this->client->get_client();
        $plugins = [
                'js' => ['custom'=>['list']]
        ];
        return view('organization.project.list',['clients'=>@$clients,'categories'=>@$categories, 'tags' => @$tag_final_data,'plugins'=>$plugins]);
    }

    /*
    * To load list project for ajax
    * 
     */
    public function projectsList(Request $request){
        if($request->has('order')){
            $order = $request->order;
        }else{
            $order = 'desc';
        }
        $projects = Project::orderBy('name',$order);

        if($request->has('q')){
            $projects = $projects->orWhere('name','like','%'.$request->q.'%');
        }
        if($request->has('tags')){
            foreach($request->tags as $tag){
                $projects->orWhere('tags','like','%'.$tag['tag'].'%');
            }
        }
        $projects = $projects->paginate(10);
        return view('organization.project.ajax.projects',['projects'=>$projects]);
    }
   

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

    public function update($id, Request $request)
    {
    	$project = Project::findOrFail($id);
    	$project->fill($request->all());
    	$project->save();
    	Session::flash('success','successfully update project');
    	return redirect()->route('list.project');
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

    public function categories(){

        $categories = CAT::all();
        $plugins = [
                'js'  => ['custom'=>['project-categories']]
          ];

        return view('organization.categories.list',['categories'=>$categories,'plugins'=>$plugins]);
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
    public function tasks()
    {
        # code...
    }
    public function details(){
         return view('organization.project.details');
    }
    public function credentials(){
         return view('organization.project.credentials');
    }
    public function activities(){
         return view('organization.project.activities');
    }
    public function calender(){
         return view('organization.project.calender');   
    }
    public function notes(){
         return view('organization.project.notes');   
    }
    public function documentation(){
        return view('organization.project.documentation');
    }
    public function todo(){
        return view('organization.project.todo');
    }
}