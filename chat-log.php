<?php
	session_start();

	$text = $_POST['text'];
	$sender = $_POST['sender'];
	$receiver = $_POST['receiver'];
	
	$sender_file = fopen($sender . "/" . $receiver . ".html", "a+");
	$receiver_file = fopen($receiver . "/" . $sender . ".html", "a+");
	
	fwrite($sender_file, "<div class='msgln'>(".date("g:i A").") <b>".$sender."</b>: ".
			stripslashes(htmlspecialchars($text))."<br></div>");
	fwrite($receiver_file, "<div class='msgln'>(".date("g:i A").") <b>".$sender."</b>: ".
			stripslashes(htmlspecialchars($text))."<br></div>");
		
	fclose($sender_file);
	fclose($receiver_file);

?>