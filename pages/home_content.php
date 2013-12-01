<?php

if ($_GET["user"]){
	$user_query = "SELECT session_id, enroll_date from users join session_student on users.uid = session_student.student_id where users.sid =". $session->user->getSid()." order by enroll_date ASC";
	$user_info = $db->fetch_array($user_query);
	$msg = "";
	$msg2 ="";
	$count_1 = 0;
	foreach ($user_info as $value){
		if ($count_1 <4){
			$session_id =  $value["session_id"];
			$enroll_date = $value["enroll_date"];
			$user_query1 = "SELECT session_date,course_code,session_time,location FROM session_info where session_id =".$session_id;
			$session_info = $db->query_first($user_query1);
			$session_date = $session_info["session_date"];
			$course_code = $session_info["course_code"];
			$session_time = $session_info["session_time"];
			$location = $session_info["location"];
			$msg .= "<p style=' background-color: orange; font-size: 18px;border-style: solid;border-width: 4px;border-color: grey;padding: 3px 3px 3px 3px;margin:15px 5px 15px 5px'>";
			$msg2 .= "<p style=' background-color: orange; font-size: 18px;border-style: solid;border-width: 4px;border-color: grey;padding: 3px 3px 3px 3px;margin:15px 5px 15px 5px'>";
	
			$msg .= $session_date." @ ".$session_time." ". $course_code ." session at ". $location."."."</p>";
			$msg2 .= $enroll_date.": You have successfully enrolled in the ".$course_code." session." ."</p>";
			$count_1 = $count_1 + 1;
		}
	}
	$count_1 = 0;
}else{
	$user_query = "SELECT session_id, enroll_date from users join session_student on users.uid = session_student.student_id where users.sid =". $session->user->getSid()." order by enroll_date ASC";
	$user_info = $db->fetch_array($user_query);
	$msg = "";
	$msg2 ="";
	$count_2 = 0;
	foreach ($user_info as $value){
		if ($count_2 < 2){
			$session_id =  $value["session_id"];
			$enroll_date = $value["enroll_date"];
			$user_query1 = "SELECT session_date,course_code,session_time,location FROM session_info where session_id =".$session_id;
			$session_info = $db->query_first($user_query1);
			$session_date = $session_info["session_date"];
			$course_code = $session_info["course_code"];
			$session_time = $session_info["session_time"];
			$location = $session_info["location"];
			$msg .= "<p style=' background-color: green; font-size: 18px;border-style: solid;border-width: 4px;border-color: grey;padding: 3px 3px 3px 3px;margin:15px 5px 15px 5px'>";
			$msg2 .= "<p style=' background-color: green; font-size: 18px;border-style: solid;border-width: 4px;border-color: grey;padding: 3px 3px 3px 3px;margin:15px 5px 15px 5px'>";
	
			$msg .= $session_date." @ ".$session_time." ". $course_code ." session at ". $location."."."</p>";
			$msg2 .= $enroll_date.": You have successfully enrolled in the ".$course_code." session." ."</p>";
			$count_2 = $count_2 + 1;
		}
	}
	$count2 = 0;
	$ta_query = "SELECT course_code, session_date,location,session_time from users join session_info on users.uid = session_info.ta_id where users.sid =". $session->user->getSid()." order by session_date ASC";
	$ta_info = $db->fetch_array($ta_query);
	$count3 =0;
	foreach ($ta_info as $value){
		if ($count3 < 2){
			$session_date = $value["session_date"];
			$course_code = $value["course_code"];
			$session_time = $value["session_time"];
			$location = $value["location"];
			$msg .= "<p style=' background-color: green; font-size: 18px;border-style: solid;border-width: 4px;border-color: grey;padding: 3px 3px 3px 3px;margin:15px 5px 15px 5px'>";
			$msg .= $session_date." @ ".$session_time." ". $course_code ." session at ". $location."."."</p>";
			$msg2 .= "<p style=' background-color: green; font-size: 18px;border-style: solid;border-width: 4px;border-color: grey;padding: 3px 3px 3px 3px;margin:15px 5px 15px 5px'>";
			$msg2 .= " You have successfully created a session for ".$course_code." on ". $session_date ."</p>";
			$count3 = $count3 +1;
		}
	}

}
if ($msg == ""){
	$msg = "No Reminder Aavailable !";
}
if ($msg2 == ""){
	$msg2 = "No Current Event Available !";
}

?>
<div style="height: 250px;background-color: <?php echo $color?>;margin:50px 0px 60px 0px; border-color: <?php echo $color?>">
	<label style="color: white; font-size: 25px"> Reminder: <br>
	
	
	
	
						<?php echo $msg?>
						
				</label> <br />
</div>
<hr />
<div style="height: 250px;background-color: <?php echo $color?>;margin:50px 0px 50px 0px; border-color: <?php echo $color?>">
	<label style="color: white; font-size: 25px"> Rencent Event: <br>
	
	
	
	
					<?php echo $msg2?>
						
				</label>

</div>
<hr />
