<?php

namespace App\Model\Organization;
use Session;
use Illuminate\Database\Eloquent\Model;
class FormData extends Model
{
    protected $table    = '';
    
    public function __construct(){
        if(!empty(get_organization_id())){
            $form_id =  Session::get('form_id');
            $this->table = get_organization_id().'_form_data_'.$form_id;
        }
    }
}
