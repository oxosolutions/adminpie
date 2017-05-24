<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\Pages\PagesRepositoryContract;
use Illuminate\Http\UploadedFile;
use Artisan;


class PagesController extends Controller
{	
	protected $pages;
	public function __construct( PagesRepositoryContract $pages)
	{
		$this->pages = $pages;# code...
	}

	public function create()
	{
		return view('common.pages.Pages');
	}
	public function store(Request $request)
	{	
		echo $this->pages->create($request);
	}
}
