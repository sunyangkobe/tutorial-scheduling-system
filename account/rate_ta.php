<?php
include_once("../includes.php");
Database::obtain()->connect();
$db = Database::obtain();

$rateData = array (
	"session_id" => $_POST["session_id"],
	"rater_id" => $_POST["rater_id"],
	"target_id" => $_POST["target_id"],
	"score" => $_POST["score"],
	"comment" => $_POST["comment"],
);
$db->query_first("DELETE FROM rate_ta WHERE session_id=".$_POST['session_id']." AND rater_id=".$_POST['rater_id']);
$db->insert("rate_ta", $rateData);
Database::obtain()->close();
movePage(301, "../index.php");
?>