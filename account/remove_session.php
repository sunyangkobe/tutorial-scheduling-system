<?php
include_once("../includes.php");
Database::obtain()->connect();
$db = Database::obtain();

$query = "DELETE FROM session_info 
	WHERE session_id=".$_POST["session_id"];
$db->query($query);
Database::obtain()->close();
movePage(301, "../index.php?action=user_home&content=manage_session&user=0");
?>