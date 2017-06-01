<?php 
use DB;
use App\Model\Admin\GlobalWidget as GW;

function global_draw_widget($str)
{
	$data = GW::all(); 
	dump($data);
   return 'A Global Function with '. $str;
}

function abc($a)
{
	return "abc func working->".$a;
}

?>