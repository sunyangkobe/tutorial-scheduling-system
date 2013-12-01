<?php
include_once '../includes.php';
$session = Session::getInstance();
$session->startSession();
Database::obtain()->connect();

$q = "SELECT `email` FROM `admin` LEFT JOIN `users` ON `admin`.`uid` = `users`.`uid`";
$emails = Database::obtain()->fetch_array($q);
foreach ($emails as $e) {
	mail($e["email"], "TA Application", $session->user->getSid() . " is applying for a TA position.", MAILHEADER);
}
echo "OK";
Database::obtain()->close();