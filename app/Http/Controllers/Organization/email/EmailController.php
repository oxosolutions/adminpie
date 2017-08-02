<?php

namespace App\Http\Controllers\Organization\email;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\EmailLayout;
use App\Model\Organization\EmailTemplate;
use Auth;
use Session;

class EmailController extends Controller
{
    public function index()
    {

    	return view('organization.emails.index');
    }
    public function templates(Request $request)
    {
        $datalist= [];
        $data= [];
        if($request->has('items')){
              $perPage = $request->items;
              if($perPage == 'all'){
                $perPage = 999999999999999;
              }
            }else{
              $perPage = 5;
            }
        $sortedBy = @$request->orderby;
        $orgId = Session::get('organization_id');
        if($request->has('search')){
            if($sortedBy != ''){
                $model = EmailTemplate::where('name','like','%'.$request->search.'%')->paginate($perPage);
            }else{
                $model = EmailTemplate::where('name','like','%'.$request->search.'%')->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $model = EmailTemplate::orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                $model = EmailTemplate::paginate($perPage);
            }
        }
        // dd($model);
        $datalist =  [
                      'datalist'=>  $model,
                      'showColumns' => ['name'=>'Name','slug'=>'Slug','created_at'=>'Created At'],
                      'actions' => [
                                      'edit' => ['title'=>'Edit','route'=>'edit.template' , 'class' => 'edit'],
                                      'delete'=>['title'=>'Delete','route'=>'email.templates.delete']
                                   ],
                      
                    ];
        return view('organization.emails.templates',$datalist)->with(['data' => $data]);
    }
    public function layouts(Request $request)
    {
        $datalist= [];
        $data= [];
        if($request->has('items')){
              $perPage = $request->items;
              if($perPage == 'all'){
                $perPage = 999999999999999;
              }
            }else{
              $perPage = 5;
            }
        $sortedBy = @$request->orderby;
        $orgId = Session::get('organization_id');
        if($request->has('search')){
            if($sortedBy != ''){
                $model = EmailLayout::where('name','like','%'.$request->search.'%')->paginate($perPage);
            }else{
                $model = EmailLayout::where('name','like','%'.$request->search.'%')->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $model = EmailLayout::orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                $model = EmailLayout::paginate($perPage);
            }
        }
        // dd($model);
        $datalist =  [
                      'datalist'=>  $model,
                      'showColumns' => ['name'=>'Name','slug'=>'Slug','created_at'=>'Created At'],
                      'actions' => [
                                      'edit' => ['title'=>'Edit','route'=> 'edit.layout' , 'class' => 'edit'],
                                      'delete'=>['title'=>'Delete','route'=>'email.layout.delete']
                                   ],
                      
                    ];
        return view('organization.emails.layouts',$datalist)->with(['data' => $data]);
    }
    public function deleteLayout($id)
    {
        $model = EmailLayout::where('id',$id)->delete();
        return back();
    }
    public function deleteTemplates($id)
    {
        $model = EmailTemplate::where('id',$id)->delete();
        return back();
    }
    public function sendEmail()
    {
        return view('organization.emails.send-email');
    }
    public function createLayouts()
    {
        return view('organization.emails.create-layout');
    }
    public function createTemplates()
    {
        return view('organization.emails.create-template');
    }
    public function saveLayout(Request $request)
    {
        $obj = new EmailLayout();
        $obj->fill($request->all());
        $obj->save();
        return redirect()->route('email.layouts');
    }
    public function saveTemplate(Request $request)
    {
        $obj = new EmailTemplate();
        $obj->fill($request->all());
        $obj->save();
        return redirect()->route('email.templates');
    }
    public function getInfoTemplates($id)
    {
        $model = EmailTemplate::where('id',$id)->first();
        return view('organization.emails.create-template',compact('model'));
    }
    public function updateTemplates(Request $request)
    {
        $id = $request->id;
        $request = $request->except('_token','id');
        $model = EmailTemplate::where('id',$id)->update($request);
        Session::flash('success-update' , 'Updated Successfully');
        return back();
    }
    public function getInfolayout($id)
    {
        $model = EmailLayout::where('id',$id)->first();
        return view('organization.emails.create-layout',compact('model'));
    }
    public function updatelayout(Request $request)
    {
        $id = $request->id;
        $request = $request->except('_token','id');
        $model = EmailLayout::where('id',$id)->update($request);
        Session::flash('success-update' , 'Updated Successfully');
        return back();
    }

}
