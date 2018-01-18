
/************************************************************
*	@function to_html_table
*	@description Returns HTML Table from an Array, an Object or JSON
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm data		[array/object/json	optional	default	null]
*	@perm datatype		[string optional	default	array]
*	@return output [string]
************************************************************/

function to_html_table($data = null, $datatype = 'array'){
	$output = "";







	
	
	return $output;
}
/************************************************************
*	@function json_to_html_table
*	@description Returns HTML Table from JSON String
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm data		[JSON	optional	default	null]
*	@return output [string]
************************************************************/
function json_to_html_table($data = null){
	$output = to_html_table($data , $datatype = 'json');
	return $output;
}
/************************************************************
*	@function array_to_html_table
*	@description Returns HTML Table from Array
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm data		[Array	optional	default	null]
*	@return output [string]
************************************************************/
function array_to_html_table($data = null){
	$output = to_html_table($data , $datatype = 'array');
	return $output;
}
/************************************************************
*	@function object_to_html_table
*	@description Returns HTML Table from Array
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm data		[Object	optional	default	null]
*	@return output [string]
************************************************************/
function object_to_html_table($data = null){
	$output = to_html_table($data , $datatype = 'object');
	return $output;
}
