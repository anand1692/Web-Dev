<?php
session_start(); // Starting Session
include('login-db.php'); // Includes Login Script
if(isset($_SESSION['logout'])) {
	echo "You have succesfully logged out";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link href="main-style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div id="main">
	<h1>Welcome to SCU Chat</h1>
	<div id="login">
		<h2>Login Form</h2>
		<form action="" method="post">
			<label>UserName&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><a href='register.php'>Register here</a>
			<input id="name" name="username" placeholder="username" type="text">
			<label>Password</label>
			<input id="password" name="password" placeholder="**********" type="password">
			<input name="submit" type="submit" value=" Login ">
			<span><?php echo $error; ?></span>
			</form>
		</div>
	</div>
</body>
</html>