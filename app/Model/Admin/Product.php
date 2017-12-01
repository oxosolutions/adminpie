<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Relations\Products as ProductRelations;

class Product extends Model
{
    use ProductRelations;

    protected $table = 'ocrm_products';

    protected $fillable = [''];
    
}
