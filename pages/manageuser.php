<?php 
$db = Database::obtain();
$db->connect();
?>
<br />
<h1 style="margin-bottom: 2px;">Search for Users:</h1>
<hr />
<form method="GET" action="">
	<table id="searchtbl">
		<tr>
			<td class="searchUser">Surname</td>
			<td><input type="text" name="surname" value="<?php echo $_GET["surname"]?>" />
			</td>
		</tr>
		<tr>
			<td class="searchUser">Given name</td>
			<td><input type="text" name="given" value="<?php echo $_GET["given"]?>" />
			</td>
		</tr>
		<tr>
			<td class="searchUser">Student ID</td>
			<td><input type="text" name="sid" value="<?php echo $_GET["sid"]?>" />
			</td>
		</tr>
		<tr>
			<td class="searchUser">Email</td>
			<td><input type="text" name="email" value="<?php echo $_GET["email"]?>" /></td>
		</tr>
		<tr>
			<td></td>
			<td style="text-align: right;">
				<input style="width: 100px;" type="submit" name="search" value="Search" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="action" value="admin_home" />
	<input type="hidden" name="content" value="manageuser" />
</form>
<hr />
<div style="min-height: 550px; padding: 10px;">
	<?php 
 	if (isset($_GET["surname"])) {
 		$params = array(
 		 		"lname" => $_GET["surname"],
 		 		"fname" => $_GET["given"],
 		 		"sid" => $_GET["sid"],
 		 		"email" => $_GET["email"]
 		);
 		$query = "SELECT * FROM `users`";
 		if ($_GET["surname"] != "" || $_GET["given"] != "" || $_GET["sid"] != "" || $_GET["email"] != "") {
 			$query .= " WHERE ";
 		}
 		foreach ($params as $k => $v) {
 			if ($v != "") {
 				$query.= "`$k`='".$v."'";
 				$query .= " AND ";
 			}
 		}
 		$query = rtrim($query, " AND ");
 		$users = $db->fetch_array($query);
 		if (count($users) == 0) {
 			echo "Your search yielded no result, please try again.";
 		} else {
 			foreach ($users as $s) {
 				?>
 		 			<div style="border-style: solid;border-width: 2px;border-color: purple;padding: 10px;width: 500px;margin-bottom: 20px;background-color: #4EA7C5;">
 						<div style="color: white;background-color: #9BC45C;padding: 10px;height: 100px;">
 		 					<div style="float: left;width: 250px">
	 		 					Name: <?php echo $s["fname"].$s["lname"]?><br />
	 		 					ID: <?php echo $s["sid"]?><br />
	 		 					Type: <?php echo $s["u_type"] ? "Student" : "T.A." ?><br />
	 		 					Last login: <?php echo $s["last_login"]?><br />
	 		 					Contact: <?php echo $s["email"] ?><br />
 		 					</div>
 		 					<div style="float: right;padding: 10px;">
	 		 					<a class="searchUser_btn" href="#">Promote to T.A.</a><br /><br />
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