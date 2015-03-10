<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "Suvarn92";
$dbname = "chat_messenger";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sender = $_GET['sender'];
$friend = $_GET['friend'];

$sql = "INSERT INTO ".$sender."_local (name, active) VALUES ('$friend', '1')";
$sql2 = "INSERT INTO ".$friend."_local (name, active) VALUES ('$sender', '1')";

if ($conn->query($sql) === TRUE) {
	$conn->query($sql2);
	echo "<script type='text/javascript'>";
	echo "window.close();";
	echo "</script>";		
}else {
	echo "Friend not added";
}

$conn->close();

?>