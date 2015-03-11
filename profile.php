<?php
/*
 * This is the main page of the login user where his online friends are displayed. He can click on
 * any of the online friend's name and start chatting. The login user also has the option to "add a friend"
 * from the list of online registered users. Once done chatting, the user can log out by clicking the log out
 * button.
 * 
 * The list of online friends is refreshed every second and hence as and when a friend comes online,
 * the login user will be able to see the friend's name in the list of online friends. Once the user logs out,
 * he is directed to the login page. This php calls the chat-page.php when the login user clicks on any of 
 * the friend's name.
 * 
 * Created by Anand Goyal, copyright © March 2015, Anand Goyal
 */
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
	<link href="main-style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="profile">
<p id="welcome"><b>Hi, <i><span id="welcomeUser"><?php echo $_SESSION['login_user']; ?></span></i></b></p>
<button id="logout">Log Out</button>
<button id="addfriend">Add a friend</button>
</div>

<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

<div id="friendWrapper">
<h2>Online Friends</h2>
<div id="friendList"></div>
</div>

<script>
	// This button directs the user to logout.php and logs him out
	var logout_btn = document.getElementById('logout');
	logout_btn.addEventListener("click", function() {
		document.location.href = 'logout.php';
	});

	// This button allows the user to add a friend from a list of online registered users
	var addFriend_btn = document.getElementById('addfriend');
	addFriend_btn.addEventListener("click", function() {
		window.open("add-friend.php?user="+"<?php echo $_SESSION['login_user'];?>","Add a Friend",
					"width=700px, height=700px");
	});
	
</script>

<script>
$(document).ready(function() {
	// The list of online friends is refreshed every second using ajax.
	setInterval(loadFriends, 1000);
});

// Function to display the list of online friends of the login user.
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
            document.getElementById("friendList").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","friends.php?q="+ "<?php echo $_SESSION['login_user'];?>", true);
    xmlhttp.send();
}

// Function to call the chat-page.php in a new window and start chatting with the friend clicked.
function startChat(friendId) {
	document.getElementById(friendId).addEventListener("click", openChatWindow(), false);
	function openChatWindow() {
		window.open("chat-page.php?sender="+"<?php echo $_SESSION['login_user'];?>"+ "&receiver="+friendId, 
					"ChatWindow", "width=600px, height=600px");
	}
}
</script>

</body>
</html>