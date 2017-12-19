<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\GlobalOrganization as GLOR;
use App\Model\Admin\User as US;
use App\Model\Admin\forms as FBuild;
use App\Model\Admin\GlobalWidget as WIDGET;
use App\Model\Admin\GlobalModule as MODULE;
use App\Model\Admin\GlobalGroup as GROUP;
use App\Model\Admin\CustomMaps as MAPS;
use App\Model\Admin\Page as PAGE;

class DashboardController extends Controller
{
    // private function getDashboardData()
    // {
    //     $modelName = [
    //                 'organizations' =>    'App\Model\Admin\GlobalOrganization',
    //                 'users'         =>    'App\Model\Admin\User',
    //                 'forms'         =>    'App\Model\Admin\forms',
    //                 'widget'        =>    'App\Model\Admin\GlobalWidget',
    //                 'module'        =>    'App\Model\Admin\GlobalModule'
    //                 ];
    //     //enter the routes according to model
    //     $routes = ['list.organizations','admin_users','list.forms','index.widget','list.module',];
    //     $index = 0;
         
    //     foreach ($modelName as $mName => $mPath) {
    //         foreach ($routes as $key => $route) {
    //             $model =   [
    //                              $mName  => [
    //                                             'count' => $mPath::count(),
    //                                             'list'  => $mPath::all(),
    //                                             'route' => $route
    //                                         ]
    //                         ];
    //         } 
            
    //     }
    //     return $model;
    // } 

    private function getDashboardData()
    {
        $model = [
                    'groups'        =>  [
                                            'count'     => GROUP::count(),
                                            'list'      => GROUP::all(),
                                            'route'     => 'list.group'
                                        ],
                    'organizations' => [
                                            'count'     => GLOR::count(),
                                            'list'      => GLOR::all(),
                                            'route'     => 'list.organizations'
                                        ],
                    'modules'        =>  [
                                            'count'     => MODULE::count(),
                                            'list'      => MODULE::all(),
                                            'route'     => 'list.module'
                                        ],
                    'widgets'        =>  [
                                            'count'     => WIDGET::count(),
                                            'list'      => WIDGET::all(),
                                            'route'     => 'index.widget'
                                        ],
                    'forms'         => [
                                            'count'     => FBuild::count(),
                                            'list'      => FBuild::all(),
                                            'route'     => 'list.forms'
                                        ],
                    'maps'         => [
                                            'count'     => MAPS::count(),
                                            'list'      => MAPS::all(),
                                            'route'     => 'custom.maps'
                                        ],
                    'pages'         => [
                                            'count'     => PAGE::count(),
                                            'list'      => PAGE::all(),
                                            'route'     => 'admin.list.pages'
                                        ],
                    'users'         => [
                                            'count'     => US::count(),
                                            'list'      => US::all(),
                                            'route'     => 'admin.list.users'
                                        ]
                   
                   
                ];
                return $model;
    } 
   public function index()
   {
    	//get dashboard data from the data fumction
        $model = $this->getDashboardData();
    	return view('admin.dashboard.index')->with('model',$model);
    }
    // public function widgetSort(Request $request)
    // {
    //     $newProcessWidgets = [];
    //     http_response_code(500);
    //     $index = 1;

    //         $widgets = $this->getDashboardData();
    //         foreach ($request['order_id'] as $key => $value) {
    //             if(array_key_exists($value, $widgets)){
    //                 $newProcessWidgets[] = $widgets[$value];
    //             }
    //         }
    // }
}
