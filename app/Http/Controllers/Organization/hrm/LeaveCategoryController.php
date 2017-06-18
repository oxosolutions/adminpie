<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Category as CAT;
use App\Model\Organization\Designation As DES;
use App\Model\Organization\User;
use App\Model\Organization\CategoryMeta as CM;
use App\Repositories\Category\CategoryRepositoryContract;

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
    public function save(Request $request){
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
    public function categoryMeta(Request $request , $id=null)
     {  
     		if($request->isMethod('post')){
          $this->catRepo->category_meta_save($request);  
          return back();			
  		  }
  		$select =[];
      $data['cat'] = $this->catRepo->category_data_by_id($id);
  		$cm = CM::where('category_id',$id)->get();
  		$data['data'] = $cm->pluck('value','key')->toArray();
     	$data['id'] =$id;
   		$data['userData']= User::pluck('name','id');
   		$data['designationData'] = DES::where('status',1)->pluck('name','id');
      return view('organization.leave_category.leave_rule',['data'=>$data ,'select'=>$select]);
     }

     public function delete($id){
        CAT::where('id',$id)->delete();
        return back();
     }
}
