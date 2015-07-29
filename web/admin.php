<!DOCTYPE html>
<?php
require_once('includes/database/DB.php');
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
				url: "../web/includes/functions/make_schedule.php",
				success: function(result) {
					var output = result.split(",");
					var count = 0;
					$("td").html(function(n){
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
<table>
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
	$data = mysqli_query($connection, "SELECT * FROM guides");
	$num = 1;
	while ($row = mysqli_fetch_assoc($data)) {
		echo $num.": ".$row["Name"]."	".translate_availability($row["Availability"]);
		echo "<br/>";
		$num++;
	}
	function translate_availability($avail) {
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
	}
	?>
</div>
</body>
</html>