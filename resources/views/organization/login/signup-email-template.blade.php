<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<div style="width: 100%">
		{!! @$emailLayout['header'] !!}
		<div style="padding:20px 40px">
			@php
				$content = @$emailTemplate['content'];
				$tokens = array(
				    'USER_NAME' => @$userName,
				    'USER_EMAIL' => @$userEmail,
				);
				$pattern = '[[%s]]';
				$map = array();
				foreach($tokens as $var => $value){
				    $map[sprintf($pattern, $var)] = $value;
				}
				$content = strtr($content, $map);
			@endphp
			{{@$userEmail}} recently create a account with Email : <strong>{{@$userName}} </strong> <br>
			{!! @$content !!}
		</div>
		{!!  @$emailLayout['footer'] !!}
	</div>
</body>
</html>