<?php
include_once("../includes.php");
$session = Session::getInstance();
$session->startSession();
$session->destroy();
movePage(301, "../index.php");
?>