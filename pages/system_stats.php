<h1>System statistics:</h1>
<div id="chart_div"
	style="width: 600; height: 400"></div>

	<?php
	Database::obtain()->connect();
	$db = Database::obtain();
	$user_query = "SELECT COUNT(*) FROM users;";
	$user_query2 = "SELECT COUNT(*) FROM admin;";
	$user_query3 = "SELECT COUNT(*) FROM users WHERE users.u_type = 0";
	$user_query4 = "SELECT COUNT(*) FROM users WHERE users.u_type = 1";
	$user_num_array = $db->query_first($user_query);
	$admin_num_array = $db->query_first($user_query2);
	$student_num_array = $db->query_first($user_query3);
	$TA_num_array = $db->query_first($user_query4);
	$user_num =  $user_num_array["COUNT(*)"];
	$admin_num = $admin_num_array["COUNT(*)"];
	$student_num = $student_num_array["COUNT(*)"];
	$TA_num = $TA_num_array["COUNT(*)"];
	Database::obtain()->close();
	?>

<div id="content" style="height: 780px">
	<!--Load the AJAX API-->
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript">
							    
			    // Load the Visualization API and the piechart package.
				google.load('visualization', '1.0', {'packages':['corechart']});
							      
				// Set a callback to run when the Google Visualization API is loaded.
				google.setOnLoadCallback(drawChart);
							
				// Callback that creates and populates a data table, 
				// instantiates the pie chart, passes in the data and
			    // draws it.
				function drawChart() {
							
				// Create the data table.
				var data = new google.visualization.DataTable();
				data.addColumn('string', 'User Type');
				data.addColumn('number', 'Number');
				data.addRows([
					['Admin: <?php echo ceil(100*($admin_num/$user_num))?><?php echo"%"?>', <?php echo $admin_num?>],
					['Student: <?php echo floor(100*(($student_num)/$user_num))?><?php echo"%"?>', <?php echo $student_num?>], 
					['T.A.:<?php echo floor(100*($TA_num/$user_num))?><?php echo"%"?>', <?php echo $TA_num?>]
				]);
							
				// Set chart options
				var options = {'title':'User Percentage in System',
							   'width':600,
							   'height':400};
							
				// Instantiate and draw our chart, passing in some options.
				var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
				chart.draw(data, options);
							
				}
			</script>

	<div style="margin:120px 0px 0px 0px;background-color: <?php echo $color?>;height:150px">
		<p style="color: white">
			Numbers of Admin:
			<?php echo $admin_num?>
		</p>
		<p style="color: white">
			Numbers of T.A.:
			<?php echo $TA_num?>
		</p>
		<p style="color: white">
			Numbers of Students:
			<?php echo $student_num?>
		</p>
		<p style="color: white">
			Total number of Users:
			<?php echo $user_num?>
		</p>
	</div>
</div>
<hr />
