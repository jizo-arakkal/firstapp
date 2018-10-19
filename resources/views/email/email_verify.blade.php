<!DOCTYPE html>
<html>
<head>
<title>Email Verification - WannaHelp</title>
</head>
<body>
	@if($status=='success')
		<h3 style="text-align:center;">Thanks for verifying your email. You can access WannaHelp now. Cheers!!</h3>
	@else
		<h3 style="text-align:center;">Sorry, Invalid values are in email verification</h3>	
	@endif
</body>
</html>