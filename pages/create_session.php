<h1>Create New Session:</h1>
<fieldset style="margin-top: 25px; margin-right: 225px; padding: 20px 20px; border-color: #9BC45C;">
<form name="regform" id="regform" action="account/session.php" method="POST">
<table style="font-size: 15px;color: #FFF;">
	<label id = error_display style="color: red"><?php echo $session->session_msg ?></label>
	<?php $session->session_msg = ""?>
	<tr>
		<td class="session_button">Type:</td>
		<td colspan="3"><input class="field" style="border-color: #799B3F" type="text" name="session_type" id="session_type" value=""></td>
	</tr>
	<tr>
		<td class="session_button">Subject:</td>
		<td colspan="3"><input class="field" style="border-color: #799B3F" type="text" name="course_code" id="course_code" value=""></td>
	</tr>
	<tr>
		<td class="session_button">Date:</td>
		<td colspan="3"><input class="field" style="border-color: #799B3F" type="date" name="session_date" id="session_date" value=""></td>
	</tr>
	<tr>
		<td class="session_button">Time:</td>
		<td colspan="3"><input class="field" style="border-color: #799B3F" type="time" name="session_time" id="session_time" value=""></td>
	</tr>
	<tr>
		<td class="session_button">Location:</td>
		<td colspan="3"><input class="field" style="border-color: #799B3F" type="text" name="location" id="location" value=""></td>
	</tr>
	<tr>
		<td class="session_button">Fee:</td>
		<td colspan="3"><input class="field" style="border-color: #799B3F" type="text" name="fee" id="fee" value=""></td>
	</tr>
	<tr>
		<td class="session_button">Group Size:</td>
		<td colspan="3"><input class="field" style="border-color: #799B3F" type="text" name="session_space" id="session_space" value=""></td>
	</tr>
	<tr>
		<td><input class="confirm_btn" type="submit"  name="create" id="create" value="Create" /></td>
		<td><input class="confirm_btn" type="reset"  name="reset" id="reset" value="Reset" /></td>
	</tr>
	</table>
</form>
</fieldset>