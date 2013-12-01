<?php

include_once("../includes.php");

if (empty($_POST)) exit;

$session = Session::getInstance();
$session->startSession();
Database::obtain()->connect();


$errMsg = "";


if (empty($_POST["pwd"]) && empty($_POST["email"]) && empty($_POST["phone"])){
	$errMsg .= "Please at least update one entry.<br />";
}
if ( (!empty($_POST["pwd"])) &&  empty($_POST["r_pwd"])) {
		$errMsg .= "The password you entered was invalid. <br />";
}
	
if ( !empty($_POST["pwd"]) && ($_POST["pwd"] != $_POST["r_pwd"]) ) {
		$errMsg .= "The passwords you entered do not match. <br />";
}

if (!empty($_POST["email"]) && !checkEmail(trim($_POST["email"]))) {
		$errMsg .= "The email you entered was invalid. <br />";
	} elseif (!empty($_POST["v_email"]) && !checkEmail(trim($_POST["v_email"]))){
		$errMsg .= "The email you retyped was invalid. <br />";
	} elseif (!empty($_POST["v_email"])&& !empty($_POST["email"]) && ( trim($_POST["email"]) != trim($_POST["v_email"]) )){
		$errMsg .= "The emails you entered don't match. <br />";
	}elseif(!empty($_POST["email"]) && empty($_POST["v_email"])){
		$errMsg .= "Please re-enter the email. <br />";
	} elseif (!empty($_POST["email"])) {
		
		$user = User::searchBy(array("email" => trim($_POST["email"])));		
		if ($user) {
			if (is_null(retrieveUser()) || (retrieveUser()->getUid() != $user->getUid())) {
				$errMsg .= "The email you entered already exists. <br />";
			}
		}
	}

if (!empty($_POST["phone"]) && !checkTel(trim($_POST["phone"]))) {
	$errMsg .= "The telephone number you entered was invalid. <br />";
}

if($errMsg == ""){
	$db = Database::obtain();
	$sid = $session->user->getSid();
	
	$user = $session->user;
	if (!empty($_POST["phone"])){
		$phone = trim($_POST["phone"]);	
	}else{
		$phone = $user->getTelephone();	
	}
	if (!empty($_POST["email"])){
		$email = trim($_POST["email"]);	
	}else{
		$email = $user->getEmail();	
	}
	if (!empty($_POST["pwd"])){
		$pwd = trim($_POST["pwd"]);	
	}else{
		$pwd = $user->getPwd();	
	}
	
	
	
	$userData = array (
			"email" => $email,
			"phone" => $phone,
			"pwd" => generatePWD($pwd),
	);


	$user = $db->update("users", $userData, "sid=".$sid);
	$url = "../index.php?action=user_home&user=".$session->utype."&content=user_profile";
	if ($user){
		$session->update_err ="Update successfully!";
		
		movePage(301, $url);
	}else{
		$session->update_err ="Update Failed, please report the problem to the admin!";
		movePage(301, $url);
		
	}
}else{
	$url = "../index.php?action=user_home&user=".$session->utype."&content=user_profile";
	$session->update_err = $errMsg;
	movePage(301, $url);
}

Database::obtain()->close();
?>
