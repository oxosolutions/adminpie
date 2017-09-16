<?php

namespace App\Http\Controllers\Organization\cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Page;
use App\Model\Organization\PageMeta;
use App\Model\Organization\Posts;
use App\Model\Organization\forms;
use App\Model\Organization\Cms\Menu\Menu;
use Auth;
use Session;

class PagesController extends Controller
{
    

    public function create()
    {
    	return view('organization.pages.create_page');
    }
    public function save(Request $request)
    {
        $tbl = Session::get('organization_id');
        $rules = [
                    'slug' => 'required|unique:'.$tbl.'_pages',
                    'title' => 'required'
                    ];
        $this->validate($request,$rules);
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
                        'showColumns' => ['title'=>'Title','slug'=>'Slug','created_at'=>'Created At','status'=>['type'=>'switch','title'=>'Change Status','class' => 'pageStatus']],
                        'actions' => [
                                        'edit'    => ['title'=>'Edit','route'=>'edit.pages','class'=>'edit'],
                                        'delete'  => ['title'=>'Delete','route'=>'delete.page'],
                                        'view'  => ['title'=>'View','route'=>'page.view']
                                    ]
                      ];
            return view('organization.pages.list_pages',$datalist);
        }
    public function edit($id)
    {
        $page = Page::where('id',$id)->with(['pageMeta'])->first();
       
        return view('organization.pages.edit_page',['page'=>$page]);
    }
    public function update(Request $request)
    {

        $data = [];
        foreach($request->except('_token') as $k => $v){
            $data[$k] = $v;
            if(is_array($v)){
                $data[$k] = json_encode($v);
            }
        }
        
        unset($data['template'],$data['id'],$data['select_status'],$data['menu']);
        $updatePage = Page::where('id',$request['id'])->update($data);
            
        $meta = $request->except('_token','title','slug','description','content','tags','id','categories');
        foreach ($meta as $key => $value) {
            $data = PageMeta::where(['page_id' => $request['id'] , 'key' => $key])->first();
            if($data == null){
                $model =  new PageMeta;
                $model->page_id = $request['id'];
                $model->key = $key;
                $model->value = $value;
                $model->save();
            }else{
                $model = PageMeta::where(['page_id' => $request['id'] , 'key'=>$key])->update(['value' => $value]);
            }
        }
        return back();
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

    //preview page
    public function viewPage($slug)
    {
        $pageData = Page::where('slug',$slug)->first();
        $form = [];
        $values= explode(PHP_EOL,@$pageData->description);
        if(@$values != null){

            foreach ($values as $key => $value) {
                preg_match_all('/\[(.*?)\]/' , $value , $matches ,PREG_PATTERN_ORDER );
                if($matches[0] != "" && !empty($matches[0])){
                    foreach($matches[0] as $k => $v){
                        preg_match('/(form_slug = (\"(.*)\"))|(form_slug = (\'(.*)\'))/', $v , $form_match );
                        $form[]['form'] = $form_match[3];
                    }        
                }else{
                    $form[] = $value;
                }
            }
        }
        $menu = [];
        $page = Page::where('id',$pageData->id)->with(['pageMeta'])->first();
         if($page->pageMeta != null){
            foreach ($page->pageMeta as $key => $value) {
                if($value->key == "menu"){
                   $menu = Menu::where('id',$value->value)->with('menuItem')->get();
                }
            }
        }
        // organization.pages.viewPage
        return view('organization.pages.viewPage')->with(['pageData' => $pageData , 'formData' => $form , 'menu' => $menu]);
    }
    public function menusList()
    {
       return view('organization.cms.menu.menu'); 
    }
    public function designSettings()
    {
       return view('organization.cms.design-setting.design-setting');
    }
    public function viewPageById($id)
    {
        $pageData = Page::where('id',$id)->first();
        return redirect()->route('page.slug',$pageData->slug);
    }
    //this is a temprary method for design purpose 
    public function pageView($slug)
    {
        $pageData = Page::where('slug',$slug)->first();
        $form = [];
        $values= explode(PHP_EOL,$pageData->description);
        if(@$values != null){

            foreach ($values as $key => $value) {
                preg_match_all('/\[(.*?)\]/' , $value , $matches ,PREG_PATTERN_ORDER );
                if($matches[0] != "" && !empty($matches[0])){
                    foreach($matches[0] as $k => $v){
                        preg_match('/(form_slug = (\"(.*)\"))|(form_slug = (\'(.*)\'))/', $v , $form_match );
                        $form[]['form'] = $form_match[3];
                    }        
                }else{
                    $form[] = $value;
                }
            }
        }
        // if(@$pageData->description != null){
        //     preg_match_all('/\[(.*?)\]/' , $pageData->description , $matches ,PREG_PATTERN_ORDER );
        //     if($matches[0] != "" && !empty($matches[0])){
        //         foreach($matches[0] as $k => $v){
        //             preg_match('/(form_slug = (\"(.*)\"))|(form_slug = (\'(.*)\'))/', $v , $form_match );
        //             $form[] = $form_match[3];
        //         }        
        //     }
        
        
        // }
        return view('common.front')->with(['pageData' => $pageData , 'formData' => $form]);
        // return view('common.front');
    }
    public function pageSetting($id)
    {
        return view('organization.pages.page-settings');
    }
    public function customeCode($id)
    {
        $model = PageMeta::where(['page_id' => $id])->get();

        if($model->isEmpty() ){
            $customCode = '';
        }else{
            $customCode = [];
            foreach($model as $key => $value){
                $customCode[$value->key] = $value->value;
            }
        }
        return view('organization.pages.custom-code',compact('customCode'));
    }
    public function saveCustomeCode(Request $request)
    {

        foreach ($request->except('_token') as $key => $value) {
            $data = PageMeta::where(['page_id' => $request['page_id'] , 'key' => $key])->first();
            if($data == null){
                $model =  new PageMeta;
                $model->page_id = $request['page_id'];
                $model->key = $key;
                $model->value = $value;
                $model->save();
            }else{
                $model = PageMeta::where(['page_id' => $request['page_id'] , 'key'=>$key])->update(['value' => $value]);
            }
        }
        return back();
    }
    public function updatePage(Request $request)
    {
        dd($request->all());
    }
}