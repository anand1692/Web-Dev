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
    echo "Error updating record: " . $conn->error;
} 

$conn->close();
session_destroy(); // Destroying All Sessions

?>