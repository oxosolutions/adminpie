<?php

namespace App\Http\Controllers\Organization\cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Cms\Menu\Menu;
use App\Model\Organization\Cms\Menu\MenuItem;
use App\Model\Organization\Page;
use App\Model\Organization\Posts;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request )
    {

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
                $model = Menu::where('title','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                $model = Menu::where('title','like','%'.$request->search.'%')->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $exploded = @explode(':',$sortedBy);
                if(isset($exploded[1])){
                    $sortedBy = $exploded[0];
                }
                $model = Menu::orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                 $model = Menu::paginate($perPage);
            }
        }
        $datalist =  [
                        'datalist'=>$model,
                        'showColumns' => ['title'=>'Title','description'=>'Description','created_at'=>'Created At'],
                        'actions' => [
                                        'edit' => ['title'=>'Edit','route'=>'edit.menu'],
                                        'delete'=>['title'=>'Delete','route'=>'delete.menu']
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
        $last_order = Menu::select('order')->orderBy('order','DESC')->first();
        if($last_order != null){
            $order = $last_order->order+1;
        }else{
            $order = 1;
        }
        $request['order'] = $order;
        
        $model = new Menu;
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
        $menu = Menu::where('id',$id)->first();
        $menuItem = MenuItem::where('menu_id',$id)->get();
        $pages = Page::where('type' , 'page')->with(['MenuItem'])->get();
        $posts = Page::where('type' , 'posts')->with(['MenuItem'])->get();
        $selectedPage = MenuItem::all();
        return view('organization.cms.menu.edit-menu',compact(['menu', 'menuItem','pages','posts','selectedPage']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $model = Menu::where('id',$id)->delete();
        return back();
    }
    public function createMenuItem(Request $request)
    {
       $item = new MenuItem;
       $item->fill($request->except('_token'));
       $item->save();

       return back();
    }
    public function updateMenuItem(Request $request){
        if(@$request['form_data'] != null){
            $form_data = [];
            foreach ($request->form_data as $key => $value) {
                if($key != '_token'){
                    $form_data[$key] = $value;
                } 
            }

            $model = MenuItem::where('id',$request->form_data['id'])->update($form_data);
            $selectedPage = MenuItem::where([ 'menu_id' => $request['menu_id']])->get();
            return view('organization.cms.menu.menu-item',compact('selectedPage'))->render();
        }else{
            $MenuItem = MenuItem::where([ 'menu_id' => $request['menu_id'] , 'page_id' => $request['data_id']])->first();
            if($MenuItem == null){
              ;
                $pages = Page::find($request['data_id']);
                
                if(@$pages->slug != null){
                    $page_slug = $pages->slug;
                    $link = asset('page/'.$page_slug);
                    
                    $model = new MenuItem;
                    $model->menu_id = $request['menu_id'];
                    $model->page_id = $request['data_id'];
                    $model->label = $request['data_title'];
                    $model->type = $request['dataType'];
                    $model->link = $link;
                    $model->save();

                   
                    $selectedPage = MenuItem::where([ 'menu_id' => $request['menu_id']])->get();
                    return view('organization.cms.menu.menu-item',compact('selectedPage'))->render();
                }else{
                    return 'slug_error';

                }
            }else{
                $delete = MenuItem::where([ 'menu_id' => $request['menu_id'] , 'page_id' => $request['data_id']])->delete();
                $selectedPage = MenuItem::where([ 'menu_id' => $request['menu_id']])->get();
                return view('organization.cms.menu.menu-item',compact('selectedPage'))->render();
            }
        }
        

        
    }
    // public function updateMenuItem(Request $request)
    // {
    //     $model = MenuItem::where('id',$request['id'])->update($request->except('_token','id'));
        
    //     return back();
    // }
    public function DeleteMenuItem($id)
    {
        $item = MenuItem::where(['id'=>$id])->delete();
        return back();
    }
    public function getMenuItem(Request $request)
    {
        $model = MenuItem::where('id',$request['id'])->first();
        return view('organization.cms.menu.menu-item',compact('model'))->render();
    }
    public function getMenuItems(Request $request)
    {
        $selectedPage = MenuItem::where(['menu_id' => $request['menu_id']])->get();
        return view('organization.cms.menu.menu-item',compact('selectedPage'))->render();
    }
}
