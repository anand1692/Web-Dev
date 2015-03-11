<?php
/*
 * This php adds the user's name as friend of the login user. It is called from the add-friend.php when
 * the login user clicks on a particular online registered user's name. This php will include the friend's name
 * into the login user's local table and also add the login user to the friend's local table.
 * It sets the active value = 1, indicating that the user is online.
 * 
 * Since only the online registered users are displayed to the login user, thus it is important to set the
 * active bit = 1. Once the entry has been made in both the tables, this php closes the add-friend window.
 * The user has the profile in front with the new friend added displayed in the online friend's list.
 * 
 * Created by Anand Goyal, copyright © March 2015, Anand Goyal
 */
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

// Get the sender's name and friend's name sent as GET request.
$sender = $_GET['sender'];
$friend = $_GET['friend'];

// Create query to insert the user's entry to the friend's local table.
$sql = "INSERT INTO ".$sender."_local (name, active) VALUES ('$friend', '1')";
$sql2 = "INSERT INTO ".$friend."_local (name, active) VALUES ('$sender', '1')";

if ($conn->query($sql) === TRUE) {
	$conn->query($sql2);
	echo "<script type='text/javascript'>";
	echo "window.close();";
	echo "</script>";		
}else {
	echo "<span>". $friend." is already your friend". "</span>";
}

$conn->close();

?>