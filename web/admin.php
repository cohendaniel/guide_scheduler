<!DOCTYPE html>
<?php
//require_once('includes/database/DB.php');

//local windows access -- use below instead
require_once('./includes/database/DB_local.php');
?>
<html>
<head>
	<title>Bowdoin College Tour Guide Schedule</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	
	<script type = "text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script>
	$(document).ready(function() {
		console.log("in function");
		$("input").click(function() {
			console.log("clicked");
			$.ajax({
				url: "./includes/functions/make_schedule.php",
				success: function(result) {
					var output = result.split(",");
					var count = 0;
					$("#schedule td").html(function(n){
						count++;
						console.log(n + "->" + (((n%5)*12)+Math.floor(n/5)) + " (" + output[((n%5)*12)+Math.floor(n/5)] + ")");
						return output[((n%5)*12)+Math.floor(n/5)];
					});
					document.getElementById("fail").innerHTML = output[count];
				}
			});
		});
	});
	</script>
</head>
<body class = "no-margin">

<h1>Bowdoin College <em>Tour Guide Scheduler</em></h1>

<div style="text-align: center;">
<input name="make_schedule" type="button" value = "Generate Schedule" />
</div>

<br></br>
<table id = "schedule">
	<tr>
		<th></th>
		<th class="horiz">Monday</th>
		<th class="horiz">Tuesday</th>
		<th class="horiz">Wednesday</th>
		<th class="horiz">Thursday</th>
		<th class="horiz">Friday</th>
	<tr>
		<th rowspan="3" class="vert">9:30</th>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td class="bold"></td>
		<td class="bold"></td>
		<td class="bold"></td>
		<td class="bold"></td>
		<td class="bold"></td>
	</tr>
	<tr>
		<th rowspan="3" class="vert">11:30</th>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td class="bold"></td>
		<td class="bold"></td>
		<td class="bold"></td>
		<td class="bold"></td>
		<td class="bold"></td>
	</tr>
	<tr>
		<th rowspan="3" class="vert">1:30</th>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td class="bold"></td>
		<td class="bold"></td>
		<td class="bold"></td>
		<td class="bold"></td>
		<td class="bold"></td>
	</tr>
	<tr>
		<th rowspan="3" class="vert">3:30</th>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
</table>

<div id="fail">
	Errors will appear here.
</div>

<div id="show_guides">
	<h3>
		Guides who have submitted forms:
	</h3>
	<?php
	$data = mysqli_query($connection, "SELECT Name FROM guides ORDER BY Name");
	$num = 1;
	while($row = mysqli_fetch_array($data)) {
		echo $num.".  ".$row[0]."<br/>";
		$num++;
	}
	/*function translate_availability($avail) {
		$ret = "";
		for ($i = 0; $i < 20; $i++) {
			if ($avail[$i] == 1) {
				if ($i < 4) {
					$ret = $ret."Monday ";
					if ($i % 4 == 0) $ret = $ret."9:30, ";
					elseif ($i % 4 == 1) $ret = $ret."11:30, ";
					elseif ($i % 4 == 2) $ret = $ret."1:30, ";
					elseif ($i % 4 == 3) $ret = $ret."3:30, ";
				}
				elseif ($i < 8) {
					$ret = $ret."Tuesday ";
					if ($i % 4 == 0) $ret = $ret."9:30, ";
					elseif ($i % 4 == 1) $ret = $ret."11:30, ";
					elseif ($i % 4 == 2) $ret = $ret."1:30, ";
					elseif ($i % 4 == 3) $ret = $ret."3:30, ";
				}
				elseif ($i < 12) {
					$ret = $ret."Wednesday ";
					if ($i % 4 == 0) $ret = $ret."9:30, ";
					elseif ($i % 4 == 1) $ret = $ret."11:30, ";
					elseif ($i % 4 == 2) $ret = $ret."1:30, ";
					elseif ($i % 4 == 3) $ret = $ret."3:30, ";
				}
				elseif ($i < 16) {
					$ret = $ret."Thursday ";
					if ($i % 4 == 0) $ret = $ret."9:30, ";
					elseif ($i % 4 == 1) $ret = $ret."11:30, ";
					elseif ($i % 4 == 2) $ret = $ret."1:30, ";
					elseif ($i % 4 == 3) $ret = $ret."3:30, ";
				}
				else {
					$ret = $ret."Friday ";
					if ($i % 4 == 0) $ret = $ret."9:30, ";
					elseif ($i % 4 == 1) $ret = $ret."11:30, ";
					elseif ($i % 4 == 2) $ret = $ret."1:30, ";
					elseif ($i % 4 == 3) $ret = $ret."3:30, ";
				}
			}
		}
		return trim($ret, ", ");
	}*/
	?>
	<h3>
		Report
	</h3>
	<div id = "M930">
	<?php
		$guides_in_slots = array();
		for ($i = 1; $i <= 20; $i++) {
			$guides_in_slots[$i] = "";
			$sql = "SELECT * FROM guides WHERE SUBSTRING(Availability,".$i.", 1) = '1'";
			$slot = mysqli_query($connection, $sql);
			while ($guide_in_slot = mysqli_fetch_assoc($slot)) {
				$guides_in_slots[$i] = $guides_in_slots[$i].$guide_in_slot["Name"]."<br/>";
				//echo $guide_in_slot["Name"]."<br/>";
			}
		}
	?>
	<table id = "report">
		<tr>
			<th></th>
			<th class="horiz">Monday</th>
			<th class="horiz">Tuesday</th>
			<th class="horiz">Wednesday</th>
			<th class="horiz">Thursday</th>
			<th class="horiz">Friday</th>
		</tr>
		<tr>
			<th rowspan="1" class="vert">9:30</th>
			<td><?php echo $guides_in_slots[1] ?></td>
			<td><?php echo $guides_in_slots[5] ?></td>
			<td><?php echo $guides_in_slots[9] ?></td>
			<td><?php echo $guides_in_slots[13] ?></td>
			<td><?php echo $guides_in_slots[17] ?></td>
		</tr>
		<tr>
			<th rowspan="1" class="vert">11:30</th>
			<td><?php echo $guides_in_slots[2] ?></td>
			<td><?php echo $guides_in_slots[6] ?></td>
			<td><?php echo $guides_in_slots[10] ?></td>
			<td><?php echo $guides_in_slots[14] ?></td>
			<td><?php echo $guides_in_slots[18] ?></td>
		</tr>
		<tr>
			<th rowspan="1" class="vert">1:30</th>
			<td><?php echo $guides_in_slots[3] ?></td>
			<td><?php echo $guides_in_slots[7] ?></td>
			<td><?php echo $guides_in_slots[11] ?></td>
			<td><?php echo $guides_in_slots[15] ?></td>
			<td><?php echo $guides_in_slots[19] ?></td>
		</tr>
		<tr>
			<th rowspan="1" class="vert">3:30</th>
			<td><?php echo $guides_in_slots[4] ?></td>
			<td><?php echo $guides_in_slots[8] ?></td>
			<td><?php echo $guides_in_slots[12] ?></td>
			<td><?php echo $guides_in_slots[16] ?></td>
			<td><?php echo $guides_in_slots[20] ?></td>
		</tr>
		
	</table>
	<div>
		
	</div>
	
</div>
</body>
</html>