<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\JobOpening;

class JobOpeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
              $model = JobOpening::where('title','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
          }else{
              $model = JobOpening::where('title','like','%'.$request->search.'%')->paginate($perPage);
          }
      }else{
          if($sortedBy != ''){
              $model = JobOpening::orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
          }else{
               $model = JobOpening::paginate($perPage);
          }
      }
      $datalist =  [
                      'datalist'=>  $model,
                      'showColumns' => ['title'=>'Title','created_at'=>'Created At'],
                      'actions' => [
                                      'edit' => ['title'=>'Edit','route'=>'opening.update' , 'class' => 'edit'],
                                      'delete'=>['title'=>'Delete','route'=>'delete.opening']
                                   ],
                      'js'  =>  ['custom'=>['list-designation']],
                      'css'=> ['custom'=>['list-designation']]
                  ];
        return view('organization.jobopening.list',$datalist);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {	if($request->isMethod('post')){
    		$job = new JobOpening();
    		$job->fill($request->all());
    		$job->save();
        return redirect()->route('list.opening');
    		}

        return view('organization.jobopening.create');
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id=null){
      $model =  JobOpening::find($id);
      if($request->isMethod('post')){
        $model->update($request->all());
        return redirect()->route('list.opening');
      }
      return view('organization.jobopening.edit', compact('model'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       JobOpening::where('id',$id)->delete();
        return redirect()->route('list.opening');

    }
}
