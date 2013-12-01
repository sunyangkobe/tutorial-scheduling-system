<?php
include_once 'banner.php';
?>
<div class="main_container">
	<div style="color: #E27453;">
		<h2>Web Access Registration:</h2>
		<p>In order to access our tutoring system, please complete the form below:<br />
		( *-required information)
		</p>
	</div>
	<hr />
	<h1 style="color: #799B3F;">Registration Form</h1>
	<div id='error_notification' style='color: red;'><?php echo $session->errormsg ?></div>
	<?php
		unset($session->errormsg);
	?>
	<form name="regform" id="regform" action="account/register.php"
			method="POST">
		<table style="font-size: 15px;color: #FFF">
			<tr>
				<td class="field_button" style="padding: 0 20px">Given Name*:</td>
				<td><input class="field" style="border-color: #799B3F" type="text" name="given" id="given" value="<?php echo $session->fname ?>"></td>
				<td class="field_button" style="padding: 0 20px">Middle Name:</td>
				<td><input class="field" style="border-color: #799B3F" type="text" name="middle" id="middle" value="<?php echo $session->middle_name ?>"></td>
			</tr>
			<tr>
				<td class="field_button" style="padding: 0 20px">Surname*:</td>
				<td colspan="3"><input class="field" style="border-color: #799B3F" type="text" name="surname" id="surname" value="<?php echo $session->lname ?>"></td>
			</tr>
		</table>
		<br /><br />
		<table style="font-size: 15px;color: #FFF">
			<tr>
				<td class="field_button" style="padding: 0 20px">Student ID*:</td>
				<td colspan="3"><input class="field" style="border-color: #799B3F" type="text" name="sid" id="sid" value="<?php echo $session->sid ?>"></td>
			</tr>
			<tr>
				<td class="field_button" style="padding: 0 20px">E-mail*:</td>
				<td colspan="3"><input class="field" style="border-color: #799B3F" type="text" name="email" id="email" value="<?php echo $session->email ?>"></td>
			</tr>
			<tr>
				<td class="field_button" style="padding: 0 20px">Verify E-mail*:</td>
				<td colspan="3"><input class="field" style="border-color: #799B3F" type="text" name="v_email" id="v_email" value="<?php echo $session->vemail ?>"></td>
			</tr>
			<tr>
				<td class="field_button" style="padding: 0 20px">Tel(123-456-7890):</td>
				<td colspan="3"><input class="field" style="border-color: #799B3F" type="text" name="tel" id="tel" value="<?php echo $session->telephone ?>"></td>
			</tr>
		</table>
		<br /><br />
		<table style="font-size: 15px;color: #FFF">
			<tr>
				<td class="field_button" style="padding: 0 20px">Password*:</td>
				<td colspan="3"><input class="field" style="border-color: #799B3F" type="password"  id="pwd"  name="pwd" value=""></td>
			</tr>
			<tr>
				<td class="field_button" style="padding: 0 20px">Retype password:</td>
				<td colspan="3"><input class="field" style="border-color: #799B3F" type="password" name="r_pwd" id="r_pwd" value=""></td>
			</tr>
		</table>
		<div class="box" style="font-size: 15px;color: #FFF;padding: 0 10px;">
			<h3>Terms and Conditions:</h3>
			<ul>
				<li>I will not exploit my privilege either as an student/TA.</li>
				<li>I will be responsible for my session, and properly notify all associated parties with any changes to status of these session.</li>
				<li>I will try my best to create an friendly/non-hostile environment.</li>
				<li>I acknowledge that I am responsible for all my actions on this web service, and will not attempt any illegal actions.</li>
				<li>the admin reserves the right to suspend/remove me from the web service if inappropriate activity were detected.</li>
				<li>No profane/inappropriate activities are allow on this website.</li>
				<li>Cyber bullying is absolute prohibited.</li>
			</ul>
		</div>	
		<table>
			<tr>
				<td>
					<input class="confirm_btn" type="submit"  name="submit" id="submit" value="Agree and Submit" />
				</td>
				<td>
					<input class="confirm_btn" type="reset"  name="reset" id="reset" value="Reset" />
				</td>
			</tr>
		</table>
	</form>
	<hr />
<?php
include_once 'footer.php';
?>
</div>