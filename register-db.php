<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "Suvarn92";
$dbname = "chat_messenger";

// Create connection
if(isset($_POST['submit'])) {
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	
	$uname = $_POST["uname"];
	$pass = $_POST["password"];
	$sql = "INSERT INTO MyUsers (name, password, active) VALUES ('$uname', '$pass', '1')";
	
	$sql2 = "CREATE TABLE ".$uname."_local (name VARCHAR(30) NOT NULL PRIMARY KEY, active INT(1) UNSIGNED)";
		
	if ($conn->query($sql) === TRUE) {
		$conn->query($sql2); // Creating the user local table to hold user friends
		header("location: profile.php"); // Redirecting To Other Page
		$_SESSION['login_user']=$uname; // Initializing Session
	} /*else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}*/
		
	$conn->close();
}
?>