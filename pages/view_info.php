		<?php
			$ta_id = $_GET["TAid"];

			$db = Database::obtain();		
			$user_query = "SELECT fname, middle_name, lname,email,phone,last_login FROM users where uid = ".$ta_id;
			$ta_info = $db->query_first($user_query);
			$ta_name = strtoupper($ta_info["fname"])." ".strtoupper($ta_info["middle_name"])." ".strtoupper($ta_info["lname"]);
			$ta_email = $ta_info["email"];
			$ta_phone = $ta_info["phone"];
			$ta_lastlogin = $ta_info["last_login"];
			if (empty($ta_phone)){
				$ta_phone = "Not Available";
			}
		
		?>
		<div style="margin: 30px 12px 50px 0px">
				<h1> Account Info</h1>
				<hr />
				<label style="margin: 0px 20px 50px 0px; color: white; background-color:<?php echo $color?>; border-color: <?php echo $color?>;font-size: 20px"> Name:</label> <label style="color: white; background-color:<?php echo $color?>; border-color: <?php echo $color?>;font-size: 20px"><?php echo $ta_name ?></label><br />
				<br />
				<label style="margin: 0px 20px 50px 0px;color: white; background-color:<?php echo $color?>; border-color: <?php echo $color?>;font-size: 20px"> Email:</label> <label style="color: white; background-color:<?php echo $color?>; border-color: <?php echo $color?>;font-size: 20px"><?php echo $ta_email ?></label><br />
				<br />
				<label style="margin: 0px 20px 50px 0px;color: white; background-color:<?php echo $color?>; border-color: <?php echo $color?>;font-size: 20px"> Phone:</label> <label style="color: white; background-color:<?php echo $color?>; border-color: <?php echo $color?>;font-size: 20px"><?php echo $ta_phone ?></label><br />
				<br />
				<label style="margin: 0px 20px 50px 0px;color: white; background-color:<?php echo $color?>; border-color: <?php echo $color?>;font-size: 20px"> Last login:</label> <label style="color: white; background-color:<?php echo $color?>; border-color: <?php echo $color?>;font-size: 20px"><?php echo $ta_lastlogin ?></label><br />
				<br />
		</div>
		<hr />
		