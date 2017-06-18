<?php 
namespace App\Repositories\Category;

interface CategoryRepositoryContract{
	public function create($data=null);
	public function list_category($type);
	public function category_data_by_id($id);
	public function category_meta_save($request);
	public function manage_status($request);
	
}
?>