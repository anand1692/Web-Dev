<?php 
/*
 * This is the main chat php. It is called from the profile.php, when the login user clicks on a 
 * friend's name. This page is opened as a new window and firstly, it checks if the login user and the 
 * friend has a folder created on the server, to contain the log files. If yes, it continues, else it
 * creates the corresponding folders for both the users.
 * 
 * This page has the chatbox and the input section where the login user types his message.
 * When the login user presses "send" button, this php calls the chat-log.php to write the data
 * from the input text box to the respective files and corresponndingly display it on both the chat screens.
 * 
 * When the login user presses the "exit chat" button, it confirms from the user if he wishes to exit the chat.
 * If the user confirms, then a GET request is sent to this php itself with local logout value = true.
 * Due to this, a message is written in both the corresponding friend's log files that the "login user has left 
 * the chat". Once that is done, the chat window is closed and the login user has his profile in front.
 * 
 * It is important to note that the user has just left the chat with his friend and has not logged out. This is
 * a crucial real life feature. 
 * 
 * Created by Anand Goyal, copyright © March 2015, Anand Goyal
 */
session_start();

$sender_dir = $_GET['sender'];
$receiver_dir = $_GET['receiver'];

// Creating the sender's directory, if not already existing.
if(is_dir($sender_dir) === false) {
	mkdir($sender_dir, 0777, true);
	chmod($sender_dir, 0777);
}

// Creating the receiver's directory, if not already existing.
if(is_dir($receiver_dir) === false) {
	mkdir($receiver_dir, 0777, true);
	chmod($receiver_dir, 0777);
}

// If the GET values is set, it means the login user has confirmed to leave the chat.
if(isset($_GET['logout'])) {
	$sender = $_GET['sender'];
	$receiver = $_GET['receiver'];
	$text = " has left the chat";
	$sender_file = fopen($sender . "/" . $receiver . ".html", "a+");
	$receiver_file = fopen($receiver . "/" . $sender . ".html", "a+");
	
	fwrite($sender_file, "<div class='msgln'>"."<i>".$sender.
			stripslashes(htmlspecialchars($text))."</i><br></div>");
	fwrite($receiver_file, "<div class='msgln'>"."<i>".$sender.
			stripslashes(htmlspecialchars($text))."</i><br></div>");
	

	fclose($sender_file);
	fclose($receiver_file);
	
	echo "<script type='text/javascript'>";
	echo "window.close()";
	echo "</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Chat Box</title>
	<link href="main-style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="wrapper">
<div id="headline">
<p>Have a great time chatting with <?php echo $_GET['receiver']; ?> !
	<button id="exitChat">End Chat</button>
	</p>
</div>

<div id="chatbox"></div>

<form name="message" action="">
<input name="usermsg" type="text" id="usermsg" size="63" />
<input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
</form>

</div>

<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function() {

	// This function is called when the login user clicks the exit chat button. It will close the chat window.
	$('#exitChat').click(function () {
		var exit = confirm("Are you sure you want to end the session?");
		if(exit == true) {
			var clientmsg = "has left the chat";
			var senduser = "<?php echo $_GET['sender'];?>";
			var receiveuser = "<?php echo $_GET['receiver'];?>";
			window.location = 'chat-page.php?logout=true&sender='+senduser+'&receiver='+receiveuser;
		}

	});

	// This function is called when the login user presses send button. It in-turn calls the chat-log.php
	$('#submitmsg').click(function () {
		var clientmsg = $('#usermsg').val();
		var senduser = "<?php echo $_GET['sender'];?>";
		var receiveuser = "<?php echo $_GET['receiver'];?>";
		$.post("chat-log.php", {text: clientmsg, sender: senduser, receiver: receiveuser});
		$('#usermsg').attr("value", '');
		return false;
	});

	setInterval(loadLog, 1000);

	/* This is the ajax function which displays the contents of the chat log between the two friends
	 * on their respective chat screens. It is loaded every second.
	 */
	function loadLog(){
	    var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
	    console.log("<?php echo $sender_dir . "/" . $_GET['receiver'] . ".html"?>");

	    $.ajax({ url: "<?php echo $sender_dir . "/" . $_GET['receiver'] . ".html"?>",
	             cache: false,
	             success: function(html){
	                $("#chatbox").html(html);
	                var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
	                if(newscrollHeight > oldscrollHeight){
	                    $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); 
	                }
	             },
	    });
	}
	
});

</script>
</body>
</html>