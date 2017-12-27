<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class SupportTicket extends Model
{
    protected $fillable = ['user_id', 'subject', 'description', 'classification', 'assign_to', 'end', 'priority', 'status','attachment'];

    public function __construct(){
        if(!empty(Session::get('organization_id'))){
           $this->table = Session::get('organization_id').'_support_tickets';
        }
    }

    public function user(){
        return $this->belongsTo('App\Model\Group\GroupUsers','user_id','id');
    }

    public function periority(){
        return [
            'high' => 'High',
            'mediuum' => 'Medium',
            'low' => 'Low',
        ];
    }
}
