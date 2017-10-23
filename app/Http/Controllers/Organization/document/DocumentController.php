<?php

namespace App\Http\Controllers\Organization\document;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Document;
use App\Model\Organization\DocumentTemplate;
use App\Model\Organization\DocumentLayout;
use session;
use App\Model\Organization\Department;
use App\Model\Organization\Designation;
use App\Model\Organization\Shift;
use App\Model\Organization\UsersRole;
use App\Model\Organization\UserRoleMapping;
use App\Model\Organization\User;
use App\Model\Organization\UsersMeta;
use PDF;

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
                $perPage = get_items_per_page();;
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
                                          'edit' => ['title'=>'Edit','route'=>'edit.document' , 'class' => 'edit'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.document'],
                                          'view' => ['title' => 'View' , 'route' => 'view.document']
                                       ],
                          'js'  =>  ['custom'=>['list-designation']],
                          'css'=> ['custom'=>['list-designation']]
                      ];
        return view('organization.documents.index',$datalist);
    }
    public function createDocument()
    {
      // $document = Document::where('id',$id)->first();
      $params = [
                  'departments'   => $data['departments'] = Department::pluck('name','id'),
                  'designations'  => $data['designations'] = Designation::pluck('name','id'),
                  'shifts'        => $data['shifts'] = Shift::pluck('name','id'),
                  'roles'         => $data['roles'] = UsersRole::pluck('name','id'),
                  'users'         => $data['users'] = User::pluck('name','id')
                ];
      return view('organization.documents.createDocument',compact('params'));
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
              $perPage = get_items_per_page();;
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
              $perPage = get_items_per_page();;
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
                                      'view'=>['title'=>'View','route'=>'document.template.view'],
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
      Session::flash('success','Document Created Successfully');
      return back();;
    }
    public function viewDocument($id)
    {
      $document = Document::with(['DocumentLayout' , 'DocumentTemplate'])->find($id);
      return view('organization.documents.preview',compact('document'));
    }
    public function deleteDocument($id)
    {
      $document = Document::where('id',$id)->delete();
      return back();
    }
    public function editDocument($id)
    {
      $document = Document::where('id',$id)->first();
      $params = [
                  'departments'   => $data['departments'] = Department::pluck('name','id'),
                  'designations'  => $data['designations'] = Designation::pluck('name','id'),
                  'shifts'        => $data['shifts'] = Shift::pluck('name','id'),
                  'roles'         => $data['roles'] = UsersRole::pluck('name','id'),
                  'users'         => $data['users'] = User::pluck('name','id')
                ];
      return view('organization.documents.createDocument',compact(['document','params']));
    }
    public function updateDocument(Request $request)
    {
      $upadte = Document::where('id',$request['id'])->update($request->except('_token','id'));
      return back();
    }
    public function sendDocument(Request $request)
    {
        $document_id = $request['document_id'];
        $user_id = [];
        $send_to =  $request['send_to'][0];
        $ids = $request['users'][$send_to];

        if($send_to == 'roles'){
            $data = [];
                foreach ($ids as $key => $id) {
                    $data[] = UserRoleMapping::select('user_id')->where(['role_id' => $id ])->get()->toArray();
                }
            $user_id = $this->getUsersList($data , 'user_id');
        }

        if($send_to == 'users'){
            $data = [];
                foreach ($ids as $key => $id) {
                    $data[] = User::select('id')->where(['id' => $id ])->get()->toArray();
                }
            $user_id =  $this->getUsersList($data , 'id');
        }
        if($send_to == 'designation' || $send_to == 'department' || $send_to == 'shift'){
            $data = [];
                foreach ($ids as $key => $id) {
                    $data[] = UsersMeta::select('user_id')->where(['key' => $send_to , 'value' => $id ])->get()->toArray();
                }
            $user_id = $this->getUsersList($data , 'user_id');
        }
        if($send_to == 'all'){
            $users = User::select('id')->get()->toArray();
            foreach ($users as $key => $value) {
                foreach($value as $k => $v){
                    $user_id[] = $v;
                }
            }
        }
        foreach ($user_id as $key => $id) {
            $userMeta = new UsersMeta;
            $userMeta->user_id = $id;
            $userMeta->key = 'document';
            $userMeta->value = $document_id;
            $userMeta->type = 'document';
            $userMeta->save();
        }
        return redirect()->route('documents'); 
    }
    function getUsersList($data , $field){
      $user_id = [];
      foreach ($data as $key => $value) {
        if($value != null){
          foreach($value as $k => $v){
            $user_id[] = $v[$field];
          }
        }
      }   
      // dd($user_id);
      return $user_id;
    }
    public function documentDownload($id)
    {
        $document = Document::with(['DocumentLayout' , 'DocumentTemplate'])->find($id);
        view()->share('document',$document);
            $pdf = PDF::loadView('organization.documents.downloadPDF',compact('document'));
            return $pdf->download($document->title.'.pdf',compact('document'));
    }
}
