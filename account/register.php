<?php

/*
 * 2011 Jul 09
 * CSC309 - Carpool Reputation System
 *
 * Account registration controller
 *
 * @author Kobe Sun
 *
 */

include_once("../includes.php");

if (empty($_POST)) exit;

$session = Session::getInstance();
$session->startSession();

Database::obtain()->connect();

$user = new User(array (
		"sid" => trim($_POST["sid"]),
		"fname" => trim($_POST["given"]),
		"lname" => trim($_POST["surname"]),
		"email" => trim($_POST["email"]),
		"pwd" => generatePWD(trim($_POST["pwd"])),
		"is_activated" => rand(10000, 9999999999),
		"middle_name" => trim($_POST["middle"]),
		"phone" => trim($_POST["tel"]),
		"u_type" => 1,
));

$session->sid =$_POST["sid"];
$session->fname = $_POST["given"];
$session->lname = $_POST["surname"];
$session->email = $_POST["email"];
$session->middle_name = $_POST["middle"];
$session->telephone = $_POST["tel"];
$session->vemail = $_POST["v_email"];


$errMsg = checkForm();

if($errMsg == "" && ($user->addUser() != -1)) {
	$link = str_replace("/account/register.php",
		"/index.php?action=activate&uid=".$user->getUid()."&activate=".$user->getActivated(), 
		curPageURL());

	$message = "Hey, " . $user->getSid() . "\n" .
		file_get_contents("../email/activate") . "\n" .
		$link . "\n\n" .
		"(Some email client users may need to copy and " . 
		"paste the link into your web browser).";

	mail($user->getEmail(), "Registration at The TSS", $message, MAILHEADER);
	reset($session->sid);
	reset($session->fname);
	reset($session->lname);
	reset($session->email);
	reset($session->middle_name);
	reset($session->telephone);
	reset($session->vemail);
	echo "Please activate your account.";
	movePage(301, "../index.php", 3);
} else {
	
	$session->errormsg =  $errMsg;
	//echo $errMsg;
	movePage(301, "../index.php?action=register");
}

Database::obtain()->close();

?>
