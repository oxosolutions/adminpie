<?php

namespace App\Http\Controllers\Organization\templates;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\GlobalEmailTemplate;

class EmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datalist= [];
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
                $model = GlobalEmailTemplate::where(['slug'=>'like','%'.$request->search.'%'])->orderBy($sortedBy,$request->ORGc_asc)->paginate($perPage);
            }else{
                $model = GlobalEmailTemplate::where(['slug'=>'like','%'.$request->search.'%'])->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $model = GlobalEmailTemplate::orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
            }else{
                $model = GlobalEmailTemplate::paginate($perPage);
            }
        }
        $datalist =  [
                      'datalist'=>  $model,
                      'showColumns' => ['slug'=>'slug', 'language'=>'language', 'created_at'=>'Created At'],
                      'actions' => [
                                      'edit'    =>  ['title'=>'Edit','route'=>'activity.edit' , 'class' => 'edit'],
                                      'delete'  =>  ['title'=>'Delete','route'=>'activity.delete']
                                   ],
                      'js'  =>  ['custom'=>['list-designation']],
                      'css'=> ['custom'=>['list-designation']]
                  ];
		return view('admin.email-template.notificationlist',$datalist);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
    	if($request->isMethod('post')){
    		$template = new GlobalEmailTemplate();
    		$template->fill($request->all());
    		$template->save();
    	}
        return view('admin.email-template.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('admin.email-template.edit-v1');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
