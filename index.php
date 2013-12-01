<?php
/*
 * 2011 Oct 28
 * CSCC40 - Tutorial Scheduling System
 *
 * This index page will play a role of wrapper and the only portal to access the
 * website. Page jumping is done by using URL GET tokens
 *
 * @author Kobe Sun
 *
 */

include_once("includes.php");

$session = Session::getInstance();
$session->startSession();
$cookie = Cookie::getInstance();

# This will ensure that cookie will be set before the header is sent
ob_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSCC40 - Tutorial Scheduling System</title>

<link href="css/style.css" rel="stylesheet" type="text/css" />

</head>
<body>
		<?php
		if (!isset($_GET["action"])) {
			include_once("pages/login.php");
		} else {
			$filename = "pages/" . $_GET["action"] . ".php";
			if (file_exists($filename))
				include_once($filename);
			else
				include_once("pages/error.php");
		}
		?>
</body>
</html>

<?php
	ob_end_flush();
?>