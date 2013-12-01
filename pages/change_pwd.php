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

$old = $_POST["old_password"];
$new = $_POST["new_password"];
$confirm = $_POST["confirm_password"];

if (isset($old) && isset($new) && isset($confirm)) {
	Database::obtain()->connect();
	$user = User::searchBy(array("sid" => $sid));
	if ($user) {
		if ($user->getPwd() == generatePWD(trim($old))) {
			if ($new == $confirm) {
				$user->updateUser(array("pwd" => generatePWD(trim($new))));
				echo "<h1 align='center'>Password Changed. <br /> Click <a href='".curPageURL()."'>here</a> to go back...</h1>";
			} else {
				echo "<h1 align='center'>The password you entered do not match. <br /> Click <a href='".curPageURL()."'>here</a> to go back...</h1>";
			}
		} else {
			echo "<h1 align='center'>The password you entered is incorrect. <br /> Click <a href='".curPageURL()."'>here</a> to go back...</h1>";
		}
	} else {
		echo "<h1 align='center'>Invalid Request... Click <a href='".curPageURL()."'>here</a> to go back...</h1>";
	}
	Database::obtain()->close();
} else {
?>
	<div align="center" style="margin: 120px 0px;">
		<form name="changeform" id="changeform"
			action="" method="POST">
			<table>
				<tr>
					<td colspan="2">
						<div id="change_response">
							<!-- spanner -->
						</div>
					</td>
				</tr>
				<tr>
					<td><label for="old_password">Old Password:<br />
					</label></td>
					<td><input name="old_password" type="password" id="old_password"
						style="width: 180px" />
					</td>
				</tr>
				<tr>
					<td><label for="new_password">New Password:<br />
					</label></td>
					<td><input name="new_password" type="password" id="new_password"
						style="width: 180px" onkeypress="PasswordChanged(this)" /> <span
						style="vertical-align: bottom;" id="PasswordStrength"></span>
					</td>
				</tr>
				<tr>
					<td><label for="confirm_password">Confirm Password:<br />
					</label>
					</td>
					<td><input name="confirm_password" type="password"
						id="confirm_password" style="width: 180px" />
					</td>
				</tr>
				<tr height="40px">
					<td align="right"><input id="confirm" name="confirm" type="submit"
						value="Confirm" /></td>
					<td align="center"><input type="button" id="cancel" name="cancel"
						value="Cancel" onclick="window.location='../index.php'" />
					</td>
				</tr>
			</table>
			<input name="uid" type="hidden" id="uid"
				value="<?php echo $_GET["uid"]?>" />
		</form>
	</div>
<?php
}
?>
</div>
<?php 
include_once 'footer.php';
?>
