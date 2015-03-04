<?php
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

$uname = $_SESSION['login_user'];	
$sql = "UPDATE MyUsers SET active=0 WHERE name='$uname'";

if ($conn->query($sql) === TRUE) {
	header("location: login-page.php"); // Redirecting To Home Page
    $_SESSION['logout'] = 1;
} else {
    echo "Error updating record: " . $conn->error;
} 

$conn->close();
session_destroy(); // Destroying All Sessions

?>