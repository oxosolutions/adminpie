<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Relations\ProductMeta as ProductMetaRelations;
class ProductMeta extends Model
{
    use ProductMetaRelations;

    public function __construct(){

        $this->table = $this->assignTable();

        $this->fillable = $this->putFillable();
    }
}
