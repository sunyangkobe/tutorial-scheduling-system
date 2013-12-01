<h1>Rate T.A.</h1>
<?php
$ta_query = "SELECT uid, fname, middle_name, lname, course_code, session_student.session_id, session_date, session_time, location
	     from session_student join session_info join users
		on session_student.session_id = session_info.session_id
	     and session_info.ta_id = users.uid
	     where session_student.student_id = ". $session->user->getUid();
$ta_info = $db->fetch_array($ta_query);
if (empty($ta_info)){
	echo "<label style='color: red'> You are not enrolled in any sessions</label>";
	
}

foreach ($ta_info as $value)
{
?>
	<div id="rate_box" style="margin-right: 115px">
		<?php
		$target_id = $value["uid"];
		$course_code = $value["course_code"];
		$session_id = $value["session_id"];
		$session_date = $value["session_date"];
		$session_time = $value["session_time"];
		$location = $value["location"];
		$ta = $value["fname"] . ", " . $value["middle_name"] . " " .$value["lname"];
		$score_q = "SELECT * FROM rate_ta WHERE session_id=".$session_id." AND target_id=".$target_id." AND rater_id=".$session->user->getUid();
		$rate_info = $db->query_first($score_q);
		?>

		Subject: <?php echo $course_code?><br />
		Session Date: <?php echo $session_date?> @ <?php echo $session_time?><br />
		Location: <?php echo $location?><br />

		T.A.:	<span style="text-decoration: underline;"><?php echo $ta?></span>
		<form name="regform" id="regform" action="account/rate_ta.php" method="POST">
		<input type="hidden" name="session_id" id="session_id" value="<?php echo $session_id?>">
		<input type="hidden" name="rater_id" id="rater_id" value="<?php echo $session->user->getUid()?>">
		<input type="hidden" name="target_id" id="target_id" value="<?php echo $target_id?>">
		<table>
			<tr style="float:left;">
				<td>Rate: </td>
				<td><input class="field" style="border-color: #799B3F; width: 15px; height: 15px" 
					type="text" name="score" id="score" value="<?php echo (isset($rate_info["score"]) ? $rate_info["score"] : "")?>"></td>
 				<td>/5</td>
			</tr>
			<tr>
				<td colspan="3"> <textarea rows="4" name="comment" id="comment"
							cols="47" wrap="hard" style="resize: none;"><?php echo (isset($rate_info["comment"]) ? $rate_info["comment"] : "")?></textarea></td>
				<td><input class="confirm_btn" type="submit"  name="update" id="update" value="Update" /></td>
			</tr>
		</table>
		</form>
	</div>
<?php 
}
?>