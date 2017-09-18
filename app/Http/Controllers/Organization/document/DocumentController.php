<?php

namespace App\Http\Controllers\Organization\document;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Document;
use App\Model\Organization\DocumentTemplate;
use App\Model\Organization\DocumentLayout;
use session;

class DocumentController extends Controller
{
     public function index(Request $request)
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
          if($request->has('search')){
              if($sortedBy != ''){
                  $model = Document::where('title','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
              }else{
                  $model = Document::where('title','like','%'.$request->search.'%')->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = Document::orderBy($sortedBy,$request->order)->paginate($perPage);
              }else{
                   $model = Document::paginate($perPage);
              }
          }
          $datalist =  [
                          'datalist'=>  $model,
                          'showColumns' => ['title'=>'Name','description' => 'Description','created_at'=>'Created At'],
                          'actions' => [
                                          'edit' => ['title'=>'Edit','route'=>'edit.campaign' , 'class' => 'edit'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.email'],
                                          'view' => ['title' => 'View' , 'route' => 'view.document']
                                       ],
                          'js'  =>  ['custom'=>['list-designation']],
                          'css'=> ['custom'=>['list-designation']]
                      ];
        return view('organization.documents.index',$datalist);
    }
    public function createDocument()
    {
      return view('organization.documents.createDocument');
    }
    public function createLayouts()
    {
        return view('organization.documents.create-layout');
    }
    public function createTemplates()
    {
        return view('organization.documents.create-template');
    }
    public function saveLayout(Request $request)
    {
        $obj = new DocumentLayout();
        $obj->fill($request->all());
        $obj->save();
        return redirect()->route('document.layouts');
    }
    public function getInfolayout($id)
    {
        $model = DocumentLayout::where('id',$id)->first();
        return view('organization.documents.create-layout',compact('model'));
    }
    public function saveTemplate(Request $request)
    {
        $obj = new DocumentTemplate();
        $obj->fill($request->all());
        $obj->save();
        return redirect()->route('document.templates');
    }
    public function updatelayout(Request $request)
    {
        $id = $request->id;
        $request = $request->except('_token','id');
        $model = DocumentLayout::where('id',$id)->update($request);
        Session::flash('success-update' , 'Updated Successfully');
        return back();
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
                $model = DocumentLayout::where('name','like','%'.$request->search.'%')->paginate($perPage);
            }else{
                $model = DocumentLayout::where('name','like','%'.$request->search.'%')->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $model = DocumentLayout::orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                $model = DocumentLayout::paginate($perPage);
            }
        }
        // dd($model);
        $datalist =  [
                      'datalist'=>  $model,
                      'showColumns' => ['name'=>'Name','slug'=>'Slug','created_at'=>'Created At'],
                      'actions' => [
                                      'edit' => ['title'=>'Edit','route'=> 'document.layout' , 'class' => 'edit'],
                                      'delete'=>['title'=>'Delete','route'=>'document.layout.delete'],
                                      'view'=>['title'=>'View','route'=>'document.layout.view']
                                   ],
                    ];
        return view('organization.documents.layouts',$datalist)->with(['data' => $data]);
    }
    public function deleteLayout($id)
    {
        $model = DocumentLayout::where('id',$id)->delete();
        return back();
    }
    public function deleteTemplates($id)
    {
        $model = DocumentTemplate::where('id',$id)->delete();
        return back();
    }
    public function templates( Request $request)
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
                $model = DocumentTemplate::where('name','like','%'.$request->search.'%')->paginate($perPage);
            }else{
                $model = DocumentTemplate::where('name','like','%'.$request->search.'%')->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $model = DocumentTemplate::orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                $model = DocumentTemplate::paginate($perPage);
            }
        }
        // dd($model);
        $datalist =  [
                      'datalist'=>  $model,
                      'showColumns' => ['name'=>'Name','slug'=>'Slug','created_at'=>'Created At'],
                      'actions' => [
                                      'edit' => ['title'=>'Edit','route'=>'edit.document.template' , 'class' => 'edit'],
                                      'delete'=>['title'=>'Delete','route'=>'templates.delete'],
                                      'view'=>['title'=>'View','route'=>'templates.delete'],
                                   ],
                      
                    ];
        return view('organization.documents.templates',$datalist)->with(['data' => $data]);
    }
    public function getInfoTemplates($id)
    {
        $model = DocumentTemplate::where('id',$id)->first();
        return view('organization.documents.create-template',compact('model'));
    }
    public function updateTemplates(Request $request)
    {
        $id = $request->id;
        $request = $request->except('_token','id');
        $model = DocumentTemplate::where('id',$id)->update($request);
        Session::flash('success-update' , 'Updated Successfully');
        return back();
    }
    public function layoutPreview($id)
    {
        $model = DocumentLayout::find($id);
        return view('organization.documents.previewLayout',compact('model'));
    }
    public function TemplatePreview($id)
    {
      $model = DocumentTemplate::find($id);
    	return view('organization.documents.previewTemplate',compact('model'));
    }
    public function saveDocument(Request $request)
    {
      $model = new Document();
      $model->fill($request->except('_token'));
      $model->save();
      return back();
    }
    public function viewDocument($id)
    {
      $document = Document::find($id);
      return view('organization.documents.preview',compact('document'));
    }
}
