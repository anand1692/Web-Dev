<?php
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
</div>

<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

<div id="friendWrapper">
<h2>Online Friends</h2>
<div id="friendList"></div>
</div>

<script>
	var btn = document.getElementById('logout');
	btn.addEventListener("click", function() {
		document.location.href = 'logout.php';
	});
</script>

<script>
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
            document.getElementById("friendList").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","friends.php?q="+ "<?php echo $_SESSION['login_user'];?>", true);
    xmlhttp.send();
}

function alertfunc() {
	alert("<?php echo $_SESSION['login_user']?>");
}

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