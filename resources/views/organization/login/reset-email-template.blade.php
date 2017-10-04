<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<div style="width: 100%">
		<div style="background-color: #e8e8e8;text-align: center;padding:10px">
			<h4>Admin Pie</h4>
		</div>
		<div style="padding:20px 40px">
			<h5>Hi {{@$model['name']}}</h5>
			You recently requested to reset your password for your account. Click the button below to reset it.<br>
			<div style="width: 100%;text-align: center;padding: 18px 0px;">
				<a href="{{ route('edit.password') }}" style="background-color: #DB4F28;color: white;width: 200px;line-height: 38px;font-size: 18px;border: none">Reset Password</a>	
			</div>
			<p>
				If you did not request a password reset, please ignore the email or reply to let us know.This password reset is only valid for the next 30 minutes
			</p>
			<p>
				Thanks,
				<br>
				
			</p>
			<p>
				Note:  PLEASE DO NOT REPLY TO THIS MAIL. THIS IS AN AUTO GENERATED MAIL.
			</p>
			<hr>
			<p>
				If you're having trouble clicking the password reset button, copy and paste the URL below into your web browser.<br>
				<a href="{{ route('edit.password') }}">{{ route('edit.password') }}</a>
			</p>

		</div>
		<div style="background-color: #e8e8e8;text-align: center;padding:10px">
			 2017, Oxo solutions pvt ltd, All rights reserved
		</div>
	</div>
</body>
</html>