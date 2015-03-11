<?php
/*
 * This php displays the list of online friends of a user. It is called from the profile.php as the user logs in.
 * This php reads the user local table from the database and whichever friends are online, it displays on the 
 * login user's profile. The login user may then click and any of the online friend's name and chat.
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

// Gets the login user name
$q = $_GET['q'];

// Query to select all the online friends from the user local table in the database
$sql = "SELECT name, active FROM ".$q."_local WHERE active=1";
$result = $conn->query($sql);

// Sends back the list to profile.php
if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
     	if($row['active'] == 1 && $row['name'] != $q) {
        	echo "<br>". "<a class=friendNames id=". $row["name"]. " href='#' onclick='startChat(this.id)'>". $row["name"];
     	} 
     }
} else {
     echo "<span>"."No friends are online"."</span>";
}

$conn->close();
?>