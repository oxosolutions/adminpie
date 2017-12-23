<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;

class FormData extends Model
{
    protected $fillable = ['form_title','form_slug','form_description','type','created_by'];
    protected $table    = '';
    
    public function __construct(){
        if(!empty(get_organization_id())){
            $this->table = Session::get('organization_id').'_forms_data';
        }
    }
}
