<?php

namespace App\Http\Controllers\Organization\cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Page;
use App\Model\Organization\Posts;

class PagesController extends Controller
{
    public function create()
    {
    	return view('organization.pages.create_page');
    }
    public function save(Request $request)
    {
        $page =   new Page();
        $request->request->add(['type'=>'page']);
        $page->fill($request->all());
        $page->save();
        return redirect()->route('list.pages');
    }
    public function listPage(Request $request)
    {
        $datalist = [];
        if($request->has('per_page')){
            $perPage = $request->per_page;
            if($perPage == 'all'){
              $perPage = 999999999999999;
            }
          }else{
            $perPage = 5;
          }
        $sortedBy = @$request->sort_by;
            if($request->has('search')){
                if($sortedBy != ''){
                    $model = Page::where('type', 'page')->where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
                }else{
                    $model = Page::where('type', 'page')->where('name','like','%'.$request->search.'%')->paginate($perPage);
                }
            }else{
                if($sortedBy != ''){
                    $model = Page::where('type', 'page')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
                }else{
                    $model = Page::where('type', 'page')->paginate($perPage);
                }
            }
            $datalist =  [
                        'datalist'=>$model,
                        'showColumns' => ['title'=>'Title','created_at'=>'Created At','status'=>['type'=>'switch','title'=>'Change Status','class' => 'pageStatus']],
                        'actions' => [
                                        'edit'    => ['title'=>'Edit','route'=>'edit.pages','class'=>'edit'],
                                        'delete'  => ['title'=>'Delete','route'=>'delete.page']
                                    ]
                      ];
            return view('organization.pages.list_pages',$datalist);
        }
    public function edit($id)
    {
        $page = Page::where('id',$id)->first();
        return view('organization.pages.edit_page',['page'=>$page]);
    }
    public function update(Request $request)
    {
        $update = Page::find($request->id);
        $update->fill($request->all());
        $update->post_type ="page";
        $update->save();
        return redirect()->route('list.pages');
    }
    /**
     * @param  none
     * @return [true]
     * @request_type [ajax(POSt)]
     * @description [ajax method to change the status of the page as Enable or Disable]
     * @createdBy [sandeep 18 july]
     * @updatedBy [_____________]
     */
    public function updateStatus(Request $request)
    {
        $update = Page::find($request->id);
        if($request['status'] == 'true'){
            $status = 1;
        }else{
            $status = 0;
        }
        $odel = Page::where('id',$request->id)->update(['status' => $status]);
        return "true";
    }
    /**
     * @param  none
     * @return [true]
     * @request_type [ajax(POSt)]
     * @description [ajax method to Delete the page]
     * @createdBy [sandeep 18 july]
     * @updatedBy [_____________]
     */
    public function delete($id)
    {
        $model = Page::find($id)->delete();
        return back();
    }



    //Posts
    public function listposts(Request $request)
    {
        $datalist = [];
        if($request->has('per_page')){
            $perPage = $request->per_page;
            if($perPage == 'all'){
              $perPage = 999999999999999;
            }
          }else{
            $perPage = 5;
          }
        $sortedBy = @$request->sort_by;
            if($request->has('search')){
                if($sortedBy != ''){
                    $model = Posts::where('type','posts')->where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
                }else{
                    $model = Posts::where('type','posts')->where('name','like','%'.$request->search.'%')->paginate($perPage);
                }
            }else{
                if($sortedBy != ''){
                    $model = Posts::where('type','posts')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
                }else{
                    $model = Posts::where('type','posts')->paginate($perPage);
                }
            }
            $datalist =  [
                        'datalist'=>$model,
                        'showColumns' => ['title'=>'Title','created_at'=>'Created At','status'=>['type'=>'switch','title'=>'Change Status','class' => 'pageStatus']],
                        'actions' => [
                                        'edit'    => ['title'=>'Edit','route'=>'edit.posts','class'=>'edit'],
                                        'delete'  => ['title'=>'Delete','route'=>'delete.posts']
                                    ]
                      ];
            return view('organization.posts.list_posts',$datalist);
    }

    public function editposts($id){
        $page = Page::where('id',$id)->first();
        return view('organization.posts.edit_post',['page'=>$page]);
    }
    public function savePosts(Request $request){
        $page =   new Page();
        $request->request->add(['type'=>'posts']);
        $page->fill($request->all());
        $page->save();
        return redirect()->route('list.posts');
    }
    public function updatePosts(Request $request){
        $update = Page::find($request->id);
        $update->fill($request->all());
        $update->post_type ="page";
        $update->save();
        return redirect()->route('list.posts');
    }
    public function deletePosts(){
        $model = Page::find($id)->delete();
        return back();
    }
    public function updateStatusPosts(Request $request)
    {
        $update = Page::find($request->id);
        if($request['status'] == 'true'){
            $status = 1;
        }else{
            $status = 0;
        }
        $odel = Page::where('id',$request->id)->update(['status' => $status]);
        return "true";
    }







}
