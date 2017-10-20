<?php
namespace OxoSolutions\Menu;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use OxoSolutions\Menu\Models\Menus;
use OxoSolutions\Menu\Models\MenuItems;
use Route;
use App\Model\Organization\Page;
use App\Model\Admin\GlobalModule;
class WMenu
{

	public function render(){
		$menu = new Menus();
		$menuitems = new MenuItems();
		$menulist = $menu->select(['id', 'name'])->get();
		$menulist = $menulist->pluck('name', 'id')->prepend('Select menu', 0)-> all();

		//$menulist[0] = "Select menu";
		/*if ( (request()->has("action")  && empty(request()->input("menu"))) || request()->input("menu") == '0' ) {

			return view('vendor.oxosolutions-menu.menu-html') -> with("menulist", $menulist);
		} else {*/

			$menu = Menus::find(request()->route('id'));
			$menus = $menuitems -> getall(request()->route('id'));
			$routes = GlobalModule::getRouteListArray('menu');
			$pages = Page::pluck('title','slug');
			$data = [ 'menus' => $menus, 'indmenu' => $menu, 'menulist' => $menulist,'routes'=>$routes,'pages'=>$pages ];
			//\Debugbar::info();
			
			return view('vendor.oxosolutions-menu.menu-html', $data);
		//}

	}

	public function scripts(){
		return view('vendor.oxosolutions-menu.scripts');
	}

	public function select($name="menu", $menulist = array()){
		$html = '<select name="'.$name.'">';

		foreach($menulist as $key => $val){
			$active = '';
			if(request()->input('menu') == $key){
				$active = 'selected="selected"';
			}
			$html .= '<option '.$active.' value="'.$key.'">'.$val.'</option>';
		}
		$html .= '</select>';
		return $html;
	}

	public function wlist($menu_id){
		$menuItem = new MenuItems;
		$menu_list = $menuItem->getall($menu_id);

		$roots = $menu_list->where('menu', $menu_id)->where('parent', '0');
		
		$items = $this->tree($roots, $menu_list);
		return $items;
	}

	private function tree($items, $all_items){
		$data_arr = array();
		$i = 0;
		foreach($items as $item){
			$data_arr[$i] = $item->toArray();
			$find = $all_items->where('parent', $item->id);

			$data_arr[$i]['child'] = array();

			if($find->count()){
				$data_arr[$i]['child'] = $this->tree($find, $all_items);
			}

			$i++;
		}

		return $data_arr;
	}

}
