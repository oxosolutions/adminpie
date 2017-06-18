<?php 
namespace App\Repositories\Category;
use App\Model\Organization\Category;
use App\Model\Organization\CategoryMeta as CM;

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
		if($request != null){
			if($request->has('per_page')){
            $perPage = $request->per_page;
            if($perPage == 'all'){
              $perPage = 999999999999999;
            }
          }else{
            $perPage = 5;
          }
          $sortedBy = @$request->sort_by;
          if($request->has('search')){
              if($sortedBy != ''){
                  $model = Category::where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                  $model = Category::where('name','like','%'.$request->search.'%')->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = Category::orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                   $model = Category::paginate($perPage);
              }
          }
          $datalist =  [
                          'datalist'=>$model,
                          'showColumns' => ['name'=>'Name','description'=>'Description','status'=>'Status','created_at'=>'Created At'],
                          'actions' => [
                                          'edit' => ['title'=>'Edit','route'=>'meta.category'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.category']
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
		$cat_id = $request['id'];
		$cat = Category::find($cat_id);
		$cat->fill($request->all());
		$cat->save();
		unset($request['_token'],$request['id'],$request['name'],$request['description']);
		foreach ($request->all() as $key => $value) {
			$check = CM::where(['category_id'=>$cat_id, 'key'=>$key]);
			if(is_array($value)){
				$value = json_encode($value);
			}
			if($check->count() >0 ){
				$check->update(['value'=>$value]);
			}else{
				$cMeta = new CM();
				$cMeta->key = $key;
				$cMeta->category_id = $cat_id;
				$cMeta->value = $value;
				$cMeta->save();
			}
		}
  	}
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

}

?>