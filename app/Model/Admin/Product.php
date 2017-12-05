<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Relations\Products as ProductRelations;

class Product extends Model
{
    use ProductRelations;

    public function __construct(){
        $this->table = $this->assignTable();
        $this->fillable = $this->putFillable();
    }
    
}
