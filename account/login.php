<?php
/*
 * 2011 Nov 1
 * CSCC40 - Tutorial Scheduling System
 *
 * Account login controller
 *
 * @author Kobe Sun
 *
 */

include_once("../includes.php");

if(empty($_POST)) exit;

Database::obtain()->connect();

$session = Session::getInstance();
$session->startSession();


if (!checksid(trim($_POST["sid"]))){
	$session->loginmsg ="Error: invalid student number!";
	movePage(301, "../index.php");
}else{
	$user =  User::searchBy(array(
				"sid" => trim($_POST["sid"]),
				"pwd" => generatePWD(trim($_POST["pwd"]))));
	if ($user) {
	 	if ($user->getActivated() != 1) {
	 		$session->loginmsg ="Error: your account is not activated yet!";
	 		movePage(301, "../index.php");
	 	} else {
			$session->user = $user;
	// 		if (isset($_POST["autologin"]) && $_POST["autologin"] == "YES") {
	// 			# Set up cookie for the user
	// 			$cookie = Cookie::getInstance();
	// 			$cookie->set("username", $user->getUsername());
	// 			$cookie->set("pwd", $user->getPwd());
	// 		}
			if ($user->isAdmin()) {
				movePage(301, "../index.php?action=admin_home");
			} else {
				movePage(301, "../index.php?action=user_home&user=1");
			}
			exit("OK");
	 	}
	} else {
		$session->loginmsg = "Error: The submitted login info is incorrect.";
		movePage(301, "../index.php");
	}
}

Database::obtain()->close();
?>
