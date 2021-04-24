<?php 
include('dbconfig.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
	<style>
		body{
			overflow: hidden;
			height: 100%;
			background: #191c22;
			padding: 0;
			margin-top:150px;
			font: 400 13.3333px Arial;
		}
		.hd-block {
			background: #fff;
			border-radius: 2px;
			position: relative;
			padding: 45px 30px 30px;
			margin: 0 auto;
			width: 400px;
			display: block;
		}

		
		.hd-block .form-control {
			text-align: center;
		}
		
		.hd-float img {
			width: 100%;
			height: 100%;
			border-radius: 50%;
			padding: 4px;
		}
		.hd-float i {
			color: #333;
			font-size: 25px;
			line-height: 60px;
		}
		.hd-lockscreen {
			position: relative;
		}
		.hd-lockscreen .form-control {
			padding-right: 35px;
		}
		
		#footer, #footer .f-menu>li>a {
			color: #a2a2a2;
		}
		.login-navigation>li>span {
			opacity: 0;
			filter: alpha(opacity=0);
		}
		.login-navigation>li:not(:hover) {
			font-size: 0;
			border-radius: 100%
		}
		.login-navigation>li:hover {
			border-radius: 10px;
			padding: 0 5px;
			font-size: 8px;
		}
		.login-navigation>li:hover>span {
			opacity: 1;
			filter: alpha(opacity=100);
		}
		.hd-float {
			width: 60px;
			height: 60px;
			background: #fff;
			border-radius: 50%;
			box-shadow: 0 -10px 19px rgba(0,0,0,.38);
			position: absolute;
			top: -35px;
			left: 50%;
			margin-left: -30px;
			text-align:center;
		}
		.hd-float i {
			color: #333;
			font-size: 25px;
			line-height: 60px;
		}
		.zmdi {
			display: inline-block;
			font: normal normal normal 14px/1 'Material-Design-Iconic-Font';
			font-size: inherit;
			text-rendering: auto;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
		}
		.cr-alt label {
			position: relative;
			padding-left: 28px;
		}
		.form-group {
			margin-bottom: 15px;
			width: 95%;
		}
		.c-gray {
			color: #9e9e9e!important;
		}
		.form-control {
			-webkit-transition: all;
			-o-transition: all;
			transition: all;
			-webkit-transition-duration: .3s;
			transition-duration: .3s;
			resize: none;
			box-shadow: 0 0 0 40px transparent!important;
			border-radius: 0;
		}
		.form-control {
			width: 100%;
			height: 35px;
			padding: 6px 12px;
			background-color: #fff;
			border: 1px solid #e8e8e8;
			-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
		}
		.form-control, output {
			font-size: 13px;
			line-height: 1.42857143;
			color: #9e9e9e;
			display: block;
		}
		.hd-block {
			box-shadow: 0 1px 11px rgba(0, 0, 0, .27);
		}
		
		.btn:not(.btn-alt) {
			border: 0;
		}
		.btn-primary.active, .btn-primary.focus, .btn-primary:active, .btn-primary:focus, 
		.btn-primary:hover, .open>.dropdown-toggle.btn-primary {
			color: #fff;
			background-color: #1791f2;
			border-color: #0d87e9;
		}
		.btn-primary {
			color: #fff;
			background-color: #2196f3;
			border-color: #0d8aee;
			padding: 15px;
			border-radius: 3px;
		}
	</style>
	
</head>
	<body>
		<div class="container bootstrap snippets bootdey">
			<div class="hd-block col-md-4 col-md-offset-4">
			<?php if($f3->exists('SESSION.invalidlogin')){
			?>
				<p style="background: red; padding: 15px; color: #fff; font-size: 14px;">Invalid username or password</p>
			<?php } ?>
				<form action="handler.php" method="post">
					<div class="hd-float"><i class="fa fa-users"></i></div>
					<div class="form-group">
						<input type="text" class="form-control" name="username" required placeholder="Username">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" name="password" required placeholder="Password">
					</div>
					<div class="clearfix"></div>
					<p>Don't have an account? <a href="register.html">Register here</a></p>
					<button type="submit" class="btn btn-block btn-primary btn-float m-t-25" name="signin">Sign In</button>
				</form>
				
			</div>
		</div>
		<?php if($f3->exists('SESSION.invalidlogin')){ unset($_SESSION['invalidlogin']); } ?>
	</body>
</html>