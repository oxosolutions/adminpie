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
      	return view('organization.leave_category.list_category',$data );
     }
     /**
      * [save category]
      * @param  Request $request [all form data]
      * @return [type]           [back category list]
      */
    public function save(Request $request)
    {
      //$request['name'] = $request['addleavecat'];
      $tbl = Session::get('organization_id');
      $valid_fields = [
                          'name'          => 'required|unique:'.$tbl.'_categories'
                      ];
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
    public function categoryMeta(Request $request , $cat_id=null)
     {
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
        
        if(!empty($merge['user_exclude'])){
          $select['user_exclude'] = json_decode($merge['user_exclude'],true);
        }
        if(!empty($merge['user_include'])){
          $select['user_include'] = json_decode($merge['user_include'],true);
        }
        if(!empty($data['data']['include_designation']))
        {
          $include_designation = array_map('intval',json_decode($data['data']['include_designation']));
          $user_data = $this->user_by_designation($include_designation);
         $include['user_include'] = $data['user_include'] = $user_data['user_include'];  
         $exclude['user_exclude'] = $data['user_exclude'] = $user_data['user_exclude']; 
        
         $merge = array_merge($merge , $include, $exclude);

        $data_include_designation['data_designation'] = $data['data']['include_designation'];
        $merge =  array_merge($merge ,$data_include_designation);

        }else{
          $meta_shift = UsersMeta::with('group_user')->whereIn('key',['user_shift'])->get();//->keys();
         
          $user_pluck = $meta_shift->pluck('group_user.name','group_user.id')->toArray();
          // $user = User::with('belong_group')->where('id','!=',$cat_id)->get();//->pluck('name','id');

          // dd('meta', $meta_shift->toArray() , $user->toArray());
          // $user_pluck =[];
          // foreach ($user as $userKey => $userValue) {
          //   if(!empty($userValue['belong_group'])){
          //     // $user_pluck[] = [$userValue['id']=>$userValue['belong_group']['name']];  
          //     $user_pluck[$userValue['id']]= $userValue['belong_group']['name'];  
          //   }
          // }
          // unset($data);
         $data['userData'] = $data['user_include'] = $data['user_exclude']= $user_pluck; //[['12'=>'user']];// User::where('id','!=',$cat_id)->
         $merge = array_merge($merge ,  $data);
        }
        $data['id'] =$cat_id;
        $designationData['designationData'] = $data['designationData'] = DES::where('status',1)->pluck('name','id');
        $data['roles'] = Role::where('status',1)->pluck('name','id');
        $merge = array_merge($merge, $designationData);
       // dd($merge);
        
        return view('organization.leave_category.leave_rule',['data'=>$merge ,'select'=>$select]);
     }

    public function delete($id){
        CAT::where('id',$id)->delete();
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
      
      // $exclude =  User::with('belong_group')->with('metas')->whereHas('metas', function($query){
      //   $query->where('key','user_shift');
      // })->whereHas('metas', function($query) use($designation_id) {
      //     $query->where('key','designation')->whereIn('value',$designation_id);
      //     })->where('user_type','employee')->get();
     
      // 
      // foreach ($exclude as $userKey => $userValue) {
      //       if(!empty($userValue['belong_group'])){
      //         // $user_exclude[] = [$userValue['id']=>$userValue['belong_group']['name']];  
      //         $user_exclude[$userValue['id']] = $userValue['belong_group']['name'];  
      //       }
      //     }      

      $include =  User::with('metas')->whereHas('metas', function($query){
        $query->where('key','user_shift');
      })->whereHas('metas', function($query) use($designation_id) {
          $query->where('key','designation')->whereNotIn('value',$designation_id);
          })->where('user_type','employee')->get();

      foreach ($include as $userKey => $userValue) {
            if(!empty($userValue['belong_group'])){
              // $user_include[] = [$userValue['id']=>$userValue['belong_group']['name']];  
              $user_include[$userValue['id']]=$userValue['belong_group']['name'];  
            }
          } 
        
      return compact('user_exclude','user_include');
    }

    public function get_user_by_designation(Request $request){
        $designation_id = $request['des_id'];
        $data = $this->user_by_designation($designation_id);
        $user_exclude = $data['user_exclude'];
        $user_include = $data['user_include'];
        // $user_exclude =  User::with('belong_group','metas')->whereHas('metas', function($query) use($designation_id) {
        //   $query->where('key','designation')->whereIn('value',$designation_id);
        //   })->where('user_type','employee')->pluck('name','id');
        // $user_include =  User::with('metas')->whereHas('metas', function($query) use($designation_id) {
        //   $query->where('key','designation')->whereNotIn('value',$designation_id);
        //   })->where('user_type','employee')->pluck('name','id');

         return view('organization.leave_category.user_drop_down',compact('user_exclude','user_include'));
    }

}

