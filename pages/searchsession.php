<?php 
$db = Database::obtain();
$db->connect();
?>
<br />
<h1 style="margin-bottom: 2px;">Search for Sessions:</h1>
<hr />
<form method="GET" action="">
	<table id="searchtbl">
		<tr>
			<td class="searchUser">Subject</td>
			<td><input type="text" name="subject" value="<?php echo $_GET["subject"]?>" />
			</td>
		</tr>
		<tr>
			<td class="searchUser">T.A.</td>
			<td><input type="text" name="ta" value="<?php echo $_GET["ta"]?>" />
			</td>
		</tr>
		<tr>
			<td class="searchUser">Location</td>
			<td><input type="text" name="loc" value="<?php echo $_GET["loc"]?>" />
			</td>
		</tr>
		<tr>
			<td class="searchUser">Date</td>
			<td><input type="text" name="date" value="<?php echo $_GET["date"]?>" /></td>
		</tr>
		<tr>
			<td></td>
			<td style="text-align: right;">
				<input style="width: 100px;" type="submit" name="search" value="Search" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="action" value="admin_home" />
	<input type="hidden" name="content" value="searchsession" />
</form>
<hr />
<div style="min-height: 550px; padding: 10px;">
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
 				?>
 		 			<div style="border-style: solid;border-width: 2px;border-color: purple;padding: 10px;width: 500px;margin-bottom: 20px;background-color: #4EA7C5;">
 						<div style="color: white;background-color: #9BC45C;padding: 10px;height: 100px;">
 		 					<div style="float: left;width: 250px">
	 		 					Subject: <?php echo $s["course_code"]?><br />
	 		 					Time: <?php echo $s["session_date"]?><br />
	 		 					Location: <?php echo $s["location"] ?><br />
	 		 					T.A.: <?php echo $s["fname"].$s["lname"]?><br />
	 		 					Contact: <?php echo $s["email"] ?><br />
 		 					</div>
 		 					<div style="float: right;padding: 10px;">
	 		 					<a class="searchUser_btn" href="#">Adjust Session</a><br /><br />
 		 					</div>
 		 				</div>
 		 			</div>
 		 			<?php
 		 		}
 		 	}
 	}
	?>
</div>
<?php 
Database::obtain()->close();
?>