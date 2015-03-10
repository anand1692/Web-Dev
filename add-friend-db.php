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

$q = $_GET['q'];

$sql = "SELECT name, active FROM MyUsers WHERE active=1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
     	if($row['active'] == 1 && $row['name'] != $q) {
        	echo "<br>". "<a class=friendNames id=". $row["name"]. " href='#' onclick='addFriend(this.id)'>". $row["name"];
     	} 
     }
} else {
     echo "<span>"."No users are online"."</span>";
}

$conn->close();
?>