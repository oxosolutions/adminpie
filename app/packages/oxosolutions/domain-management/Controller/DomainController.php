<?php

namespace App\Http\Controllers\Organization\domains;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DomainController extends Controller
{
    public function search(){
        
        return view('organization.domains.search');
    }
}
