<?php
require("../../../config/db.php");

if(!session_id()){
	session_start();
}

$restartStatus = array();
if(checkUserSession($db) !== False){
	$user = searchUser_bSession($db, $_COOKIE["user_session"]);
	
	if($user["admin"] == 1){
		$$output = shell_exec("pm2 restart api-server");

        $restartStatus = array(
			"success" => true,
			"message" => $output
		);
	} else {
		$restartStatus = array(
			"success" => false,
			"message" => "Require admin"
		);
	}
} else {
	$restartStatuss = array(
		"success" => false,
		"message" => "Require login"
	);
}

echo json_encode($restartStatus);