<?php 
include "config/db_config.php";
$db = new Database(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>iMedia Admin Login</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta name="robots" content="index, follow" />
	<meta charset="utf-8" />	
	<!-- Load Javascript -->
	<script type="text/javascript" src="assets/js/jquery.query-2.1.7.js"></script>
	<script type="text/javascript" src="assets/css/bootstrap.min.css"></script>
	<!-- // Load Javascipt -->
	<!-- Load stylesheets -->
	<link type="text/css" rel="stylesheet" href="css/style.css" media="screen" />
	<link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css" media="screen" />
	<!-- // Load stylesheets -->
</head>
<body style="background:url(images/cctv.jpg);background-repeat: no-repeat;background-size: cover;">
	<div id="wrapper">
		<div id="wrappertop"></div>
		<div id="wrappermiddle">
			<h2>Login</h2>
			<form method="POST" action="">
			<div id="username_input">
				<div id="username_inputleft"></div>
				<div id="username_inputmiddle">
					<input type="text" name="username" id="url" placeholder="Username" >
				</div>
				<div id="username_inputright"></div>
			</div>
			<div id="password_input">
				<div id="password_inputleft"></div>
				<div id="password_inputmiddle">
					<input type="password" name="password" id="url" placeholder="Password">
				</div>
				<div id="password_inputright"></div>
			</div>
			<div id="submit">
				<input type="submit" class="btn btn-success pull-right" id="wew" name="submit" value="Sign In">
			</div>
			<!-- <div id="links_left">
			<a href="#">Forgot your Password?</a>
			</div>
			<div id="links_right"><a href="#">Not a Member Yet?</a></div> -->
			</form>
		</div>
		<div id="wrapperbottom"></div>
		<!-- <div id="powered">s
		<p>Powered by <a href="http://www.premiumfreebies.eu">Premiumfreebies Control Panel</a></p>
		</div> -->
	</div>

<?php 
	if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		if($db->login($username,$password)){
			$db->redirect("quotation.php");
		}else{
			echo"<script type='text/javascript'>alert('Incorrect Credentials');</script>";
		}
	}
?>
</body>
</html>