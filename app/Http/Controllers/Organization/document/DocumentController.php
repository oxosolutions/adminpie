<?php

namespace App\Http\Controllers\Organization\document;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentController extends Controller
{
     public function index()
    {
    	return view('organization.documents.documents');
    }
    public function templates()
    {
    	return view('organization.documents.layouts');
    }
    public function layouts()
    {
    	return view('organization.documents.templates');
    }
}
