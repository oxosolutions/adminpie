<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Designation As DES;
use App\Model\Organization\User;
use App\Model\Organization\UsersMeta;
use App\Model\Organization\CategoryMeta as CM;
use App\Repositories\Category\CategoryRepositoryContract;
use App\Model\Organization\Leave as LV; 
use App\Model\Organization\Category as CAT;
use App\Model\Organization\UsersRole as Role;
use App\Model\Group\GroupUsers;
use Auth;
use Session;
/**
 *  @last_modified 2017-06-11 Day sunday
 *  modififed by Paljinder Singh
 */
class LeaveCategoryController extends Controller
{
    protected $catRepo;
    /**
     * [__construct add dependncy of category]
     * @param CategoryRepositoryContract $CategoryRepositoryContract [description]
     */
    public function __construct(CategoryRepositoryContract $CategoryRepositoryContract)
    {
      $this->catRepo = $CategoryRepositoryContract;
    }
    /**
     * [index listing ]
     * @return [html array] [category list _+ list data]
     */
    public function index(Request $request){
        $data =  $this->catRepo->list_category("leave", $request);
      	return view('organization.hrm.leave-category.list_category',$data );
     }
     /**
      * [save category]
      * @param  Request $request [all form data]
      * @return [type]           [back category list]
      */
    public function save(Request $request) {
      $tbl = Session::get('organization_id');
      $valid_fields = ['name'          => 'required|unique:'.$tbl.'_categories'];
      $this->validate($request , $valid_fields);
      $request->request->add(['type' => 'leave']);
      $this->catRepo->create($request);
      return redirect()->route('leave.categories');
    }
     /**
      * [manage_status change enable disable]
      * @param  Request $request [request data]
      * @return [type]           [description]
      */
    public function manage_status(Request $request){
          $this->catRepo->manage_status($request);
     }
     /**
      * [categoryMeta description]
      * @param  Request $request [description]
      * @param  [type]  $id      [description]
      * @return [type]           [description]
      */
    public function categoryMeta(Request $request , $cat_id=null) {
        if(Auth::guard('org')->check()){
          $id = Auth::guard('org')->user()['id'];
        }else{
          $id = Auth::guard('admin')->user()['id'];
        }
        if($request->isMethod('post')){
          $this->catRepo->category_meta_save($request); 
          Session::flash('success','leave category updated successfully');
          return redirect()->route('leave.categories');
        }
        $select =[];
        $data['cat'] = $this->catRepo->category_data_by_id($cat_id)->toArray();/*This get category name only*/
        $cm = CM::where('category_id',$cat_id)->get(); /*This get all data like user include , exclude , designation etc only*/
        $data['data'] = $cm->pluck('value','key')->toArray();
        $merge = array_merge($data['cat'] , $data['data']);
        $data['id'] =$cat_id;
        return view('organization.hrm.leave-category.leave_rule',['data'=>$merge ,'select'=>$select]);
     }

    public function delete($id){
        CAT::where('id',$id)->delete();
        CM::where('category_id',$id)->delete(); 
        return back();
    }

    public function editLeaveCat(Request $request){
      unset($request['_token']);
      CAT::where('id' , $request->id)->update(['name'=>$request['name'] , 'description'=>$request['description']]);
      $newMeta = $request->except('id','name','description');
        CM::where('category_id', $request->id)->delete();
        foreach($newMeta as $key => $value){
          $data = new CM;
          $data->category_id = $request->id;
          $data->key = $key;
            if(is_array($value)){
              $data->value = json_encode($value);
            }elseif($value == ""){
              $data->value = "";
            }else{
              $data->value = $value;
            }
            $data->save();
        }
        return back();
    }

    protected function user_by_designation($designation_id){
      $user_include = $user_exclude =[];
      http_response_code(500);
      if(!empty($designation_id)){
/*exclude user */      
      $user = GroupUsers::with('metas')->whereHas('metas', function($query){
                                                $query->where('key','user_shift');
                                    })->whereHas('metas', function($query) use($designation_id) {
                                          $query->where('key','designation')->whereIn('value',$designation_id);
                                })->get();
      $user_exclude = $user->pluck('name','id')->toArray();
/*include user */ 
      $include = GroupUsers::with('metas')->whereHas('metas', function($query){
                                                $query->where('key','user_shift');
                                    })->whereHas('metas', function($query) use($designation_id) {
                                          $query->where('key','designation')->whereNotIn('value',$designation_id);
                                })->get();
      $user_include = $include->pluck('name','id')->toArray();
    }else{
        $user = GroupUsers::with('metas')->whereHas('metas', function($query){
                                                $query->where('key','user_shift');
                                    })->get();
        $user_include = $user_exclude = $user->pluck('name','id')->toArray();
    }
      return compact('user_exclude','user_include');
    
    }

    public function get_user_by_designation(Request $request){
        $designation_id = $request['des_id'];
        $data = $this->user_by_designation($designation_id);
        $user_exclude = $data['user_exclude'];
        $user_include = $data['user_include'];
        return view('organization.hrm.leave-category.user_drop_down',compact('user_exclude','user_include'));
    }

    public function create() {
        return view('organization.hrm.leave-category.add');
    }

}

