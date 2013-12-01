

		<div style="margin: 30px 12px 50px 0px">
				<h1> Account Info</h1>
				<hr />
				<label style="margin: 0px 20px 50px 0px; color: white; background-color:<?php echo $color?>; border-color: <?php echo $color?>;font-size: 20px"> Name:</label> <label style="color: white; background-color:<?php echo $color?>; border-color: <?php echo $color?>;font-size: 20px"><?php echo $session->user->getFname()." ".$session->user->getMiddle_name()." ". $session->user->getLname() ?></label><br />
				<br />
				<label style="margin: 0px 20px 50px 0px;color: white; background-color:<?php echo $color?>; border-color: <?php echo $color?>;font-size: 20px"> Student ID:</label> <label style="color: white; background-color:<?php echo $color?>; border-color: <?php echo $color?>;font-size: 20px"><?php echo $session->user->getSid() ?></label><br />
				<br />
				<label style="margin: 0px 20px 50px 0px;color: white; background-color:<?php echo $color?>; border-color: <?php echo $color?>;font-size: 20px"> Email:</label> <label style="color: white; background-color:<?php echo $color?>; border-color: <?php echo $color?>;font-size: 20px"><?php echo $session->user->getEmail() ?></label><br />
				<br />
				<label style="margin: 0px 20px 50px 0px;color: white; background-color:<?php echo $color?>; border-color: <?php echo $color?>;font-size: 20px"> Phone:</label> <label style="color: white; background-color:<?php echo $color?>; border-color: <?php echo $color?>;font-size: 20px"><?php echo $session->user->getTelephone() ?></label><br />
		</div>
		<hr />
		<form name="UpdateInfo" id="UpdateInfo" action="account/update_info.php"
		method="POST">
			<div style="margin: 30px 12px 50px 0px">
					<label style="color:red"><?php echo $session->update_err ?></label>
					<?php unset($session->update_err)?>
					<h2> Update Contact</h1>
					<label style="margin: 0px 20px 50px 0px;color: white; background-color:<?php echo $color?>; border-color: <?php echo $color?>;font-size: 20px"> New Email: </label><input class="field" style="border-color: <?php echo $color?>" type="text" name="email" id="email" value=""><br />
					<br />
					<label style="margin: 0px 20px 50px 0px;color: white; background-color:<?php echo $color?>; border-color: <?php echo $color?>;font-size: 20px"> Retype your new Email:  </label><input class="field" style="border-color: <?php echo $color?>" type="text" name="v_email" id="v_email" value=""><br />
					<br />
					<label style="margin: 0px 20px 150px 0px;color: white; background-color:<?php echo $color?>; border-color: <?php echo $color?>;font-size: 20px"> Phone:  </label><input class="field" style="border-color: <?php echo $color?>" type="text" name="phone" id="phone" value=""><br />
					<br />
					<br />
					<br />
					<h2> Change Password</h1>
					<label style="margin: 0px 20px 50px 0px;color: white; background-color:<?php echo $color?>; border-color: <?php echo $color?>;font-size: 20px"> New Password: </label><input class="field" style="border-color: <?php echo $color?>" type="password" name="pwd" id="pwd" value=""><br />
					<br />
					<label style="margin: 0px 20px 50px 0px;color: white; background-color:<?php echo $color?>; border-color: <?php echo $color?>;font-size: 20px"> Retype your new Password: </label><input class="field" style="border-color: <?php echo $color?>" type="password" name="r_pwd" id="r_pwd" value=""><br />
					<br />
					<br />
					<?php
						if ($_GET["user"]){
							echo "<input class='update_student' type='submit'  name='submit' id='submit' value='Update' />";	
						}else{
							echo "<input class='update_ta' type='submit'  name='submit' id='submit' value='Update' />";
						}
						
					?>
					<br />
			</div>
		</form>
		