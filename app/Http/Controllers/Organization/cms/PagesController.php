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
    
    protected function assignModel($model){
        if(Auth::guard('admin')->check()){
            return 'App\\Model\\Admin\\'.$model;
        }else{
            return 'App\\Model\\Organization\\'.$model;
        }
    }

    public function create()
    {
    	return view('organization.pages.create_page');
    }
    public function save(Request $request)
    {
        $Associate = $this->assignModel('Page');
        if(Auth::guard('admin')->check() == true){
            $table = 'global_pages';
        }else{
            $tbl = Session::get('organization_id');
            $table = $tbl.'_pages';
        }

        $rules = [
                    'slug' => 'required|unique:'.$table,
                    'title' => 'required'
                    ];
        $this->validate($request,$rules);
        $page = new $Associate;
        $request->request->add(['type'=>'page']);
        $page->fill($request->all());
        $page->save();
        return back();
    }
    public function listPage(Request $request)
    {
        $Associate = $this->assignModel('Page');

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
        $order = $request->order;
        if($request->orderby == null || $request->orderby == ''){
          $sortedBy = 'created_at';
          $order = 'desc';
        }
            if($request->has('search')){
                if($sortedBy != ''){
                    $model = $Associate::where('type', 'page')->where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$order)->paginate($perPage);
                }else{
                    $model = $Associate::where('type', 'page')->where('name','like','%'.$request->search.'%')->paginate($perPage);
                }
            }else{
                if($sortedBy != ''){
                    $model = $Associate::where('type', 'page')->orderBy($sortedBy,$order)->paginate($perPage);
                }else{
                    $model = $Associate::where('type', 'page')->paginate($perPage);
                }
            }
            if(Auth::guard('admin')->check()){
                $view = 'admin.page.view';
                $edit = 'admin.edit.pages';
                $delete = 'admin.delete.page';
            }else{
                $view = 'page.view';
                $edit = 'edit.pages';
                $delete = 'delete.page';
            }
            $datalist =  [
                        'datalist'=>$model,
                        'showColumns' => ['title'=>'Title','slug'=>'Slug','created_at'=>'Created','status'=>['type'=>'switch','title'=>'Status','class' => 'pageStatus']],
                        'actions' => [
                                        'edit'    => ['title'=>'Edit','route'=> $edit ,'class'=>'edit'],
                                        'delete'  => ['title'=>'Delete','route'=>$delete],
                                        'view'  => ['title'=>'View','route'=> $view]
                                    ]
                      ];
            return view('organization.pages.list_pages',$datalist);
        }
    public function edit($id)
    {
        $Associate = $this->assignModel('Page');
        $page = $Associate::where('id',$id)->with(['pageMeta'])->first();
        
        return view('organization.pages.edit_page',['page'=>$page]);
    }
    public function update(Request $request)
    {
        $Associate = $this->assignModel('PageMeta');
        $AssociatePage = $this->assignModel('Page');
        $data = [];
        foreach($request->except('_token') as $k => $v){
            $data[$k] = $v;
            if(is_array($v)){
                $data[$k] = json_encode($v);
            }
        }
        
        unset($data['template'],$data['id'],$data['select_status'],$data['menu']);
        $updatePage = $AssociatePage::where('id',$request['id'])->update($data);
            
        $meta = $request->except('_token','title','slug','description','content','tags','id','categories');
        foreach ($meta as $key => $value) {
            $data = $Associate::where(['page_id' => $request['id'] , 'key' => $key])->first();
            if($data == null){
                $model =  new $Associate;
                $model->page_id = $request['id'];
                $model->key = $key;
                $model->value = $value;
                $model->save();
            }else{
                $model = $Associate::where(['page_id' => $request['id'] , 'key'=>$key])->update(['value' => $value]);
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
        $Associate = $this->assignModel('Page');

        $update = $Associate::find($request->id);
        if($request['status'] == 'true'){
            $status = 1;
        }else{
            $status = 0;
        }
        $odel = $Associate::where('id',$request->id)->update(['status' => $status]);
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
        $Associate = $this->assignModel('Page');

        $model = $Associate::find($id)->delete();
        return back();
    }



    //Posts
    public function listposts(Request $request)
    {
        $Associate = $this->assignModel('Posts');

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
                    $model = $Associate::where('type','posts')->where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
                }else{
                    $model = $Associate::where('type','posts')->where('name','like','%'.$request->search.'%')->paginate($perPage);
                }
            }else{
                if($sortedBy != ''){
                    $model = $Associate::where('type','posts')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
                }else{
                    $model = $Associate::where('type','posts')->paginate($perPage);
                }
            }
            if(Auth::guard('admin')->check()){
                $edit = 'admin.edit.posts';
                $delete = 'admin.delete.posts';
            }else{
                $edit = 'edit.posts';
                $delete = 'delete.posts';
            }

            $datalist =  [
                        'datalist'=>$model,
                        'showColumns' => ['title'=>'Title','created_at'=>'Created At','status'=>['type'=>'switch','title'=>'Change Status','class' => 'pageStatus']],
                        'actions' => [
                                        'edit'    => ['title'=>'Edit','route'=>$edit,'class'=>'edit'],
                                        'delete'  => ['title'=>'Delete','route'=>$delete]
                                    ]
                      ];
            return view('organization.posts.list_posts',$datalist);
    }

    public function editposts($id){
        $Associate = $this->assignModel('Page');

        $page = $Associate::where('id',$id)->first();
        return view('organization.posts.edit_post',['page'=>$page]);
    }
    public function savePosts(Request $request){
        $Associate = $this->assignModel('Page');

        $page =   new $Associate;
        $request->request->add(['type'=>'posts']);
        $page->fill($request->all());
        $page->save();
        return redirect()->route('list.posts');
    }
    public function updatePosts(Request $request){
        $Associate = $this->assignModel('Page');

        $update = $Associate::find($request->id);
        $update->fill($request->all());
        $update->post_type ="page";
        $update->save();
        return redirect()->route('list.posts');
    }
    public function deletePosts($id){
        $Associate = $this->assignModel('Page');

        $model = $Associate::find($id)->delete();
        return back();
    }
    public function updateStatusPosts(Request $request)
    {
        $Associate = $this->assignModel('Page');

        $update = $Associate::find($request->id);
        if($request['status'] == 'true'){
            $status = 1;
        }else{
            $status = 0;
        }
        $odel = $Associate::where('id',$request->id)->update(['status' => $status]);
        return "true";
    }

    //preview page
    public function viewPage($slug)
    {
        $Associate = $this->assignModel('Page');

        $pageData = $Associate::where('slug',$slug)->with('pageMeta')->first();
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
        $page = $Associate::where('id',$pageData->id)->with(['pageMeta'])->first();
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
        $Associate = $this->assignModel('Page');

        $pageData = $Associate::where('id',$id)->first();
        return redirect()->route('page.slug',$pageData->slug);
    }
    //this is a temprary method for design purpose 
    public function pageView($slug)
    {
        $Associate = $this->assignModel('Page');

        $pageData = $Associate::where('slug',$slug)->first();
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
        $Associate = $this->assignModel('PageMeta');

        $meta = $Associate::select(['key','value'])->where('page_id',$id)->get()->toArray();
        $model = [];
        foreach($meta as $k => $value){
            $model[$value['key']] = $value['value'];                
        }
        return view('organization.pages.page-settings',compact('model'));
    }
    public function savePageSetting( Request $request )
    {
        $Associate = $this->assignModel('PageMeta');

        $page_id = $request['page_id'];
        foreach ($request->except('_token','page_id') as $key => $value) {
            $model = $Associate::firstOrNew(['page_id'=>$page_id, 'key' => $key]);
            $model->page_id = $page_id;
            $model->key = $key;
            $model->value = $value;
            $model->save();
        }
        return back();
        
    }
    public function customeCode($id)
    {
        $Associate = $this->assignModel('PageMeta');

        $model = $Associate::where(['page_id' => $id])->get();

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
        $Associate = $this->assignModel('PageMeta');
        
       foreach ($request->except('_token') as $key => $value) {
            $data = $Associate::where(['page_id' => $request['page_id'] , 'key' => $key])->first();
            if($data == null){
                $model =  new $Associate;
                $model->page_id = $request['page_id'];
                $model->key = $key;
                $model->value = $value;
                $model->save();
            }else{
                $model = $Associate::where(['page_id' => $request['page_id'] , 'key'=>$key])->update(['value' => $value]);
            }
        }
        return back();
    }
    public function updatePage(Request $request)
    {
        dd($request->all());
    }
}