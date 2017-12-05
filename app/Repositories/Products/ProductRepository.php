<?php

namespace App\Repositories\Products;
use App\Relations\Products as ProductRelations;
class ProductRepository extends BaseProduct implements ProductRepositoryContract{

    use ProductRelations;

    protected $Model;

    protected $Meta;

    public function __construct(){

        parent::__construct();

        $this->Model = $this->product;

        $this->Meta = $this->product_meta;
    }

    public function put(Array $SingleProductArray, $QueryType = 'create', $ProductId = null){
        $excepts = $this->putFillable();
        array_push($excepts,'_token');
        $model = $this->Model;
        if($QueryType == 'create'){
            $model = new $model;
        }elseif($QueryType == 'edit'){
            $model = $model::find($ProductId);
        }
        $model->fill($SingleProductArray);
        $model->save();
        $this->bulkInsertMeta(collect($SingleProductArray)->except($excepts),$model->id);
        return true;
    }

    public function getAll($request){
        $model = $this->Model;
        $data = "";
        $datalist= [];
          if($request->has('per_page')){
            $perPage = $request->per_page;
            if($perPage == 'all'){
              $perPage = 999999999999999;
            }
          }else{
            $perPage = get_items_per_page();;
          }
          $sortedBy = @$request->sort_by;
          if($request->has('search')){
              if($sortedBy != ''){
                  $model = $model::where('product_name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                  $model = $model::where('product_name','like','%'.$request->search.'%')->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = $model::orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                   $model = $model::paginate($perPage);
              }
          }
          $datalist =  [
                          'datalist'=>  $model,
                          'showColumns' => ['product_name'=>'Name','created_at'=>'Created'],
                          'actions' => [
                                          'edit' => ['title'=>'Edit','route'=>'edit.admin.product' , 'class' => 'edit'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.admin.product']
                                       ]
                      ];
        return $datalist;
    }

    public function getByID($ProductId){
        $model = $this->Model;
        $record = $model::with(['meta'])->find($ProductId);
        if(!$record->meta->isEmpty() && $record->meta != null){
            foreach($record->meta as $key => $meta){
                if(is_array($meta->value)){
                    $metaValue = json_decode($meta->value);
                }else{
                    $metaValue = $meta->value;
                }
                $record[$meta->key] = $metaValue;
            }
        }
        return $record;
    }

    public function update(Array $SingleProductArray, $ProductId){
        $this->put($SingleProductArray,'edit',$ProductId);
        return true;
    }

    public function drop($ProductId){
        $model = $this->Model;
        $model = $model::find($ProductId);
        if($model != null){
            $metaModel = $this->Meta;
            $metaModel = $metaModel::where(['product_id'=>$ProductId]);
            $metaModel->delete();
            $model->delete();
        }
        return true;
    }

    private function bulkInsertMeta($metaArray,$product_id){
        $model = $this->Meta;
        if(!$metaArray->isEmpty()){
            foreach($metaArray as $key => $meta){
                $model = $model::firstOrNew(['key'=>$key,'product_id'=>$product_id]);
                $model->key = $key;
                if(is_array($meta)){
                    $meta = json_encode($meta);
                }
                $model->value = $meta;
                $model->product_id = $product_id;
                $model->save();
            }
        }
        return true;
    }
}