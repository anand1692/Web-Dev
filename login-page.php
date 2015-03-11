<?php
/*
 * This is the login page. It is the first page of the chat messenger, where the user enters his username
 * and password. These credentials are then verified by login-page-db.php and if correct, directs the user
 * to his profile page, else shows him the error message.
 * 
 * This page also offers a new user to register itself, without which he cannot login. Only an already registered
 * user can log into the chat messenger. If the user clicks the "register here" link, he is directed to the
 * registration page. 
 * 
 * Created by Anand Goyal, copyright © March 2015, Anand Goyal
 */
session_start(); // Starting Session
include('login-db.php'); // Includes Login Script
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
		
		<form action="" method="post">
			<label>UserName</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;
			<a href='register.php'>Register here</a>
			<input id="name" name="username" placeholder="username" type="text"><br><br>
			<label>Password</label>
			<input id="password" name="password" placeholder="**********" type="password">
			<input name="submit" type="submit" value=" Login ">
			<span><?php echo $error; ?></span>
			</form>
		</div>
	</div>
</body>
</html>