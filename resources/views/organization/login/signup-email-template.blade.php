<!DOCTYPE html>
<html>
<head>
	  <!--[if gte mso 9]><xml>
       <o:OfficeDocumentSettings>
        <o:AllowPNG/>
        <o:PixelsPerInch>96</o:PixelsPerInch>
       </o:OfficeDocumentSettings>
      </xml><![endif]-->
      <!-- fix outlook zooming on 120 DPI windows devices -->
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- So that mobile will display zoomed in -->
      <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- enable media queries for windows phone 8 -->
      <meta name="format-detection" content="date=no"> <!-- disable auto date linking in iOS 7-9 -->
      <meta name="format-detection" content="telephone=no"> <!-- disable auto telephone linking in iOS 7-9 -->
      <title>Single Column</title>
</head>
<body>

	<div style="width: 100%">
		{!! @$emailLayout['header'] !!}
		<div style="padding:20px 40px">
            {!! @$emailTemplate['content'] !!}
			{{-- @php
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
			{!! @$content !!} --}}
		</div>
		{!!  @$emailLayout['footer'] !!}
	</div>
</body>
</html>