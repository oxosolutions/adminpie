<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Applicant;
use App\Model\Organization\ApplicantMeta; 
use App\Repositories\User\UserRepositoryContract;
use App\Model\Organization\Application;
use App\Model\Organization\ApplicationMeta;

use Session;


class ApplicationController extends Controller
{
	public function index(){

	$application = 	Application::with('application_meta')->get();
	dd($application);

    	
    }    
}
