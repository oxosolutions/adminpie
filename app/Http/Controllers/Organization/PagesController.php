<?php

namespace App\Http\Controllers\Organization;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Page;

class PagesController extends Controller
{
    public function create()
    {
    	return view('organization.pages.create_page');
    }
    public function save(Request $request)
    {
        $page =   new Page();
        $page->fill($request->all());
        $page->save();
        return redirect()->route('list.pages');
    }
    public function list()
    {
      $pages =   Page::orderBy('id','desc')->get();
      return view('organization.pages.list_pages',['pages'=>$pages]);
    }
    public function edit($id)
    {
        $page = Page::where('id',$id)->first();
        return view('organization.pages.edit_page',['page'=>$page]);
    }
    public function update(Request $request)
    {
        $update = Page::find($request->id);
        if($request['status'] == 'true'){
            $request['status'] = 1;
        }else{
            $request['status'] = 0;
        }
        $update->fill($request->all());
        $update->post_type ="page";
        $update->save();
        return redirect()->route('list.pages');
    }

    // public function update(Request $request)
    // {
    //     dump($request->all());
    //     $update = Page::find($request->id);
    //     if($request['status'] == 'true'){
    //         $request['status'] = 1;
    //     }else{
    //         $request['status'] = 0;
    //     }
    //     $update->fill($request->all());
    //     $update->post_type ="page";
    //     $update->save();
    //     return redirect()->route('list.pages');
    // }

}
