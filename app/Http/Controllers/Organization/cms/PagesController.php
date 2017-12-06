<?php

namespace App\Http\Controllers\Organization\cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Page;
use App\Model\Organization\Comment;
use App\Model\Organization\PageMeta;
use App\Model\Organization\Posts;
use App\Model\Organization\forms;
use App\Model\Organization\Cms\Menu\Menu;
use Auth;
use Session;
use App\Model\Admin\GlobalOrganization;
use Menu as wMenu;
use App\Model\Organization\OrganizationSetting;

class PagesController extends Controller
{
    
    protected function assignModel($model){
        if(Auth::guard('admin')->check()){
            return 'App\\Model\\Admin\\'.$model;
        }else{
            return 'App\\Model\\Organization\\'.$model;
        }
    }

    public function save_comment(Request $request){
        $page = Page::find($request->post_id);
            $comment = new Comment();
            $comment->comment = $request->comment;
            $comment->user_id = Auth::guard('org')->user()->id;
        $page->comments()->save($comment);

       return back();
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

        $output = parse_slug($request->slug);
        $request['slug'] = $output;

        $page = new $Associate;
        $request->request->add(['type'=>'page']);
        $page->fill($request->all());
        $page->save();
        Session::flash('success','Page created successfully');
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
            $perPage = get_items_per_page();;
          }
        $sortedBy = @$request->sort_by;
        $order = $request->order;
        if($request->orderby == null || $request->orderby == ''){
          $sortedBy = 'created_at';
          $order = 'desc';
        }
            if($request->has('search')){
                if($sortedBy != ''){
                    $model = $Associate::where('type', 'page')->where('title','like','%'.$request->search.'%')->orderBy($sortedBy,$order)->paginate($perPage);
                }else{
                    $model = $Associate::where('type', 'page')->where('title','like','%'.$request->search.'%')->paginate($perPage);
                }
            }else{
                if($sortedBy != ''){
                    $model = $Associate::where('type', 'page')->orderBy($sortedBy,$order)->paginate($perPage);
                }else{
                    $model = $Associate::where('type', 'page')->paginate($perPage);
                }
            }
            
            $view = 'page.view.byid';
            $edit = 'edit.pages';
            $delete = 'delete.page';
            
            // dd($view);
            $datalist =  [
                        'datalist'=>$model,
                        'showColumns' => ['title'=>'Title','slug'=>'Slug','created_at'=>'Created','status'=>['type'=>'switch','title'=>'Status','class' => 'pageStatus']],
                        'actions' => [
                                        'edit'    => ['title'=>'Edit','route'=> $edit ,'class'=>'edit'],
                                        'delete'  => ['title'=>'Delete','class'=>'red','route'=>$delete],
                                        'view'  => ['title'=>'View','route'=> $view]
                                    ]
                      ];
            return view('organization.pages.list_pages',$datalist);
        }
    public function edit($id)
    {
        $Associate = $this->assignModel('Page');
        $page = $Associate::where('id',$id)->with(['pageMeta'])->first();
            foreach ($page->pageMeta as $key => $value) {
                $page[$value['key']] = $value['value'];
            }
        return view('organization.pages.edit_page',['page'=>$page]);
    }
    public function update(Request $request)
    {
        $data = [];
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
        $output = parse_slug($request->slug);
        $request['slug'] = $output;

        $checkSlug = Page::where('id',$request['id'])->first();
        if($checkSlug->slug != $request->slug){
            $this->validate($request,$rules); 
        }
        foreach($request->except('_token') as $k => $v){
            if($k == 'content'){
                $data[$k] = $v;
                if(is_array($v)){
                    $data[$k] = json_encode($v);
                }
            }else{
                $data[$k] = $v;
            }
        }

        unset($data['template'],$data['id'],$data['select_status'],$data['menu']);
        $updatePage = Page::where('id',$request['id'])->update($data);

        $meta = $request->except('_token','title','slug','description','content','tags','id','categories');
        foreach ($meta as $key => $value) {
            if($value != null || $value != '' ){
                $model = PageMeta::firstOrNew(['page_id' => $request['id'] , 'key'=>$key]);
                $model->page_id = $request['id'];
                $model->key = $key;
                $model->value = $value;
                $model->save();
            }
        }
        Session::flash('success','Updated successfully');
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
        Session::flash('success','Page deleted successfully');
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
            $perPage = get_items_per_page();;
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
                        'showColumns' => ['title'=>'Title','created_at'=>'Created','status'=>['type'=>'switch','title'=>'Change Status','class' => 'pageStatus']],
                        'actions' => [
                                        'edit'    => ['title'=>'Edit','route'=>$edit,'class'=>'edit'],
                                        'delete'  => ['title'=>'Delete','class'=>'red','route'=>$delete]
                                    ]
                      ];
            return view('organization.posts.list_posts',$datalist);
    }

    public function editposts($id){
        $Associate = $this->assignModel('Page');
        $data = [];
        $page = $Associate::where('id',$id)->first();
        foreach ($page->toArray() as $key => $value) {
            $decode = json_decode($value);
            if(json_last_error() !== JSON_ERROR_NONE){
                $data[$key] = $value;
            }else{
                $data[$key] = json_decode($value);
            }
        }
        return view('organization.posts.edit_post',['page'=>$data]);
    }
    public function savePosts(Request $request){
        $Associate = $this->assignModel('Page');

        $page =   new $Associate;
        $request->request->add(['type'=>'posts']);
        $page->fill($request->all());
        $page->save();
        Session::flash('success','Post created successfully');
        return redirect()->route('list.posts');
    }
    public function updatePosts(Request $request){
        $tags= [];
        if($request->has('tags')){
            foreach (explode(',', $request->tags) as $key => $value) {
                if($value != ""){
                    $tags[] = $value;
                }
            }
        }
        $request['tags'] = $tags;

        $data = [];
        foreach ($request->all() as $key => $value) {
            if(is_array($value)){
                $data[$key] =  json_encode($value);
            }else{
                $data[$key] =  $value;
            }
        }
        $Associate = $this->assignModel('Page');

        $update = $Associate::find($request->id);
        $update->fill($data);
        $update->post_type ="page";
        $update->save();
        Session::flash('success','Updated successfully');
        return back();
        // return redirect()->route('list.posts');
    }
    public function deletePosts($id){
        $Associate = $this->assignModel('Page');

        $model = $Associate::find($id)->delete();
        Session::flash('success','Post deleted successfully');
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

    public function exportHTML(Request $request){
        if($request->isMethod('post')){
            $Associate = $this->assignModel('Page');
            $pages = $Associate::with('pageMeta')->whereIn('id',$request->export_page)->get();
            $menu = wMenu::wlist(6);
            $form = [];
            $organization_id = get_organization_id();
            foreach($pages as $key => $page){
                $html = view('organization.pages.viewPage')->with(['pageData' => $page , 'formData' => $form , 'menu' => $menu,'render'=>true])->render();
                if(!file_exists('export/'.get_organization_id())){
                    mkdir('export/'.$organization_id,0777,true);
                }
                file_put_contents('export/'.$organization_id.'/'.$page->slug.'.html', str_replace($request->root().'/page/', '', $html));
            }
            Session::flash('success','Pages exported successfully!!');
        }
        
        return view('organization.cms.export.form');
    }

    //preview page
    public function viewPage($slug)
    {
        $this->authOrganization();

        $Associate = $this->assignModel('Page');
        $pageData = $Associate::where('slug',$slug)->with('pageMeta')->first();
        $form = [];
        if($pageData == null){
            return view('errors.404');
        }
        $menu = wMenu::wlist(6);
        return view('organization.pages.viewPage')->with(['pageData' => $pageData , 'formData' => $form , 'menu' => $menu])->compileShortcodes();
    }

    protected function authOrganization(){

        $completeDomain = request()->getHost();
        $primary_domain =  is_primary_domain_exists($completeDomain);
        $secondary_domain = is_secondary_domain_exists($completeDomain);
        if($primary_domain == false){
            if($secondary_domain == false){
                $domain = explode('.', request()->getHost());
                $subdomain = $domain[0];
                $model = GlobalOrganization::where('slug',$subdomain)->first();
                if($model == null){
                    return redirect()->route('demo5');
                }
                Session::put('organization_id',$model->id);
            }else{
                Session::put('organization_id',$secondary_domain->id);
            }
        }else{
            Session::put('organization_id',$primary_domain->id);
        }
    }

    public function menusList()
    {
       return view('organization.cms.menu.menu'); 
    }
    public function designSettings(Request $request)
    {   
        if($request->isMethod('post')){
            $model = OrganizationSetting::firstOrNew(['key'=>'design_settings','type'=>'web']);
            $model->key = 'design_settings';
            $model->value = json_encode($request->except(['_token']));
            $model->type = 'web';
            $model->save();
            Session::flash('success','Settings saved successfully!');
        }
        $data = [];
        $model = OrganizationSetting::where(['key'=>'design_settings','type'=>'web'])->first();
        if($model != null){
            $data = json_decode($model->value,true);
        }
        return view('organization.cms.design-setting.design-setting',['model'=>$data]);
    }
    public function viewPageById($id)
    {
        
        $Associate = $this->assignModel('Page');
        $pageData = $Associate::where('id',$id)->first();
        
        $route = 'view.pages';
        return redirect()->route($route,$pageData->slug);
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
        return view('layouts.front')->with(['pageData' => $pageData , 'formData' => $form]);
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
        $AssociatePage = $this->assignModel('Page');
        $page = $AssociatePage::where('id',$id)->with(['pageMeta'])->first();

        return view('organization.pages.page-settings',compact('model','page'));
    }
    public function savePageSetting( Request $request )
    {
        $Associate = $this->assignModel('PageMeta');

        $page_id = $request['page_id'];
        foreach ($request->except('_token','page_id') as $key => $value) {
           
                $model = $Associate::firstOrNew(['page_id'=>$page_id, 'key' => $key]);
                $model->page_id = $page_id;
                $model->key = $key;
                if($value == null){
                    $model->value = '';
                }else{
                    $model->value = $value;
                }

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
                if($value != null || $value != ''){
                    $customCode[$value->key] = $value->value;
                }
            }
        }
        $AssociatePage = $this->assignModel('Page');
        $page = $AssociatePage::where('id',$id)->with(['pageMeta'])->first();
        if($page->type != 'posts'){
            return view('organization.pages.custom-code',compact('customCode','page'));
        }else{
            return view('organization.posts.custom-code',compact('customCode','page'));
        }
    }
    public function saveCustomeCode(Request $request)
    {
        $Associate = $this->assignModel('PageMeta');
        
       foreach ($request->except('_token') as $key => $value) {
            $data = $Associate::where(['page_id' => $request['page_id'] , 'key' => $key])->first();
            // if($data == null){
            //     $model =  new $Associate;
            //     $model->page_id = $request['page_id'];
            //     $model->key = $key;
            //     $model->value = $value;
            //     $model->save();
            // }else{
            //     $model = $Associate::where(['page_id' => $request['page_id'] , 'key'=>$key])->update(['value' => $value]);
            // }
            if($value != null || $value != ''){
                $model = $Associate::firstOrNew(['page_id' => $request['page_id'] , 'key'=>$key]);
                $model->page_id = $request['page_id'];
                $model->key = $key;
                $model->value = $value;
                $model->save();
            }
        }
        return back();
    }
    public function updatePage(Request $request)
    {
        dd($request->all());
    }
}