<?php

namespace App\Repositories\Products;
class BaseProduct{

    //Product Base Class
    protected $product;

    protected $product_meta;

    public function __construct(){

        $this->product = 'App\Model\Admin\Product';

        $this->product_meta = 'App\Model\Admin\ProductMeta';
    }
}