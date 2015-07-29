<!DOCTYPE html>
<html>
<head>
	<title>Bowdoin College Tour Guide Schedule</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class = "no-margin">

<h1>Bowdoin College <em>Tour Guide Scheduler</em></h1>

<div id="background-color">
	<form enctype="application/x-www-form-urlencoded" method="post" target="_self" action="index.php">
	<div id="info" class = "vertical-line">
		<h2 class = "section-header">Personal Info</h2>
		
		<p><b>Name: </b><input type="text" name = "guidename"/></p>

		<p><b>Gender: </b>
			<select name = "gender">
				<option value="male">Male</option>
				<option value="female">Female</option>
			</select>
		</p>

		<p><b>Class year: </b>
			<select name = "class_year">
				<option value="2016">2016</option>
				<option value="2017">2017</option>
				<option value="2018">2018</option>
				<option value="2019">2019</option>
			</select>
		</p>

		<p><b>Major: </b>
			<select name = "major">
				<?php
					$major_list = file("includes/text/majors.txt");
					foreach ($major_list as $major) {
						echo $major;
						list($name, $value) = explode(",", $major);
						echo '<option value="'.$value.'">'.$name.'</option>'; 
					}
				?>
			</select>
		</p>

		<p><b>Home state: </b>
			<select name = "state">
				<?php
					$state_list = file("includes/text/states.txt");
					foreach ($state_list as $state) {
						echo $state;
						list($name, $value) = explode(",", $state);
						echo '<option value="'.$value.'">'.$name.'</option>'; 
					}
				?>
			</select>
		</p>

		<p><b>Ethnicity: </b>
			<select name = "ethnicity">
				<option value="asian">Asian/Pacific Islander</option>
				<option value="black">Black or African American</option>
				<option value="hispanic">Hispanic or Latino</option>
				<option value="hispanic">Native American or American Indian</option>
				<option value="white">White</option>
				<option value="hispanic">Other/Multiple</option>
			</select>
		</p>

		<p><b>Public School: </b>
			<input name="school" type="radio" value="true"/>Yes
			<input name="school" type="radio" value="false"/>No
		</p>

		<p><b>Athlete: </b>
			<input name="athlete" type="radio" value="true"/>Yes
			<input name="athlete" type="radio" value="false"/>No
		</p>

		<p><b>Study Abroad: </b>
			<input name="study_abroad" type="radio" value="true"/>Yes
			<input name="study_abroad" type="radio" value="false"/>No
		</p>

		<p><b>Number of Tours: </b><input type="text" name = "num_tours"/></p>
	</div>

	<div id="availability">
		<h2 class = "section-header">Availability</h2>

		<p class="day"><b>Monday </b>
			<input name="monday[]" type="checkbox" value="930" />9:30
			<input name="monday[]" type="checkbox" value="1130" />11:30
			<input name="monday[]" type="checkbox" value="130"/>1:30
			<input name="monday[]" type="checkbox" value="330" />3:30
		</p>

		<p class="day"><b>Tuesday </b>
			<input name="tuesday[]" type="checkbox" value="930" />9:30
			<input name="tuesday[]" type="checkbox" value="1130" />11:30
			<input name="tuesday[]" type="checkbox" value="130" />1:30
			<input name="tuesday[]" type="checkbox" value="330" />3:30
		</p>

		<p class="day"><b>Wednesday </b>
			<input name="wednesday[]" type="checkbox" value="930"/>9:30
			<input name="wednesday[]" type="checkbox" value="1130"/>11:30
			<input name="wednesday[]" type="checkbox" value="130"/>1:30
			<input name="wednesday[]" type="checkbox" value="330"/>3:30
		</p>

		<p class="day"><b>Thursday </b>
			<input name="thursday[]" type="checkbox" value="930"/>9:30
			<input name="thursday[]" type="checkbox" value="1130"/>11:30
			<input name="thursday[]" type="checkbox" value="130"/>1:30
			<input name="thursday[]" type="checkbox" value="330"/>3:30
		</p>

		<p class="day"><b>Friday </b>
			<input name="friday[]" type="checkbox" value="930"/>9:30
			<input name="friday[]" type="checkbox" value="1130"/>11:30
			<input name="friday[]" type="checkbox" value="130"/>1:30
			<input name="friday[]" type="checkbox" value="330"/>3:30
		</p>
	</div>
	<div class = "clear"></div>
	<p style="text-align: center;"><input name="submit" type="submit" value="Submit" /></p>
	</form>

</div>
<hr />
</body>
</html>