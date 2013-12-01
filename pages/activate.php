<?php
Database::obtain()->connect();
if (isset($_GET["uid"]) && isset($_GET["activate"])){
  	$user =  User::searchBy(array("uid" => $_GET["uid"], 
				      "is_activated" => $_GET["activate"]));

	if ($user){
    		$user->activate();
?>
		<h2>Thank you!</h2>
		<p>Your account has been activated.</p>
<?php
	}
	else {
?>
		<h2>Sorry...</h2>
		<p>User id or activation code is incorrect...<br />
		   Please contact the webmaster...</p>
<?php
	}
}
else {
?>
	<h2>Sorry...</h2>
	<p>This doesn't seem to be a valid activation process...<br />
	   Please contact the webmaster...</p>
<?php
}

Database::obtain()->close();
movePage(301, "index.php", 5);
?>
<p>Redirecting to the index page in <span id=sec>5</span> secs...</p>
