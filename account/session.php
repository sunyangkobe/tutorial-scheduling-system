<?php
include_once("../includes.php");
Database::obtain()->connect();
$session = Session::getInstance();
$session->startSession();

$errmsg = "";
if (!isset($_POST["session_type"])){
	$errmsg.="Please fill in the session type!</br>";	
}

if (!isset($_POST["course_code"])){
	$errmsg.="Please fill in the course code!</br>";		
}

if (!isset($_POST["session_date"])){
	$errmsg.="Please fill in the session date!</br>";		
}

if (!isset($_POST["session_time"])){
	$errmsg.="Please fill in the session time!</br>";	
}
if (!isset($_POST["location"])){
	$errmsg.="Please fill in the session location!</br>";	
	
	
}
if (!isset($_POST["session_space"])){
	$errmsg.="Please fill in the session space!</br>";	
	
	
}
if (!isset($_POST["fee"])){
	$errmsg.="Please fill in the session fee!</br>";	

}

if ($errmsg == ""){
	
	$sessionData = array (
		"session_type" => trim($_POST["session_type"]),
		"ta_id" => $session->user->getUid(),
		"course_code" => trim($_POST["course_code"]),
		"session_date" => $_POST["session_date"],
		"session_time" => $_POST["session_time"],
		"location" => $_POST["location"],
		"description" => "",
		"session_space" => trim($_POST["session_space"]),
		"fee" => trim($_POST["fee"]),
	);
	$retval = Database::obtain()->insert("session_info", $sessionData);
	if ($retval){
		$session->session_msg = $errmsg;
		movePage(301, "../index.php?action=user_home&user=0");
	}else{
		$session->session_msg = "Error occured, please report problem!";
		movePage(301, "../index.php?action=user_home&user=0");
	}
}else{
	$session->session_msg = $errmsg;
	echo $errmsg;
	movePage(301, "../index.php?action=user_home&user=0&content=create_session");	
}
Database::obtain()->close();
