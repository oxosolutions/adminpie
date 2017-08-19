<?php

namespace App\Http\Controllers\Organization\email;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\EmailLayout;
use App\Model\Organization\EmailTemplate;
use Auth;
use Session;
use App\Model\Organization\Department;
use App\Model\Organization\Designation;
use App\Model\Organization\Shift;
use App\Model\Organization\UsersRole;
use App\Model\Organization\User;
use App\Model\Organization\Campaign;
use App\Model\Organization\UsersMeta;
use Illuminate\Support\Facades\Mail;
use App\Mail\CampaignEmail;
class EmailController extends Controller
{
    public function index(Request $request)
    {
        $search = $this->saveSearch($request);
        if($search != false && is_array($search)){
            $request->request->add(['items'=>@$search['items'],'orderby'=>@$search['orderby'],'order'=>@$search['order']]);
        }
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
                  $model = Campaign::where('campaign_name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
              }else{
                  $model = Campaign::where('campaign_name','like','%'.$request->search.'%')->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = Campaign::orderBy($sortedBy,$request->order)->paginate($perPage);
              }else{
                   $model = Campaign::paginate($perPage);
              }
          }
          $datalist =  [
                          'datalist'=>  $model,
                          'showColumns' => ['campaign_name'=>'Name','created_at'=>'Created At'],
                          'actions' => [
                                          'edit' => ['title'=>'Edit','route'=>'edit.campaign' , 'class' => 'edit'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.email']
                                       ],
                          'js'  =>  ['custom'=>['list-designation']],
                          'css'=> ['custom'=>['list-designation']]
                      ];
    	return view('organization.emails.index',$datalist);
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
    public function sendEmail($id = null)
    {
        $data['layouts'] = EmailLayout::pluck('name','id');
        $data['templates'] = EmailTemplate::pluck('name','id');
        $data['departments'] = Department::pluck('name','id');
        $data['designations'] = Designation::pluck('name','id');
        $data['shifts'] = Shift::pluck('name','id');
        $data['roles'] = UsersRole::pluck('name','id');
        $data['users'] = User::pluck('name','id');
        if($id != null){
            $model = Campaign::find($id);
            $model->send_to = json_decode($model->send_to);
            $selected_users = json_decode($model->selected_users, true);
            $selected_users_array = [];
            array_walk($selected_users, function($value, $key) use (&$selected_users_array){
            	$selected_users_array[$key] = array_map('intval',$value);
            });
            $model->selected_users = $selected_users_array;
            $data['model'] = $model;
        }
        return view('organization.emails.send-email',$data);
    }

    protected function sendMailToUsers($sendTo,$layout,$template){
    	Mail::to($sendTo)->send(new CampaignEmail($layout, $template));
    }

    public function saveCampaign(Request $request){
    	$userEmails = [];
        $userIds = [];
    	foreach($request->users as $key => $values){
    		if($key == 'users'){
    			$users = User::whereIn('id',$values)->get();
    			foreach($users as $k => $value){
    				$userEmails[] = $value->email;
                    $userIds[] = $value->id;
    			}
    		}else{
    			$userMeta = UsersMeta::with(['user'])->where('key',$key)->whereIn('value',$values)->get();
	    		foreach($userMeta as $k => $meta){
	    			$userEmails[] = $meta->user->email;
                    $userIds[] = $meta->user->id;
	    		}
    		}
    	}
    	$sendTo = array_unique($userEmails);
        $userIds = array_unique($userIds);
        $this->validateCampaignForm($request);
        $model = new Campaign;
        $model->campaign_name = $request->campaign_name;
        $model->campaign_desc = $request->campaign_desc;
        $model->send_to = json_encode($request->send_to);
        $model->selected_users = json_encode($request->users);
        $model->layout = $request->layout;
        $model->template = $request->template;
        $model->send_to_users = json_encode($userIds);
        $scheduleStatus = false;
        if($request->date != null && $request->time != null){
            $model->scheduled = 1;
            $model->exec_time = $request->date.' '.$request->time;
            $scheduleStatus = true;
        }
        $model->save();
        if($scheduleStatus == false){
        	$this->sendMailToUsers($sendTo, $request->layout, $request->template);
        }
        return back();
    }

    protected function validateCampaignForm($request){
        $rules = [
                'campaign_name' => 'required',
                'campaign_desc' => 'required',
                'layout' => 'required',
                'template' => 'required'
        ];
        $this->validate($request,$rules);
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
    protected function saveSearch($request){
        $search = $request->except(['page']);
        $model = UsersMeta::where(['key'=>$request->route()->uri,'user_id'=>Auth::guard('org')->user()->id])->first();
        if($model != null){
            if(!empty($request->except(['page']))){
              $model->value = json_encode($request->except(['page']));
              $model->save();
            }
            $savedSearch = json_decode($model->value, true);
            return $savedSearch;
        }else{
            $model = new UsersMeta;
            $model->user_id = Auth::guard('org')->user()->id;
            $model->key = $request->route()->uri;
            $model->value = json_encode(@$request->except(['page']));
            $model->save();
            return false;
        }
    }

    public function deleteEmail($id){
        $model = Campaign::find($id);
        $model->delete();
        Session::flash('success','Successfully deleted!');
        return back();
    }

}
