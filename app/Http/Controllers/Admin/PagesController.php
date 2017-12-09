<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Page;
use App\Model\Admin\PageMeta;
use Auth;
use Session;
class PagesController extends Controller
{	
	/**
	 * List of all pages of admin
	 * @param  Request $request posted data
	 * @return blade view output
	 * @author Rahul
	 */
	public function index(Request $request){
        $datalist = [];
        if($request->has('per_page')){
            $perPage = $request->per_page;
            if($perPage == 'all'){
              $perPage = 999999999999999;
            }
          }else{
            $perPage = 10;
          }
        $sortedBy = @$request->sort_by;
        $order = $request->order;
        if($request->orderby == null || $request->orderby == ''){
          $sortedBy = 'created_at';
          $order = 'desc';
        }
            if($request->has('search')){
                if($sortedBy != ''){
                    $model = Page::where('type', 'page')->where('title','like','%'.$request->search.'%')->orderBy($sortedBy,$order)->paginate($perPage);
                }else{
                    $model = Page::where('type', 'page')->where('title','like','%'.$request->search.'%')->paginate($perPage);
                }
            }else{
                if($sortedBy != ''){
                    $model = Page::where('type', 'page')->orderBy($sortedBy,$order)->paginate($perPage);
                }else{
                    $model = Page::where('type', 'page')->paginate($perPage);
                }
            }
            
            $view = 'admin.page.view';
            $edit = 'admin.edit.pages';
            $delete = 'admin.delete.page';
            
            $datalist =  [
                        'datalist'=>$model,
                        'showColumns' => ['title'=>'Title','slug'=>'Slug','created_at'=>'Created','status'=>['type'=>'switch','title'=>'Status','class' => 'pageStatus']],
                        'actions' => [
                                        'edit'    => ['title'=>'Edit','route'=> $edit ,'class'=>'edit'],
                                        'delete'  => ['title'=>'Delete','route'=>$delete,'class'=>'red'],
                                        'view'  => ['title'=>'View','route'=> $view]
                                    ]
                      ];
            return view('admin.pages.list_pages',$datalist);
	}

	/**
	 * to view created page inside admin layout
	 * @param  [string] $slug [page slug]
	 * @return [view]       [blade view output]
	 */
    public function viewPage($slug){

        $pageData = Page::where('slug',$slug)->with('pageMeta')->first();
        $form = [];
        
        return view('admin.pages.viewPage')->with(['pageData' => $pageData , 'formData' => $form ])->compileShortcodes();
    }

    /**
     * Edit content of page admin
     * @param  [integer] $id [contain page id]
     * @return [view]     [return balde view output]
     * @author Rahul
     */
    public function edit($id){
      
        $page = Page::where('id',$id)->with(['pageMeta'])->first();
        foreach ($page->pageMeta as $key => $value) {
            $page[$value['key']] = $value['value'];
        }
        return view('admin.pages.edit_page',['page'=>$page]);
    }

    /**
     * view page settings and change page settings
     * @param  [integer] $id [having page id]
     * @return [view]     [return blade view output]
     * @author Rahul
     */
    public function pageSetting($id){
        $meta = PageMeta::select(['key','value'])->where('page_id',$id)->get()->toArray();
        $model = [];
        foreach($meta as $k => $value){
            $model[$value['key']] = $value['value']; 
        }
        return view('admin.pages.page-settings',compact('model'));
    }

    /**
     * Custom css and js code
     * @param  [integer] $id [having page id]
     * @return [view]     [return balde view output]
     * @author Rahul
     */
    public function customeCode($id){

        $model = PageMeta::where(['page_id' => $id])->get();

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
        return view('admin.pages.custom-code',compact('customCode'));
    }

    /**
     * To save custom code of page
     * @param  Request $request [having posted data and instanse of request]
     * @return [back]           [will return back to same page]
     * @author Rahul
     */
    public function saveCustomeCode(Request $request){
        
       foreach ($request->except('_token') as $key => $value) {
            $data = PageMeta::where(['page_id' => $request['page_id'] , 'key' => $key])->first();
            if($value != null || $value != ''){
                $model = PageMeta::firstOrNew(['page_id' => $request['page_id'] , 'key'=>$key]);
                $model->page_id = $request['page_id'];
                $model->key = $key;
                $model->value = $value;
                $model->save();
            }
        }
        return back();
    }

    /**
     * Save Page Settings
     * @param  Request $request post data
     * @return back link
     */
    public function savePageSetting( Request $request ){

        $page_id = $request['page_id'];
        foreach ($request->except('_token','page_id') as $key => $value) {
            $model = PageMeta::firstOrNew(['page_id'=>$page_id, 'key' => $key]);
            $model->page_id = $page_id;
            $model->key = $key;
            $model->value = $value;
            $model->save();
        }
        return back();
    }

    /**
     * View page by page id
     * @param  [integer] $id [having page id]
     * @return [redirect]     [redirect to specific route]
     * @author Rahul
     */
    public function viewPageById($id){

        $pageData = Page::where('id',$id)->first();
        $route = 'admin.page.slug';
        return redirect()->route($route,$pageData->slug);
    }


    /**
     * Save page cotent
     * @param  Request $request [Having posted data instanse of request]
     * @return [back]           [will return back to same page]
     * @author Rahul
     * @lastUpdate sandeep [ woring on slug change camelCase to camel_case ]
     */
    public function save(Request $request){
        
        $table = 'global_pages';
        $rules = [
                    'slug' => 'required|unique:'.$table,
                    'title' => 'required'
                ];

        $this->validate($request,$rules);

        $output = parse_slug($request->slug);
        $request['slug'] = $output;

        $page = new Page;
        $request->request->add(['type'=>'page']);
        $page->fill($request->all());
        $page->save();
        Session::flash('success','Page created successfully');
        return back();
    }

    public function delete($id)
    {
        $model = Page::find($id)->delete();
        Session::flash('success','Deleted successfully');
        return back();
    }
    /**
     * Will update page content when user edit the page
     * @param  Request $request [having posted data instanse of request]
     * @return [back]           [will return back to same url]
     * @author Rahul
     */
    public function update(Request $request){
        $data = [];
        $table = 'global_pages';
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

}