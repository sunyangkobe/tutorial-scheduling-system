<div id="banner">
	<div id = "banner_title">
		<span style="font-size: 60px">
			<span style="color: #5DAEE1">U</span><span style="color: #C5C416">T</span><span style="color: #DB7925">S</span><span style="color: #9D93C0">C</span>
		</span>
		<span style="font-size: 30px">
			<span style="color: #5DAEE1">Acc</span><span style="color: #C5C416">essa</span><span style="color: #DB7925">bil</span><span style="color: #9D93C0">ity</span>
		</span>
	</div>
	
	<div id="banner_hr">
		Tomorrow is created here.
	</div>
	<?php
	$session = Session::getInstance(); 
	if (isset($session->user)) {
		?>
		<a href="account/logout.php" style="margin-left: 950px;font-size: 15px;color: #FFF;font-style: normal;">Log Off</a>
		<?php 
	}
	?>
</div>