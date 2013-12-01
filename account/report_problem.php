<?php
include_once("../includes.php");

if (empty($_POST)) exit;

$session = Session::getInstance();
$session->startSession();

Database::obtain()->connect();

$message = "The following message was sent by: " . $session->user->getFname() . " " . 
		$session->user->getLname() . ". \n" .
		"from the TSS with user id: " . $session->user->getUid() . "\n" .
		"Subject: " . $_POST["topic"] . "\n" .
		"Message: " . $_POST["message"];
mail("marco.tang3191@hotmail.com", $_POST["topic"], $message, MAILHEADER);
exit("marco.tang3191@hotmail.com");
Database::obtain()->close();
?>