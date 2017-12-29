<?php

namespace App\Http\Controllers\Organization\support;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\SupportTicket;
use App\Model\Organization\User;
use Auth;
use App\Model\Organization\SupportComments;
use App\Model\Organization\SupportTicketMeta;
use Session;
class SupportsController extends Controller
{
    public function index()
    {
        return view('organization.support.ticket.list');

    }
    public function Categories()
     {
     	
     } 
     public function knowledgeBase()
     {
       $datalist =  [
                          'datalist' => [],
                          'showColumns' => ['category'=>'Category','description'=>'Description','posts'=>'Posts'],
                          'actions' => [
                                          'edit'    => ['title'=>'Edit','route'=>'edit.feedback','class'=>'edit'],
                                          'delete'  => ['title'=>'Delete','route'=>'delete.feedback']
                                       ]
                      ];
        return view('organization.support.knowledge-base',$datalist);
     }
     public function FAndQ()
     {
        return view('organization.support.faq');      
        
     }

     /**
      * List of all active tickets
      * @param  Request $request [having all posted data]
      * @return [type]           [object]
      */
     public function activeTickets(Request $request)
     {
        $datalist= [];
        $data= [];
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
                if(is_admin()){
                    $model = SupportTicket::with(['user'])->where('subject','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);    
                }else{
                    $model = SupportTicket::where('user_id',get_user_id())->with(['user'])->where('subject','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
                }
                
            }else{
                if(is_admin()){
                    $model = SupportTicket::with(['user'])->where('subject','like','%'.$request->search.'%')->paginate($perPage);
                }else{
                    $model = SupportTicket::where('user_id',get_user_id())->with(['user'])->where('subject','like','%'.$request->search.'%')->paginate($perPage);
                }
            }
        }else{
            if($sortedBy != ''){
                if(is_admin()){
                    $model = SupportTicket::with(['user'])->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
                }else{
                    $model = SupportTicket::where('user_id',get_user_id())->with(['user'])->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
                }
            }else{
                if(is_admin()){
                    $model = SupportTicket::with(['user'])->paginate($perPage);
                }else{
                    $model = SupportTicket::where('user_id',get_user_id())->with(['user'])->paginate($perPage);
                }
            }
        }
        $datalist =  [
                      'datalist' => $model,
                      'showColumns' => ['subject'=>'Subject','id'=>'Ticket ID','priority'=>'Priority','last_reply'=>'Last Reply','status'=>'Status','assign_to'=>'Assign To','user.name'=>'Auther'],
                      'actions' => [
                                      'edit'    => ['title'=>'Edit','route'=>'edit.ticket','class'=>'edit'],
                                      'delete'  => ['title'=>'Delete','route'=>'delete.ticket']
                                   ]
                  ];
        return view('organization.support.ticket.list',$datalist);         
    }
     public function completedTickets() 
     {  
         dd('work not done yet');
         $datalist =  [
                          'datalist' => [],
                          'showColumns' => ['Ticket ID'=>'Ticket ID','subject'=>'Subject','priority'=>'Priority','last_reply'=>'Last Reply','status'=>'Status','assign_to'=>'Assign To','auther'=>'Auther'],
                          'actions' => [
                                          'edit'    => ['title'=>'Edit','route'=>'edit.feedback','class'=>'edit'],
                                          'delete'  => ['title'=>'Delete','route'=>'delete.feedback']
                                       ]
                      ];
         return view('organization.support.ticket.list',$datalist);
     }
     public function ticketSettings()
     {
         return view('organization.support.ticket.settings');
     }
    public function create(){

        return view('organization.support.ticket.add');   
    }

    protected function validateCreateTicketRequest($request){
        $rules = [
                'classification' => 'required',
                'subject' => 'required',
                'priority' => 'required'
        ];

        $this->validate($request,$rules);
    }

    /**
     * Save requested ticket data
     * @param  Request $request [have requested data]
     * @return [type]           [object]
     */
    public function save(Request $request){
        $this->validateCreateTicketRequest($request);
        $model = new SupportTicket;
        $model->classification = $request->classification;
        $model->subject = $request->subject;
        $model->description = $request->description;
        $model->priority = $request->priority;
        $filePath = upload_path('support_ticket_attachments');
        $uploadedAttachmentsName = [];
        if($request->hasFile('related_image')){
            foreach($request->file('related_image') as $key => $attachment){
                $filename = $attachment->getClientOriginalName();
                $uploadedAttachmentsName[] = $filename;
                $attachment->move($filePath, $filename);
            }
            $model->attachment = json_encode($uploadedAttachmentsName);
        }
        $model->status = 1;

        if($request->has('behalf_of')){
            $model->user_id  = $request->behalf_of;
        }else{
            $model->user_id = Auth::guard('org')->user()->id;
        }
        $model->save();
        Session::flash('success','Ticket created successfully!');
        return redirect()->route('active.tickets');
    }


    public function edit($id){
        $model = SupportTicket::find($id);
        $comments = SupportComments::with(['user_role_map'=>function($query){
            $query->with('roles');
        }])->where('ticket_id',$id)->get();
        $model['assignee'] = $model->assign_to;
        $date = strtotime($model->end);
        $model['change_due_date'] = date('Y-m-d',$date);
        return view('organization.support.ticket.edit',['model'=>$model,'comments'=>$comments]);
    }

    /**
     * update existing ticket details and status
     * @param  Request $request  having all posted data
     * @param  [integer]  $id   [having ticket id to update]
     * @return [type]           [view]
     * @author Rahul
     */
    public function update(Request $request, $id){
        $this->validateCreateTicketRequest($request);
        $model = SupportTicket::find($id);
        $model->classification = $request->classification;
        $model->subject = $request->subject;
        $model->description = $request->description;
        $model->priority = $request->priority;
        $filePath = upload_path('support_ticket_attachments');
        if($request->hasFile('related_image')){
            $filename = $request->file('related_image')->getClientOriginalName();
            $request->file('related_image')->move($filePath, $filename);
            $model->attachment = $filename;
        }
        $model->status = 1;
        $model->user_id = Auth::guard('org')->user()->id;
        $model->save();
        Session::flash('success','Ticket updated successfully!');
        return redirect()->route('active.tickets');
    }

    public function delete($id){
        $model = SupportTicket::find($id);
        $model->delete();
        Session::flash('success','Ticket deleted successfully!');
        return redirect()->route('active.tickets');
    }
     
    public function viewTicket(){
        return view('organization.support.ticket.view');
         
    }

    /**
     * Update ticket details
     * @param  Request $request having posted data
     * @return [type]           return back to same route
     */
    public function assignTicket(Request $request){
        $model = SupportTicket::find($request->route()->ticket_id);
        $model->assign_to = $request->assignee;
        $model->classification = $request->classification;
        $model->priority = $request->priority;
        $model->end = $request->change_due_date;
        $model->save();
        Session::flash('success','Ticket updated successfully!');
        return back();
    }

    public function validateCommentPost($request){
        $rules = [
            'comment' => 'required'
        ];

        $this->validate($request,$rules);
    }

    /**
     * Post comment and attachment on ticket
     * @param  Request $request [description]
     * @return [type]           [description]
     * @author Rahul
     */
    public function postComment(Request $request){
        $this->validateCommentPost($request);
        $model = new SupportComments;
        if($request->hasFile('attachment')){
            $attachedFiles = [];
            foreach($request->attachment as $key => $attachment){
                $path = upload_path('comments_attachments');
                $filename = $attachment->getClientOriginalName();
                $attachedFiles[] = $filename;
                $attachment->move($path, $filename);
            }
            $model->attachments = json_encode($attachedFiles);
        }
        $model->comment = $request->comment;
        $model->ticket_id = $request->ticket_id;
        $model->user_id = get_user_id();
        $model->save();
        Session::flash('success','Comment posted successfully!');
        return back();
    }

}
