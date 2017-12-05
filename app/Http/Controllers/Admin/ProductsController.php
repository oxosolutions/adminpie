<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Products\ProductRepository;
use Session;
class ProductsController extends Controller
{
    protected $product;

    public function __construct(ProductRepository $product){
        $this->product = $product;
    }

    public function index(Request $request){
        $data = $this->product->getAll($request);
        return view('admin.products.index',$data);
    }

    public function create(){

        return view('admin.products.create');
    }

    public function save(Request $request){
        $this->validateProductForm($request);
        $this->product->put($request->all());
        Session::flash('success','Product Added Successfully!');
        return redirect()->route('products.list');
    }

    private function validateProductForm($request){

        $rules = [
            'product_name' => 'required',
            'product_slug' => 'required|regex:/(^([a-zA-Z_]+)(\d+)?$)/u'
        ];

        $this->validate($request,$rules);
    }

    public function delete($id){
        $this->product->drop($id);
        return redirect()->route('products.list');
    }

    public function edit($id){

        $product = $this->product->getByID($id);
        return view('admin.products.edit',['product'=>$product]);
    }

    public function update(Request $request, $id){
        $this->validateProductForm($request);
        $this->product->update($request->all(),$id);
        Session::flash('success','Successfully updated!');
        return redirect()->route('products.list');
    }
}
