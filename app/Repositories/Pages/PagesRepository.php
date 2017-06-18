<?php
namespace App\Repositories\Pages;
use App\Model\GlobalPage as Page;

class PagesRepository implements PagesRepositoryContract
{
	
	public function create($requestData=null){

		$page = new Page();
		$page->page_title = $requestData["page_title"];
		$page->content = $requestData['content'];
		$page->page_image ='img.jpeg';
		$page->status = 0;
		$page->created_by =13;
		$page->page_slug =$requestData['page_slug'];
		$page->save();
		return "successfully save pages";
	}
}

?> 