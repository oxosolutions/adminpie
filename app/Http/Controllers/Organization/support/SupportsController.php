<?php

namespace App\Http\Controllers\Organization\support;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


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
     public function activeTickets()
     {
            // dd('Here');
            // $datalist =  [
            //               'datalist' => [],
            //               'showColumns' => ['Ticket ID'=>'Ticket ID','subject'=>'Subject','priority'=>'Priority','last_reply'=>'Last Reply','status'=>'Status','assign_to'=>'Assign To','auther'=>'Auther'],
            //               'actions' => [
            //                               'edit'    => ['title'=>'Edit','route'=>'edit.feedback','class'=>'edit'],
            //                               'delete'  => ['title'=>'Delete','route'=>'delete.feedback']
            //                            ]
            //           ];
        return view('organization.support.ticket.list');         
    }
     public function completedTickets() 
     {  
        
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
     public function addTicket()
     {
        return view('organization.support.ticket.add');   
     }
     public function viewTicket()
     {
        return view('organization.support.ticket.view');
         
     }

}
