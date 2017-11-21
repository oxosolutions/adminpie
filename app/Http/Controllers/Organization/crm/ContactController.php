<?php

namespace App\Http\Controllers\Organization\crm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Contact;
use App\Model\Organization\ContactMeta;
class ContactController extends Controller
{
    public function index(Request $request){
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
                  $model = Contact::where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
              }else{
                  $model = Contact::where('name','like','%'.$request->search.'%')->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = Contact::orderBy($sortedBy,$request->order)->paginate($perPage);
              }else{
                   $model = Contact::paginate($perPage);
              }
          }
          // dd($model);
          $datalist =  [
                          'datalist'=>  $model,
                          'showColumns' => ['name'=>'Name','email'=>'Email','created_at'=>'Created'],
                          'actions' => [
                                          'edit' => ['title'=>'Edit','route'=>'contact.edit' , 'class' => 'edit'],
                                          // 'view' => ['title'=>'View','route'=>'view.client' , 'class' => 'view'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.contact']
                                       ],
                          'js'  =>  ['custom'=>['list-designation']],
                          'css'=> ['custom'=>['list-designation']]
                      ];
    	return view('organization.crm.contact.list',$datalist);
    }

    public function saveContact(Request $request){
    	$rules = [
    							'name'=>'required',
    							'email' => 'required|email'
    				   ];
    	$this->validate($request,$rules);
    	$model = new Contact;
    	$model->name = $request->name;
    	$model->email = $request->email;
    	$model->save();
    	foreach($request->except(['name','email','action']) as $key => $value){
    		$metaModel = new ContactMeta;
    		$metaModel->contact_id = $model->id;
    		$metaModel->key = $key;
    		$metaModel->value = $value;
    		$metaModel->save();
    	}
    	return back();
    }

    public function edit($id){
    	$model = Contact::find($id);
    	$contactMeta = ContactMeta::where('contact_id',$id)->get();
    	foreach($contactMeta as $key => $value){
    		$model[$value->key] = $value->value;
    	}
    	return view('organization.crm.contact.edit',['model'=>$model]);
    }

    public function update(Request $request, $id){
    	$rules = [
    							'name'=>'required',
    							'email' => 'required|email'
    				   ];
    	$this->validate($request,$rules);
    	$model = Contact::find($id);
    	$model->name = $request->name;
    	$model->email = $request->email;
    	$model->save();
    	foreach($request->except(['name','email','action']) as $key => $value){
    		$metaModel = ContactMeta::firstOrNew(['contact_id'=>$id]);
    		$metaModel->contact_id = $model->id;
    		$metaModel->key = $key;
    		$metaModel->value = $value;
    		$metaModel->save();
    	}
    	return redirect()->route('contact.list');
    }

    public function delete($id){
    	$model = Contact::find($id);
    	$model->delete();
    	ContactMeta::where('contact_id',$id)->delete();
    	return redirect()->route('contact.list');
    }
}
