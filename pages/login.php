<?php
include_once 'banner.php';
$user = $session->user; 
if (isset($user)) {
	if ($user->isAdmin()) {
		movePage(301, "index.php?action=admin_home");
	} else {
		movePage(301, "index.php?action=user_home&user=1");
	}
}
?>
<script type="text/javascript">
function goWithSid() {
	var sid = document.getElementById("sid").value;
	if (sid == "") {
		alert("Please enter the username.");
	} else {
		window.location.href = "index.php?action=forgot&sid=" + sid;
	}
}
</script>
<div class="main_container">
	<div id="login">
		Here at UTSC Accessability, we are committed to our students' success.
		<br /> This Tutoring System is just another way to for us to help our
		student to succeed.<br /> In order to access our system, you must
		first register to access our services.<br /> New students <a
			href="index.php?action=register">please register here.</a><br />
		Current users please login first to access our service.
		<hr />
		<div class="box" style="height: 270px; width: 480px;">
			<h2 id="login_bar">Web Access</h2>
			<a id="reg_button" href="index.php?action=register">Register</a> <br />
			<br /> <br />
			<div id="error_notification" style='color: red;'><?php echo $session->loginmsg ?></div>
			<?php
			unset($session->loginmsg);
			?>
			<form name="logform" id="logform" action="account/login.php"
				method="POST">
				<table style="margin: 20px; color: #FFF; clear: none;">
					<tr>
						<td class="field_button">Student ID:</td>
						<td align="center"><input class="field" type="text" name="sid"
							id="sid" value="" /></td>
					</tr>
					<tr>
						<td class="field_button" style="padding: 0 20px">Password:</td>
						<td align="center"><input class="field" type="password" name="pwd"
							id="pwd" value="" /></td>
					</tr>
					<tr>
						<td><a id="fpwd"
							style="font-size: 14px; color: #4EA7C5; text-decoration: none;"
							href="index.php" onclick="goWithSid();return false;">Forgot my
								password?</a></td>
						<td align="right"><input class="confirm_btn"
							style="margin-top: 30px;" type="submit" name="login_btn"
							id="login_btn" value="Login" /></td>
					</tr>
				</table>
			</form>
		</div>
		<hr />
	</div>
	
	
	
	
	<?php
	include_once 'footer.php';
	?>
</div>
