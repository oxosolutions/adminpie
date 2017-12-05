<?php
    namespace App\Relations;

    trait Products{

        public function meta(){

            return $this->hasMany('App\Model\Admin\ProductMeta','product_id','id');
        }

        public function assignTable(){
            return 'global_products';
        }

        public function putFillable(){
            return [
                'product_name',
                'product_slug',
                'product_description'
            ];
        }
    }

?>