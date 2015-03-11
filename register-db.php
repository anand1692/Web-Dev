<?php
/*
 * This php is resposible to add a new user and register him to use the chat messenger. When a user registers,
 * he is added to the list of all the registered users and also a local user table is created for him to keep
 * track of his friends. Every new registered user will intially have no friends.
 * 
 *  Created by Anand Goyal, copyright © March 2015, Anand Goyal
 */
session_start();
$servername = "localhost";
$username = "root";
$password = "Suvarn92";
$dbname = "chat_messenger";
$error = "";

// Create connection
if(isset($_POST['submit'])) {
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	
	// Get the user registeration information from the post method, after the user submits the registeration form
	$uname = $_POST["uname"];
	$pass = $_POST["password"];
	
	// Query to insert the new user into the registered users table and also to create a new local table in database
	$sql = "INSERT INTO MyUsers (name, password, active) VALUES ('$uname', '$pass', '1')";
	$sql2 = "CREATE TABLE ".$uname."_local (name VARCHAR(30) NOT NULL PRIMARY KEY, active INT(1) UNSIGNED)";
		
	if ($conn->query($sql) === TRUE) {
		$conn->query($sql2); // Creating the user local table to hold user friends
		header("location: profile.php"); // Redirecting To Other Page
		$_SESSION['login_user']=$uname; // Initializing Session
	} else {
		$error = "Username already taken";
	}
		
	$conn->close();
}
?>