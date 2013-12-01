<?php
$session->utype = $session->user->getu_type();
if ($session->utype !=  $_GET["user"]){
	movePage(301, "index.php?action=user_home&user=".$session->utype);
}
$user_type = $session->utype ? "Student" : "TA";
$color = $_GET["user"] ? "#F69E49" : "#9BC45C";
$homepage = $_GET["user"] ? "index.php?action=user_home&user=1" : "index.php?action=user_home&user=0";
$name = $session->user->getFname()." ". strtoupper($session->user->getMiddle_name())." ".$session->user->getLname();
$email = $session->user->getEmail();
$last_login = $session->user->getLast_login();

$db = Database::obtain();
$db->connect();
include_once 'banner.php';
?>
<script>
	function sendRequest() {
		if (confirm("Are you sure to apply to be a TA?")) {
			var ajax = new XMLHttpRequest();
			ajax.open("GET", "account/applyta.php");
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4 && ajax.responseText.replace(/^\s+|\s+$/g, '') == "OK"){
					alert("Send successfully. Please wait for the response.");
				} 
			};
			ajax.send();
		}
	}
</script>
<div class="main_container" style="padding: 0px;margin: 0px;">
	<div class="left_container" style="background-image: url('images/<?php echo $user_type?>.png');">
		<div class="user_type" style="background-image: url('images/<?php echo $user_type?>_type.png'); border-color: <?php echo $color?>">
			<h1><?php echo $_GET["user"] ? "Student" : "T.A."?></h1>
		</div>
		<div class="user_info" style="background-color: <?php echo $color?>">
			User: <?php echo $name?><br />
			Email: <?php echo $email?><br />
			Last login: <?php echo $last_login?>
		</div>
		<div style="text-align: center; padding: 10px 0px;">
			<a class="update_btn" 
				style="background-image: url('images/<?php echo $user_type?>_update.png'); border-color: <?php echo $color?>" 
				href="index.php?action=user_home&content=user_profile&user=<?php echo $session->utype?>">Update account Info</a>
		</div>
		<br />
		<fieldset>
			<legend style="font-size: 18px;">Currently Enrolled:</legend>
			<div align="right"><a href="#">View all</a></div>
			<?php
			$len =  $_GET["user"] ? 4 : 1;
			$ta_query = "SELECT uid, fname, middle_name, lname, course_code, session_student.session_id, session_date, session_time, location
				     from session_student join session_info join users
				     on session_student.session_id = session_info.session_id
					and session_info.ta_id = users.uid
				     where session_student.student_id = ". $session->user->getUid();
			$ta_info = $db->fetch_array($ta_query);
			$i = 0;
			foreach ($ta_info as $value)
			{
			if ($i < $len){
			?>
				<div id="inner_box" style="margin-right: 5px">
					<?php
					$target_id = $value["uid"];
					$course_code = $value["course_code"];
					$session_id = $value["session_id"];
					$session_date = $value["session_date"];
					$session_time = $value["session_time"];
					$location = $value["location"];
					$ta = $value["fname"] . ", " . $value["middle_name"] . " " .$value["lname"]
					?>

					Subject: <?php echo $course_code?><br />
					Time:  <span style="color: red;"><?php echo $session_date?> @ <?php echo $session_time?></span><br />
					Location: <?php echo $location?><br />
					T.A.:	<span style="text-decoration: underline;"><?php echo $ta?></span>
					<div style="padding: 15px 0px 10px">
					<a class="update_btn" href="index.php?action=user_home&content=view_info&user=<?php echo $session->utype?>&TAid=<?php echo $target_id ?>">T.A. Profile</a>
					<a class="update_btn" href="index.php?action=update" href="#">Remove</a>
					</div>
				</div>
			<?php 
			}
			$i = $i + 1;
			}

			?>
		</fieldset>
		<?php 
		if ($_GET["user"]) {
			?>
			<div style="text-align: center;margin: 20px 0px;">
				<a class="update_btn" onclick="sendRequest();" style="background-image: url('images/student_update.png'); border-color: #F69E49" 
					href="#"> Apply to be a T.A</a>
			</div>
			<?php
		} else {
			?>
			<div style="text-align: center;margin: 20px 0px;">
				<a class="update_btn" style="background-color: #9BC45C;color: #FFF;font-weight: bold;" 
				href="<?php echo curPageURL()."&content=create_session"?>"> Create New Session</a>
			</div>
			<fieldset>
				<legend style="font-size: 18px;">Current Session:</legend>
				<a href="#">View all</a>
				<?php

				$ta_query = "SELECT session_id, course_code, session_date, session_time, location, fee 
				from users join session_info on users.uid = session_info.ta_id where users.sid =". $session->user->getSid();
				$ta_info = $db->fetch_array($ta_query);
				foreach ($ta_info as $value)
				{
				?>
				<div id="inner_box" style="margin-top: 15px; margin-right: 5px">
				<?php
				$session_id = $value["session_id"];
				$course_code = $value["course_code"];
				$session_date = $value["session_date"];
				$session_time = $value["session_time"];
				$location = $value["location"];
				$fee = $value["fee"];
				?>

				Subject: <?php echo $course_code?><br />
				Time:  <span style="color: red;"><?php echo $session_date?> @ <?php echo $session_time?></span><br />
				Location: <?php echo $location?><br />
				
				</div>
				<?php
				}
				?>
					
				<div style="text-align: right;margin: 15px">
					<a class="update_btn" style="background-color: #9BC45C;color: #FFF;font-weight: bold;" 
					href="index.php?action=user_home&content=manage_session&user=<?php echo $session->utype?>"> Manage</a>
				</div>
			</fieldset>
			<?php
		}
		
		?>
	</div>
	<div class="right_container">
		<div>
			<a class="update_btn" 
				style="background-image: url('images/<?php echo $user_type?>_update.png'); border-color: <?php echo $color?>" 
				href="<?php echo $homepage?>">My Home Page</a>&nbsp;&nbsp;
			<a class="update_btn" 
				style="background-image: url('images/<?php echo $user_type?>_update.png'); border-color: <?php echo $color?>"
				href="index.php?action=user_home&content=findsession&user=<?php echo $session->utype?>">Find a Session</a>&nbsp;&nbsp;
			<a class="update_btn" 
				style="background-image: url('images/<?php echo $user_type?>_update.png'); border-color: <?php echo $color?>" 
				href="index.php?action=user_home&content=rate_ta&user=<?php echo $session->utype?>">Rate my T.A.</a>&nbsp;&nbsp;
			<a class="update_btn" 
				style="background-image: url('images/<?php echo $user_type?>_update.png'); border-color: <?php echo $color?>" 
				href="index.php?action=user_home&content=report_problem&user=<?php echo $session->utype?>">Report Problem</a>
		</div>
		<div id="content" style="min-height:<?php echo $_GET["user"] ? 858 : 780?>px">
			<?php 
				if (!isset($_GET["content"])) {
					include_once("pages/home_content.php");
				} else {
					$filename = "pages/" . $_GET["content"] . ".php";
					if (file_exists($filename))
						include_once($filename);
					else
						include_once("pages/error.php");
				}
			?>
		</div>
		
		<?php 
		$db->close();
		include_once 'footer.php';
		?>
	</div>
</div>