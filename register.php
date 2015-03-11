<?php 
/*
 * This php allows a new user to register. It shows a form where the user has to enter the details - username
 * and password. Once he presses submit, this php calls the register-db.php and the details are inserted into
 * the database. 
 * 
 * Checks are implemented that the user does not leave either of the necessary information empty. An error
 * message is shown in case the user forgets to enter any required information.
 * 
 * Created by Anand Goyal, copyright © March 2015, Anand Goyal
 */
session_start(); // Starting Session
include('register-db.php');
?>

<!DOCTYPE HTML> 
<html>
<head>
	<title>Registration Page</title>
	<link href="main-style.css" rel="stylesheet" type="text/css">
</head>
<body> 

<?php
$usernameErr = $passwordErr = "";
$username = $password = "";

// Condition to check if the new user has filled all the necessary information
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
   if (empty($_POST["uname"])) {
     $usernameErr = "Username is required";
   } else {
     $username = test_input($_POST["uname"]);
   }

   if (empty($_POST["password"])) {
     $passwordErr = "Password is required";
   } else {
     $password = test_input($_POST["password"]);
   }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<h1>Welcome to the Registration to SCU Chat</h1>
<div id="register">
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   Username:<span class="error"> * </span> <input type="text" name="uname" value="<?php echo $username;?>" placeholder="username">
   <span class="error"><?php echo $usernameErr;?></span>
   <br><br>
   Password:<span class="error"> * </span> <input id="password" name="password" placeholder="**********" type="password">
   <span class="error"><?php echo $passwordErr;?></span>
   <br><br>
   <input type="submit" name="submit" value="Register"> 
   <p class="error"><?php echo $error; ?></p>
</form>
</div>

</body>
</html>