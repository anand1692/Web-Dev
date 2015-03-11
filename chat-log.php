<?php
	/*
	 * This php is responsible to log the chat between two friends. It is called from the chat-page.php.
	 * It receives a POST request from chat-page.php and writes the text into both the sender's and receiver's
	 * file. If the file does not exist, it is created. These files keep the chat log and are displayed to both
	 * the users.
	 * 
	 *  Created by Anand Goyal, copyright © March 2015, Anand Goyal
	 */
	session_start();

	$text = $_POST['text'];
	$sender = $_POST['sender'];
	$receiver = $_POST['receiver'];
	
	// The sender has a file in the name of receiver
	$sender_file = fopen($sender . "/" . $receiver . ".html", "a+");
	
	// The receiver has a file in the name of sender
	$receiver_file = fopen($receiver . "/" . $sender . ".html", "a+");
	
	//Writing data into the sender file
	fwrite($sender_file, "<div class='msgln'>(".date("g:i A").") <b>".$sender."</b>: ".
			stripslashes(htmlspecialchars($text))."<br></div>");
	
	//Writing data into the receiver file
	fwrite($receiver_file, "<div class='msgln'>(".date("g:i A").") <b>".$sender."</b>: ".
			stripslashes(htmlspecialchars($text))."<br></div>");
		
	fclose($sender_file);
	fclose($receiver_file);

?>