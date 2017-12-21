<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    protected $fillable = ['user_id', 'title', 'description', 'type', 'assign_to', 'end', 'priority', 'status'];
}
