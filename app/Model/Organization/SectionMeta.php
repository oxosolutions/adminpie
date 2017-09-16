<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;

use Session;

class SectionMeta extends Model
{
	// protected $table = 'global_form_section_meta';
  protected $fillable =['section_id', 'key', 'value']; 
	public function __construct(){
      
          if(!empty(Session::get('organization_id'))){
            $this->table = Session::get('organization_id').'_form_section_meta';
          }
        
    }
    
}
