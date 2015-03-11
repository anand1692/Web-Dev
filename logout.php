<?php
/*
 * When the user clicks the logout button, he directed to this php. It is called from the profile.php on clicking
 * the logout button. This php sets the active bit of this user = 0 across the database. Also, it destroys all the 
 * existing sessions for this particular user.
 * 
 * Once all the updations have been made and the sessions have been destroyed, the user is directed to the
 * login page, where he may/may not wish to login again.
 * 
 * Created by Anand Goyal, copyright © March 2015, Anand Goyal
 */
session_start();

$servername = "localhost";
$username = "root";
$password = "Suvarn92";
$dbname = "chat_messenger";

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

// Getting the name of the login user
$uname = $_SESSION['login_user'];	

// Creating query to set the active bit of the user = 1 across the database
$sql = "UPDATE MyUsers SET active=0 WHERE name='$uname'";
$sql2 = "SELECT name FROM ".$uname."_local";
$result = $conn->query($sql2);

if ($conn->query($sql) === TRUE) {
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$sql3 = "UPDATE ".$row['name']."_local SET active=0 WHERE name='$uname'";
			$conn->query($sql3);
		}
	}
	header('location: login-page.php');
} else {
    echo $_SESSION['login_user']. " did not log out properly - " . $conn->error;
} 

$conn->close();
session_destroy(); // Destroying All Sessions

?>