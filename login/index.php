(<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role'])) {
	if($_SESSION['role']){
		header("Location: ../admin");
	}
	else{
		header("Location: ../elections.php");
	}
})

?>

	<html>
	<head>
		<title>Login</title>
			<meta charset="utf-8">
			<link href="css/style.css" rel='stylesheet' type='text/css' />
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
			<!--webfonts-->
			<link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
			<!--//webfonts-->
	</head>
	<body>
		 <!-----start-main---->
		 <div class="main">
			<div class="login-form">
				<h1>Member Login</h1>
						<div class="head">
							<img src="images/user.png" alt=""/>
						</div>
					<form method="POST" action="login.php">
							<input name="USERNAME" type="text" class="text" value="USERNAME" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'USERNAME';}" >
							<input name="Password" type="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
							<div class="submit">
								<input type="submit" onclick="myFunction()" value="LOGIN" >
						</div>	
						<p><a href="#">Forgot Password ?</a></p>
					</form>
				</div>
				<!--//End-login-form-->
			</div>
				 <!-----//end-main---->
					 
	</body>
	</html>
