<?php 
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
   <input type="submit" name="submit" value="Register"> 
</form>
</div>

</body>
</html>