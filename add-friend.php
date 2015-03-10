<?php
session_start();
$user = $_GET['user'];
//echo $user;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add a friend</title>
	<link href="main-style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<p id="addFriendHeader">Hi <?php echo $_GET['user'];?>, click on the name of the person you wish to be friends</p>
	<div id="friendListBox"></div>
	
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	
	<script type="text/javascript">
		$(document).ready(function() {
			setInterval(loadFriends, 1000);
		});

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

		function addFriend(friendId){
			document.getElementById(friendId).addEventListener("click", insertFriend(), false);
			function insertFriend() {
				window.location = 'insert-friend.php?sender='+'<?php echo $_GET['user'];?>'+'&friend='+friendId;
			}		
		}
	</script>	
	
</body>
</html>