<script>
function joinsession(sid, uid){
	var ajax = new XMLHttpRequest();
	ajax.open("GET", "account/joinsession.php?sid="+sid+"&uid="+uid);
	ajax.onreadystatechange = function() {
		if(ajax.readyState == 4 && ajax.responseText.replace(/^\s+|\s+$/g, '') == "OK"){
			alert("Join successfully!");
			window.location.reload(true);
		}
	}
	ajax.send();
}
</script>
<br />
<h1 style="color: purple;margin-bottom: 2px;">Advanced Search System</h1>
<hr />
<form method="GET" action="">
	<table id="searchtbl">
		<tr>
			<td class="searchfields">Subject</td>
			<td><select name="subject">
				<option></option>
				<?php 
				$courses = $db->fetch_array("SELECT distinct course_code FROM `session_info`");
				foreach ($courses as $c) {
					echo "<option value='".$c["course_code"]."' "
						.($_GET["subject"] == $c["course_code"] ? "selected='selected'" : "") 
						.">".$c["course_code"]."</option>";
				}
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="searchfields">T.A.</td>
			<td>
				<select name="ta">
					<option></option>
					<?php 
					$tas = $db->fetch_array("SELECT uid, fname, lname FROM `users` WHERE `u_type` = 1");
					foreach ($tas as $t) {
						echo "<option value='".$t["uid"]."' "
						.($_GET["ta"] == $t["uid"] ? "selected='selected'" : "")
						.">".$t["fname"].$t["lname"]."</option>";
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="searchfields">Location</td>
			<td>
				<select name="loc">
					<option></option>	
					<?php 
					$locs = $db->fetch_array("SELECT location FROM `session_info`");
					foreach ($locs as $l) {
						echo "<option value='".$l["location"]."' "
						.($_GET["loc"] == $l["location"] ? "selected='selected'" : "")
						.">".$l["location"]."</option>";
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="searchfields">Date(MM/DD)</td>
			<td><input type="text" name="date" value="<?php echo $_GET["date"]?>" /></td>
		</tr>
		<tr>
			<td></td>
			<td style="text-align: right;">
				<input style="width: 100px;" type="submit" name="search" value="Search" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="action" value="user_home" />
	<input type="hidden" name="content" value="findsession" />
	<input type="hidden" name="user" value="<?php echo $_GET["user"] ? 1 : 0?>" />
</form>
<hr />
<div style="min-height: 635px; padding: 10px;color: purple;">
	<?php 
 	if (isset($_GET["subject"])) {
 		$params = array(
 		 		"course_code" => $_GET["subject"],
 		 		"ta_id" => $_GET["ta"],
 		 		"session_date" => $_GET["date"],
 		 		"location" => $_GET["loc"]
 		);
 		$query = "SELECT * FROM `session_info`, `users` WHERE `uid` = `ta_id` AND ";
 		foreach ($params as $k => $v) {
 			if ($v != "") {
 				$query.= "`$k`='".$v."'";
 				$query .= " AND ";
 			}
 		}
 		$query = rtrim($query, " AND ");
 		$sessions = $db->fetch_array($query);
 		if (count($sessions) == 0) {
 			echo "Your search yielded no result, please try again.";
 		} else {
 			foreach ($sessions as $s) {
 				$query = "SELECT COUNT(*) AS count FROM `session_student` WHERE `session_id` = ".$s["session_id"];
 				$num_enrolled = $db->query_first($query);
 				$query = "SELECT * FROM `session_student` WHERE `session_id` = ".$s["session_id"]." AND `student_id`=" .$session->user->getUid();
 				$enrolled = $db->query_first($query);
 				?>
 		 			<div style="border-style: solid;border-width: 2px;border-color: purple;padding: 10px;width: 500px;margin-bottom: 20px;">
 						<div style="color: white;background-color: purple;padding: 10px;float: left;width: 250px;">
 		 					Subject: <?php echo $s["course_code"]?><br />
 		 					Time: <?php echo $s["session_date"]?> @ <?php echo $s["session_time"]?><br />
 		 					Location: <?php echo $s["location"]?><br />
 		 					T.A.: <?php echo $s["fname"]." ".$s["lname"]?><br />
 		 					Type: <?php echo $s["session_type"] ? "Individual" : "Group"?><br />
 		 				</div>
 		 				<div style="color: white;background-color: purple;padding: 30px;float:right;margin: 20px 20px 0 0;">
 		 					Status: <?php echo ($s["session_space"] > $num_enrolled["count"] ? "Active" : "Full");?>
 		 				</div>
 		 				<table style="clear: both;margin-top: 10px">
 		 					<tr>
 		 						<td><a class="update_btn" href="index.php?action=user_home&content=view_info&user=<?php echo $session->utype?>&TAid=<?php echo $s["ta_id"] ?>">T.A. Profile</a></td>
 		 						<td>
 		 						<?php 
 				 				if ($s["session_space"] > $num_enrolled["count"] && !$enrolled) {
 				 				?>
 				 					<a href="#" onclick="joinsession('<?php echo $s["session_id"]?>', '<?php echo $session->user->getUid(); ?>');" class="update_btn">Join Session</a>
 								<?php 
 				 				}
 								?>
 		 						</td>
 		 					</tr>
 		 				</table>
 		 			</div>
 		 			<?php
 		 		}
 		 	}
 	}
	?>
</div>
