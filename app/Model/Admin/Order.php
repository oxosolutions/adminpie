<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
class Order extends Model
{
    protected $fillable = ['order_domain','order_status','organization_id'];

    protected $table = 'global_orders';


}
