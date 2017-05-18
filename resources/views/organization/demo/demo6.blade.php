@extends('layouts.main')
@section('content')

<style type="text/css">
	
</style>

<!-- main-content-->
<div class="card" style="margin-top: 0px;padding:10px">

@php
$name=array("My","Name","is","Simarpreet","Singh");
echo $name[0] .'&nbsp;'. $name[1] .'&nbsp;'.  $name[2] .'&nbsp;'.  $name[3].'&nbsp;'.  $name[4];
$arrlength=count($name);
print($arrlength);
foreach($name as $value)
{
echo $value;
}
@endphp

		<!-- attendance section-->
		<!-- //attendance section-->

</div>
<!-- //main-content-->


@endsection