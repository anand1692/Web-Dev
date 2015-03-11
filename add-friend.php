<?php
/*
 * This php is called from profile.php on clicking the "Add a friend" button. This php in turn calls 
 * add-friend-db.php and displays a list on online registered users that the login user wants to add
 * as a friend. 
 * When the login user clicks the name of the registered user to add a friend, this php
 * will call the insert-friend.php and adds the particular user as login user's friend.
 * 
 * Created by Anand Goyal, copyright © March 2015, Anand Goyal
 */
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add a friend</title>
	<link href="main-style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<p id="addFriendHeader">Hi <?php echo $_GET['user'];?>, click the user you wish add as a friend</p>
	<div id="friendListBox"></div>
	
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	
	<script type="text/javascript">
		$(document).ready(function() {
			setInterval(loadFriends, 1000);
		});

		/* This function creates an ajax object to display the list of online registered users which can 
		 * be added as friend. It sends a GET request to add-friend.php with login user as argument.
		 */
		function loadFriends() {
			if (window.XMLHttpRequest) {
		        // code for IE7+, Firefox, Chrome, Opera, Safari
		        xmlhttp = new XMLHttpRequest();
		    } else {
		        // code for IE6, IE5
		        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		    }
		    xmlhttp.onreadystatechange = function() {
		        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		            document.getElementById("friendListBox").innerHTML = xmlhttp.responseText;
		        }
		    }
		    xmlhttp.open("GET","add-friend-db.php?q="+ "<?php echo $_GET['user'];?>", true);
		    xmlhttp.send();
		}

		/* This function is activated when the user clicks on any of the name of the online registered
		 * users. This function calls the insert-friend.php by sending a GET request with arguments as the 
		 * login user and the friend, which the login user wants to add. 
		 */
		function addFriend(friendId){
			document.getElementById(friendId).addEventListener("click", insertFriend(), false);
			function insertFriend() {
				window.location = 'insert-friend.php?sender='+'<?php echo $_GET['user'];?>'+'&friend='+friendId;
			}		
		}
	</script>	
	
</body>
</html>