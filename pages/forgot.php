<?php
include_once 'banner.php';
?>
<div class="main_container">
<?php 
$sid = $_GET["sid"];
if (!isset($sid)) {
	echo "Please enter the student number.";
	exit();
}

Database::obtain()->connect();
$user = User::searchBy(array("sid" => trim($sid)));
if ($user) {
	$new_pwd = rand(10000, 99999999);
	$user->updateUser(array("pwd" => generatePWD($new_pwd)));
	
	$link = str_replace("forgot", "change_pwd", curPageURL());
	$message = "Hey, " . $user->getSid(). "\n" .
	file_get_contents("email/forgot_pwd") . $new_pwd .
	file_get_contents("email/change_pwd") . $link . "\n\n" .
				"(Some email client users may need to copy and " . 
				"paste the link into your web browser).";
	mail($user->getEmail(), "Account Update at TSS", $message, MAILHEADER);
	echo "<h1 align='center'>Your new password has been sent to " . $user->getEmail() . ".<br /> Click <a href='index.php'>here</a> to go back...</h1>";
} else {
	echo "<h1 align='center'>The user does not exist... Click <a href='index.php'>here</a> to go back...</h1>";
}
Database::obtain()->close();
?>
</div>
<?php 
include_once 'footer.php';