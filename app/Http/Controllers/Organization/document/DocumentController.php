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
use App\Model\Group\GroupUsers as org_user;
use App\Model\Organization\UsersMeta;
use App\Model\Organization\AssignDocument;
use App\Mail\DocumentAssigned;
use PDF;
use Mail;

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
                          'showColumns' => ['title'=>'Name','description' => 'Description','created_at'=>'Created'],
                          'actions' => [
                                          'edit' => ['title'=>'Edit','route'=>'edit.document' , 'class' => 'edit'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.document'],
                                          'view' => ['title' => 'View' , 'route' => 'view.document'],
                                          'assign' => ['title'=>'Assign To Users','route'=>'document.assign']
                                       ],
                          'js'  =>  ['custom'=>['list-designation']],
                          'css'=> ['custom'=>['list-designation']]
                      ];
        return view('organization.documents.index',$datalist);
    }
    public function createDocument()
    {
      $params = [
                  'departments'   => $data['departments'] = Department::pluck('name','id'),
                  'designations'  => $data['designations'] = Designation::pluck('name','id'),
                  'shifts'        => $data['shifts'] = Shift::pluck('name','id'),
                  'roles'         => $data['roles'] = UsersRole::pluck('name','id'),
                  'users'         => $data['users'] = get_organization_users(true)->pluck('name','id')
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
        $orgId = get_organization_id();
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
        $datalist =  [
                      'datalist'=>  $model,
                      'showColumns' => ['name'=>'Name','slug'=>'Slug','created_at'=>'Created'],
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
        $orgId = get_organization_id();
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
        $datalist =  [
                      'datalist'=>  $model,
                      'showColumns' => ['name'=>'Name','slug'=>'Slug','created_at'=>'Created'],
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
      $document = Document::with(['DocumentLayout' , 'DocumentTemplate'])->find($model->id);
      $document_content = view('organization.documents.preview',compact('document'))->render();
      $model = Document::find($model->id);
      $model->document_content = $document_content;
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

    /**
     * To update document and its content
     * @param  [type] $id having selected document id 
     * @return [type]   will show the form of document
     * @author Rahul
     */
    public function editDocument($id){
      $document = Document::where('id',$id)->first();
      $params = [
                  'departments'   => $data['departments'] = Department::pluck('name','id'),
                  'designations'  => $data['designations'] = Designation::pluck('name','id'),
                  'shifts'        => $data['shifts'] = Shift::pluck('name','id'),
                  'roles'         => $data['roles'] = UsersRole::pluck('name','id'),
                  'users'         => $data['users'] = org_user::pluck('name','id')
                ];
      return view('organization.documents.createDocument',compact(['document','params']));
    }

    /**
     * Update document content and details
     * @param  Request $request having all posted data
     * @return [type]           return back to same route
     * @author Rahul
     */
    public function updateDocument(Request $request){
        $updateArray = $request->except('_token','id');
        $document = Document::with(['DocumentLayout' , 'DocumentTemplate'])->find($request['id']);
        $document_content = view('organization.documents.preview',compact('document'))->render();
        $updateArray['document_content'] = $document_content;
        $upadte = Document::where('id',$request['id'])->update($updateArray);
        Session::flash('success','Document updated successfully!!');
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
        dd('Done');
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
      return $user_id;
    }
    public function documentDownload($id)
    {
        $document = Document::with(['DocumentLayout' , 'DocumentTemplate'])->find($id);
        view()->share('document',$document);
            $pdf = PDF::loadView('organization.documents.downloadPDF',compact('document'));
            return $pdf->download($document->title.'.pdf',compact('document'));
    }

    public function documentAssign(){

        return view('organization.documents.assign');
    }


    /**
     * Save Assign Document Form Request
     * @param  Request $request     have all the posted data by assign user
     * @param  [type]  $document_id having integer type document id
     * @return [type]               will return back to previous page from where post the requets
     */
    public function saveAssignDocument(Request $request, $document_id){

        $document = Document::with(['DocumentLayout' , 'DocumentTemplate'])->find($document_id);
        foreach($request->users as $key => $user){
            $model = AssignDocument::firstOrNew(['user_id'=>$user,'document_id'=>$document_id]);
            $model->user_id = $user;
            $model->document_id = $document_id;
            $model->save();
            $userModel = org_user::where(['id'=>$user])->first();
            if($request->send_email == 1){
                Mail::to($userModel->email)->send(new DocumentAssigned($document_id));
            }
        }
        Session::flash('success','Document assigned!');
        return redirect()->route('documents');
    }
}
