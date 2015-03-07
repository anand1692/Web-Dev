<?php 
session_start();
echo "Sender = ".$_GET['sender'];
echo "<br>";
echo "Receiver = ".$_GET['receiver'];
echo "<br>";

$sender_dir = $_GET['sender'];
$receiver_dir = $_GET['receiver'];

if(is_dir($sender_dir) === false) {
	mkdir($sender_dir, 0777, true);
	chmod($sender_dir, 0777);
}

if(is_dir($receiver_dir) === false) {
	mkdir($receiver_dir, 0777, true);
	chmod($receiver_dir, 0777);
}

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
	
//	fwrite($receiver_file, "<div class='msgln'>(".date("g:i A").") <b>".$sender."</b> ".
//			stripslashes(htmlspecialchars($text))."<br></div>");
		
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
<p>Have a great time chatting with <?php echo $_GET['receiver']; ?>&nbsp;&nbsp;
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

	$('#exitChat').click(function () {
		var exit = confirm("Are you sure you want to end the session?");
		if(exit == true) {
			var clientmsg = "has left the chat";
			var senduser = "<?php echo $_GET['sender'];?>";
			var receiveuser = "<?php echo $_GET['receiver'];?>";
			window.location = 'chat-page.php?logout=true&sender='+senduser+'&receiver='+receiveuser;
		}

	});
	
	$('#submitmsg').click(function () {
		var clientmsg = $('#usermsg').val();
		var senduser = "<?php echo $_GET['sender'];?>";
		var receiveuser = "<?php echo $_GET['receiver'];?>";
		$.post("chat-log.php", {text: clientmsg, sender: senduser, receiver: receiveuser});
		$('#usermsg').attr("value", "");
		return false;
	});

	setInterval(loadLog, 1000);

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