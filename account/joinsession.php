<?php
include_once '../includes.php';
$params = array(
	"session_id" => $_GET["sid"],
	"student_id" => $_GET["uid"],
	"enroll_date" => date("Y-m-d H:m:s")
);
Database::obtain()->connect();
Database::obtain()->insert("session_student", $params);
Database::obtain()->close();

echo "OK";
?>