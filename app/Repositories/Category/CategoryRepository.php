<?php 
namespace App\Repositories\Category;
use App\Model\Organization\Category;
use App\Model\Organization\CategoryMeta as CM;
use App\Model\Organization\UsersMeta;
use Auth;
class CategoryRepository implements CategoryRepositoryContract
{
	public function create($data=null)
	{
		$cat = new Category();
		$cat->fill($data->all());
		$cat->save();
	}
	public function list_category($type,$request = null)
	{
		$search = $this->saveSearch($request);
	    if($search != false && is_array($search)){
	        $request->request->add(['items'=>@$search['items'],'orderby'=>@$search['orderby'],'order'=>@$search['order']]);
	    }
		if($request != null){
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
                  $model = Category::where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
              }else{
                  $model = Category::where('name','like','%'.$request->search.'%')->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = Category::orderBy($sortedBy,$request->order)->paginate($perPage);
              }else{
                   $model = Category::paginate($perPage);
              }
          }
          $datalist =  [
                          'datalist'=>$model,
                          'showColumns' => ['name'=>'Name','description'=>'Description','status'=>'Status','created_at'=>'Created'],
                          'actions' => [
                                          'edit' => ['title'=>'Edit','route'=>'meta.category'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.leave.category']
                                       ]
                      ];
           return $datalist;
		}else{
			$data = Category::with('meta')->where('type',$type)->get();
			return $data;
		}
	}
	public function category_data_by_id($id)
	{
		$data = Category::where('id',$id)->first();
		return $data;
	}
	public function category_meta_save($request){
    $checkKey = ['role_include'=>'role_include' ,'roles_exclude'=>'roles_exclude' , 'include_designation'=>'include_designation', 'exclude_designation'=>'exclude_designation', 'user_include'=>'user_include',  'user_exclude'=>'user_exclude','carry_farward'=>'carry_farward','carry_farward_cashout'=>'carry_farward_cashout'];
    $cat_id = $request['id'];
     // CM::where(['category_id'=>$cat_id])->delete();
		$cat = Category::find($cat_id);
		$cat->fill($request->all());
		$cat->save();
		unset($request['_token'],$request['id'],$request['name'],$request['description']);
      $check = CM::where(['category_id'=>$cat_id]);
      if($check->exists())
      {
         CM::where('category_id',$cat_id)->delete();
      }
     foreach ($request->all() as $key => $value) {
    //   if(!empty($checkKey[$key])){
    //     unset($checkKey[$key]);
    //   }
      if(!empty($value)){
          $cMeta = new CM();
          $cMeta->key = $key;
          $cMeta->category_id = $cat_id;
          if(is_array($value)){
              $value = json_encode($value);
            }
              $cMeta->value = $value;
              $cMeta->save();
        }
      }
  }

		// 	if(is_array($value)){
		// 		$value = json_encode($value);
		// 	}
		// 	if($check->count() >0 ){
		// 		$check->update(['value'=>$value]);
		// 	}else{
		// 		$cMeta = new CM();
		// 		$cMeta->key = $key;
		// 		$cMeta->category_id = $cat_id;
		// 		$cMeta->value = $value;
		// 		$cMeta->save();
		// 	}
		// }
  //    $keyValue = array_values($checkKey);
  //    CM::whereIn('key',$keyValue)->where('category_id',$cat_id)->delete();
  
  	public function manage_status($request){
          if($request['status']=='true')
          {
            $status = 1;
          }else{
            $status = 0;
          }
         Category::where('id', $request['id'])->update(['status'=>$status]);
         return true;
    }

    protected function saveSearch($request){
        $search = $request->except(['page']);
        $model = UsersMeta::where(['key'=>$request->route()->uri,'user_id'=>Auth::guard('org')->user()->id])->first();
        if($model != null){
            if(!empty($request->except(['page']))){
              $model->value = json_encode($request->except(['page']));
              $model->save();
            }
            $savedSearch = json_decode($model->value, true);
            return $savedSearch;
        }else{
            $model = new UsersMeta;
            $model->user_id = Auth::guard('org')->user()->id;
            $model->key = $request->route()->uri;
            $model->value = json_encode(@$request->except(['page']));
            $model->save();
            return false;
        }
    }

}

?>