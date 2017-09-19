<?php

namespace App\Http\Controllers\Organization\widgets;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Widget;
class WidgetsController extends Controller
{
    public function listWidgets(Request $request)
    {
    	$datalist = [];
        if($request->has('items')){
            $perPage = $request->items;
            if($perPage == 'all'){
              $perPage = 999999999999999;
            }
        }else{
           	$perPage = 10;
        }
        $sortedBy = @$request->orderby;
        if($request->has('search')){
          	if($sortedBy != ''){
             	$model = Widget::where('title','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
          	}else{
              	$model = Widget::where('title','like','%'.$request->search.'%')->paginate($perPage);
          	}
        }else{
            if($sortedBy != ''){
                $model = Widget::orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                $model = Widget::paginate($perPage);
            }
        }

      	$datalist =	[
                      	'datalist'=>$model,
                      	'showColumns' => ['title'=>'Title','slug' => 'Slug'],
                      	'actions' =>[
                                      'view'   => ['title'=>'View','route'=>'account.profile','class'=>'view'],
                                      'edit'   => ['title'=>'Edit','route'=>'info.user','class'=>'edit'],
                                      'delete' => ['title'=>'Delete','route'=>'delete.user']
                                   	]
                  	];
        return view('organization.widgets.custom.index',$datalist);
    }

    public function createWidget(){

    	return view('organization.widgets.custom.create');
    }
}
