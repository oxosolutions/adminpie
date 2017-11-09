<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use App\Model\Organization\EmailLayout;
use Session;

class EmailTemplate extends Model
{
    public static $breadCrumbColumn = 'name';
    public function __construct()
	{
	    if(!empty(Session::get('organization_id')))
	    {
	    	$this->table = Session::get('organization_id').'_email_template';
	    }
	}
    protected $fillable = [ 'name','content','subject','slug','order'];
    public function listTemplate()
    {
        return self::pluck('name','id');
    }
    public function templateMeta()
    {
        return $this->hasMany('App\Model\Organization\EmailTemplateMeta','template_id','id');
    }
    
}
