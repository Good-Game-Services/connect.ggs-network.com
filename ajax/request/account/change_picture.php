<?php
require("../../../config/db.php");

session_start();
error_reporting(0);

$changeStatus = array();

if(checkUserSession($db) !== False){
	if(!empty($_POST["profile_picture"])){
		$picture 	= (string) $_POST["profile_picture"];
		
		$user = searchUser_bSession($db, $_COOKIE["user_session"]);
		
		if(!empty(getimagesize($picture))){
			mysqli_query($db, "UPDATE user SET profilePicture = '$picture' WHERE username = '{$user["username"]}'") or die(json_encode(array("success" => false, "message" => "Error update sql query")));
			
			$changeStatus = array("success" => true, "message" => "Change profilepictures success, you can refresh the site to change them!");
		} else {
			$changeStatus = array("success" => false, "message" => "Invaild Image/Picture URL!");
		}
	} else {
		$changeStatus = array("success" => false, "message" => "Empty data");
	}
} else {
	$changeStatus = array("success" => false, "message" => "Require login");
}

echo json_encode($changeStatus);