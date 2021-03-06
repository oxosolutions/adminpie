<?php

namespace App\Repositories\Products;

interface ProductRepositoryContract{

    public function put(Array $SingleProductArray, $QueryType, $ProductId);
    public function getAll($request);
    public function getByID($PrductId);
    public function update(Array $SingleProductArray, $PrductId);
    public function drop($PrductId);
}

