<?php

namespace App\Http\Controllers\Organization\cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Cms\Menu\Menu;
use App\Model\Organization\Cms\Menu\MenuItem;
use App\Model\Organization\Page;
use App\Model\Organization\Posts;
use Auth;
class MenuController extends Controller
{
    protected function assignModel($model){
        if(Auth::guard('admin')->check()){
            return 'App\\Model\\Admin\\'.$model;
        }else{
            return 'App\\Model\\Organization\\Cms\\Menu\\'.$model;
        }
    }
    protected function pageModel($model){
        if(Auth::guard('admin')->check()){
            return 'App\\Model\\Admin\\'.$model;
        }else{
            return 'App\\Model\\Organization\\'.$model;
        }
    }
    public function index(Request $request )
    {
      $AssignModel = $this->assignModel('Menu');
        if($request->has('items')){
          $perPage = $request->items;
          if($perPage == 'all'){
            $perPage = 999999999999999;
          }
        }else{
          $perPage = 5;
        }
        $sortedBy = @$request->orderby;
        if($request->has('search')){
            if($sortedBy != ''){
                $model = $AssignModel::where('title','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                $model = $AssignModel::where('title','like','%'.$request->search.'%')->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $exploded = @explode(':',$sortedBy);
                if(isset($exploded[1])){
                    $sortedBy = $exploded[0];
                }
                $model = $AssignModel::orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                 $model = $AssignModel::paginate($perPage);
            }
        }
        if(Auth::guard('admin')->check() == true){
          $edit = 'admin.edit.menu';
          $delete = 'admin.delete.menu';
        }else{
          $edit = 'edit.menu';
          $delete = 'delete.menu';
        }
        $datalist =  [
                        'datalist'    => $model,
                        'showColumns' => ['title'=>'Title','description'=>'Description','slug' => 'Slug' ,'created_at'=>'Created'],
                        'actions'     => [
                                            'edit' => ['title'=>'Edit','route'=>$edit],
                                            'delete'=>['title'=>'Delete','route'=>$delete]
                                         ]
                    ];
        return view('organization.cms.menu.menu' , $datalist);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $AssignModel = $this->assignModel('Menu');

        $last_order = $AssignModel::select('order')->orderBy('order','DESC')->first();
        if($last_order != null){
            $order = $last_order->order+1;
        }else{
            $order = 1;
        }
        $request['order'] = $order;
        
        $model = new $AssignModel;
        $model->fill($request->except('_token','action'));
        $model->save();
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $AssignModel = $this->assignModel('Menu');
      $MenuItem = $this->assignModel('MenuItem');
      $pageModel = $this->pageModel('Page');

        $menu = $AssignModel::where('id',$id)->first();
        $menuItem = $MenuItem::where('menu_id',$id)->get();
        $pages = $pageModel::where('type' , 'page')->with(['MenuItem'])->get();
        $posts = $pageModel::where('type' , 'posts')->with(['MenuItem'])->get();
        $selectedPage = $MenuItem::all();
        return view('organization.cms.menu.edit-menu',compact(['menu', 'menuItem','pages','posts','selectedPage']));
    }

    public function delete($id)
    {
      $AssignModel = $this->assignModel('Menu');

        $model = $AssignModel::where('id',$id)->delete();
        return back();
    }
    public function createMenuItem(Request $request)
    {
      $MenuItem = $this->assignModel('MenuItem');

       $item = new $MenuItem;
       $item->fill($request->except('_token'));
       $item->save();

       return back();
    }
    public function updateMenuItem(Request $request){
      $MenuItemModel = $this->assignModel('MenuItem');

        $last_order = $MenuItemModel::where([ 'menu_id' => $request['menu_id'] ])->orderBy('order','DESC')->first();
          if($last_order != null){
              $order = $last_order->order+1;
          }else{
              $order = 1;
          }
        if(@$request['form_data'] != null){
            $form_data = [];
            foreach ($request->form_data as $key => $value) {
                if($key != '_token'){
                    $form_data[$key] = $value;
                } 
            }

            $model = $MenuItemModel::where('id',$request->form_data['id'])->update($form_data);
            $selectedPage = $MenuItemModel::where([ 'menu_id' => $request['menu_id']])->get();
            return view('organization.cms.menu.menu-item',compact('selectedPage'))->render();
        }else{
            $MenuItem = $MenuItemModel::where([ 'menu_id' => $request['menu_id'] , 'page_id' => $request['data_id']])->first();
            if($MenuItem == null){
              ;
              $pageModel = $this->pageModel('Page');

                $pages = $pageModel::find($request['data_id']);
                
                if(@$pages->slug != null){
                    $page_slug = $pages->slug;
                    $link = asset('page/'.$page_slug);
                    
                    $model = new $MenuItemModel;
                    $model->menu_id = $request['menu_id'];
                    $model->page_id = $request['data_id'];
                    $model->label = $request['data_title'];
                    $model->type = $request['dataType'];
                    $model->order = $order;
                    $model->link = $link;
                    $model->save();

                   
                    $selectedPage = $MenuItemModel::where([ 'menu_id' => $request['menu_id']])->get();
                    return view('organization.cms.menu.menu-item',compact('selectedPage'))->render();
                }else{
                    return 'slug_error';

                }
            }else{
                $delete = $MenuItemModel::where([ 'menu_id' => $request['menu_id'] , 'page_id' => $request['data_id']])->delete();
                $selectedPage = $MenuItemModel::where([ 'menu_id' => $request['menu_id']])->get();
                return view('organization.cms.menu.menu-item',compact('selectedPage'))->render();
            }
        }
        

        
    }
    public function changeOrder( Request $request )
    {
      $data = [];
      $index = 1;
      $MenuItemModel = $this->assignModel('MenuItem');      
      foreach ($request['request'] as $key => $value) {
        $data[$value] = $index;
        $index++;
      }
      foreach($data as $k => $v){
        $model = $MenuItemModel::where('id' ,$k )->update(['order' => $v]);
      }        
      return 'true';
    }
    // public function updateMenuItem(Request $request)
    // {
    //     $model = MenuItem::where('id',$request['id'])->update($request->except('_token','id'));
        
    //     return back();
    // }
    public function DeleteMenuItem($id)
    {
      $MenuItemModel = $this->assignModel('MenuItem');      
        $item = $MenuItemModel::where(['id'=>$id])->delete();
        return back();
    }
    public function getMenuItem(Request $request)
    {
      $MenuItemModel = $this->assignModel('MenuItem');      
        $model = $MenuItemModel::where('id',$request['id'])->first();
        return view('organization.cms.menu.menu-item',compact('model'))->render();
    }
    public function getMenuItems(Request $request)
    {
      $MenuItemModel = $this->assignModel('MenuItem');      
        $selectedPage = $MenuItemModel::where(['menu_id' => $request['menu_id']])->orderBy('order','ASC')->get();
        return view('organization.cms.menu.menu-item',compact('selectedPage'))->render();
    }
}
