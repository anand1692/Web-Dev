<?php
/*
 * This php is responsible to check the login user's credentials. It deos the following important jobs :
 * 1) It verifies the login user's credentials - username and password. If true, is sets the active bit = 1
 * 2) It prevents muliple logins from the same user within one session or across tabs and browsers.
 * 3) Once the user succesfully logs in, it also sets its active bit = 1 in all its friend's local table
 * 	  so that, when they come online, they see this friend as online.
 * 
 *  This php is called from the login.php when the user submits its login credentials. If the log in credentials 
 *  are faulty, the gives the user a prompt of invalid entry. Also, if the user tries multiple logins, this php
 *  logs out the user from the existing session and returns him to the login page.
 *  
 *  Once logged in, the user is taken to its profile page which will show the list of all of his online friends.
 *  
 *  Created by Anand Goyal, copyright © March 2015, Anand Goyal
 */
session_start(); // Starting Session
$error=''; // Variable To Store Error Message

if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid";
	} else {
		// Define $username and $password
		$username=$_POST['username'];
		$password=$_POST['password'];
		
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = mysql_connect("localhost", "root", "Suvarn92");
		
		// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);
		
		// Selecting Database
		$db = mysql_select_db("chat_messenger", $connection);
		
		// SQL query to fetch information of registerd users and finds user match.
		$query = mysql_query("select * from MyUsers where password='$password' AND name='$username'", $connection);
		$userInfo = mysql_fetch_assoc($query);
		
		// If the user is already logged in, it is directly logged out from the session. Calls the logout.php
		if ($userInfo['active'] == 1) {
			$error = "User is already logged in. Redirecting to Login page after Logout";
			$_SESSION['login_user']=$username; // Preventing multiple Session
			header("location: logout.php");
		}else {
			// If the log in credentials are verified, the active bit of the login user is set across the database.
			$rows = mysql_num_rows($query);
			if ($rows == 1) {
				$_SESSION['login_user']=$username; // Initializing Session
				
				$sql = mysql_query("UPDATE MyUsers SET active=1 WHERE name='$username'", $connection);
				
				if ($sql === TRUE) {
					$sql2 = mysql_query("SELECT name FROM ".$username."_local", $connection);
					$friendRow = mysql_num_rows($sql2);
					if($friendRow > 0) {
						while($friendInfo = mysql_fetch_assoc($sql2)) {
							$sql3 = mysql_query("UPDATE ".$friendInfo['name']."_local SET active=1 WHERE name='$username'",
									$connection);
						}
					}
					header("location: profile.php"); // Redirecting To Other Page
				} else {
					echo "Error updating record ";
				}
				
			} else {
				$error = "Username or Password is invalid";
			}
		}	
		mysql_close($connection); // Closing Connection
	}
}
?>