<h1>Manage Sessions:</h1>
<?php
$ta_query = "SELECT session_id, course_code, session_date, session_time, location, fee 
	from users join session_info on users.uid = session_info.ta_id where users.sid =". $session->user->getSid();
$ta_info = $db->fetch_array($ta_query);
foreach ($ta_info as $value)
{
?>
<div id="inner_box" style="margin-top: 15px; margin-right: 260px">
	<?php
	$session_id = $value["session_id"];
	$course_code = $value["course_code"];
	$session_date = $value["session_date"];
	$session_time = $value["session_time"];
	$location = $value["location"];
	$fee = $value["fee"];
	?>

	Subject: <?php echo $course_code?><br />
	Session Date: <?php echo $session_date?><br />
	Session Time: <?php echo $session_time?><br />
	Location: <?php echo $location?><br />
	Fee: <?php echo $fee?><br />
				
	<form name="regform" id="regform" action="account/manage_session.php" method="POST">
	<input type="hidden" name="session_id" id="session_id" value="<?php echo $session_id?>">
	<table style="font-size: 15px;color: #FFF;">
	<tr>
	<td class="session_button">Reschedule to:</td>
	<td><input class="session_field" 
		style="border-color: #799B3F;width: 90px;" type="date" name="session_date" id="session_date" value="<?php echo $session_date?>"></td>
	<td class="session_button">@:</td>
	<td><input class="session_field" 
		style="border-color: #799B3F;width: 60px;" type="time" name="session_time" id="session_time" value="<?php echo $session_time?>"></td>
	</tr>
	<tr>
	<td class="session_button">New Location:</td>
	<td colspan="3"><input class="session_field" 
		style="border-color: #799B3F;width: 210px;" type="text" name="location" id="location" value="<?php echo $location?>"></td>
	</tr>
	<tr>
	<td><input class="confirm_btn" type="submit"  name="create" id="create" value="Update" /></td>
	</form>
	<form name="remform" id="remform" action="account/remove_session.php" method="POST">
	<input type="hidden" name="session_id" id="session_id" value="<?php echo $session_id?>">
	<td colspan="3"><input class="confirm_btn" type="submit"  name="remove" id="remove" value="Remove Session" /></td>
	</form>
	</tr>	
	</table>
</div>
<?php
}
?>