<?php
require("../../../config/db.php");

session_start();
error_reporting(0);

$supportStatus = array();

if(checkUserSession($db) !== False){
	if(!empty($_POST["title"]) && !empty($_POST["text"])){
        $title = (string) $_POST["title"];
		$text = (string) $_POST["text"];
		
		$user = searchUser_bSession($db, $_COOKIE["user_session"]);
		
		mysqli_query($db, "INSERT INTO support (user_id, firstName, lastName, email, username, title, text, admin, verified) VALUES ({$user["id"]}, '{$user["firstName"]}', '{$user["lastName"]}', '{$user["email"]}', '{$user["username"]}', '{$title}', '{$text}', {$user["admin"]}, {$user["verified"]})") or die(json_encode(array("success" => false, "message" => "Error update sql query")));
			
		$supportStatus = array("success" => true, "message" => "Support ticket was successfull send. We will be contact you over mail!");
	} else {
		$supportStatus = array("success" => false, "message" => "Empty data");
	}
} else {
	$supportStatus = array("success" => false, "message" => "Require login");
}

echo json_encode($supportStatus);