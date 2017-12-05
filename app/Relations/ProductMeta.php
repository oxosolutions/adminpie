<?php
    
    namespace App\Relations;

    trait ProductMeta{
        public function meta(){

            return $this->belongsTo('');
        }

        public function assignTable(){
            return 'global_product_meta';
        }

        public function putFillable(){
            return [
                'product_id',
                'key',
                'value'
            ];
        }
    }

?>