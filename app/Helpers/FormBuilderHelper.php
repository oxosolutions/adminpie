<?php


function getMetaByKey($metaArray, $metaKey){
	$metaData = $metaArray->where('key',$metaKey);
	$metaValue = false;
	foreach($metaData as $key => $value){
		$metaValue = $value->value;
	}
	return $metaValue;
}

