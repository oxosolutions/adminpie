<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;

class SupportComments extends Model
{
    protected $fillable = ['user_id','comment','attachments','ticket_id','status'];

    public function __construct(){
        if(!empty(get_organization_id())){
           $this->table = get_organization_id().'_support_tickets';
        }
    }
}
