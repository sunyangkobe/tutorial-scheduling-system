<?php
include_once("../includes.php");
Database::obtain()->connect();
$db = Database::obtain();

$sessionData = array (
	"session_date" => $_POST["session_date"],
	"session_time" => $_POST["session_time"],
	"location" => $_POST["location"],
);
$db->update("session_info", $sessionData, "session_id = ".$_POST["session_id"]);
Database::obtain()->close();
movePage(301, "../index.php?action=user_home&content=manage_session&user=0");
?>