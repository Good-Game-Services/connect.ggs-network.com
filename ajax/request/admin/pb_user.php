<?php
require("../../../config/db.php");

if(!session_id()){
	session_start();
}

$pbStatus = array();
if(checkUserSession($db) !== False && !empty($_POST["user_id"]) && !empty($_POST["url"])){
	$user = searchUser_bSession($db, $_COOKIE["user_session"]);
	$user_id = $_POST["user_id"];
	$url = $_POST["url"];
	
	
	if($user["admin"] == 1){
		$pbStatus = mysqli_query($db, "UPDATE user SET profilePicture = '$url' WHERE id = $user_id");
		if ($pbStatus) {
			$pbStatus = array(
				"success" => true,
				"message" => "PB was changed"
			);
		} else {
			$pbStatus = array(
				"success" => false,
				"message" => "Can't change pb"
			);
		}
	} else {
		$pbStatus = array(
			"success" => false,
			"message" => "Require admin"
		);
	}
} else {
	$pbStatus = array(
		"success" => false,
		"message" => "Require login"
	);
}

echo json_encode($pbStatus);