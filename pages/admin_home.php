<?php
$color = "#4EA7C5";
$user_type = "admin";
$name = "Andy";
$last_login = "Oct 8th, 2011 5:25"; 
include_once 'banner.php';
?>
<div class="main_container" style="padding: 0px;margin: 0px;">
	<div class="left_container" style="background-image: url('images/<?php echo $user_type?>.png');height: 828px;">
		<div class="user_type" style="background-image: url('images/<?php echo $user_type?>_type.png'); border-color: <?php echo $color?>">
			<h1>Admin</h1>
		</div>
		<div class="user_info" style="background-color: <?php echo $color?>">
			User: <?php echo $session->user->getFname() . " " . $session->user->getLname();?><br />
			Email: <?php echo $session->user->getEmail();?><br />
			Last login: <?php echo $last_login?>
		</div>
		<div style="margin:50px 0px 50px 120px; width: 180px; padding: 5px;background-color: #FFF;color: #FFF;">
			<?php 
			foreach (array(
				"System Stats"=>"system_stats", 
				"Manage Users"=>"manageuser", 
				"Manage Sessions"=>"searchsession"
			) as $k => $v) {
				?>
				<div style="background-color: <?php echo $color?>;padding:20px 0px;margin-bottom:5px;text-align: center;">
					<a href="index.php?action=admin_home&content=<?php echo $v?>" style="text-decoration: none;color: #FFF;font-style: normal;"><?php echo $k?></a>
				</div>
				
			<?php 
			}
			?>
		</div>
	</div>
	<div class="right_container">
		<div id="content" style="height:780px">
			<?php 
				if (isset($_GET["content"])) {
					$filename = "pages/" . $_GET["content"] . ".php";
					if (file_exists($filename))
						include_once($filename);
					else
						include_once("pages/error.php");
				}
			?>
		</div>
		<hr />
		<?php 
		include_once 'footer.php';
		?>
	</div>
</div>