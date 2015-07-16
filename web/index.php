<!DOCTYPE html>
<html>
<head>
	<title>Bowdoin College Tour Guide Schedule</title>
</head>
<body>
<p>Is this working?</p>
<?php

	echo "Hello everyone.";
	//include_once("home.html");
	require('includes/init.php');
	//require('../vendor/autoload.php');
	
	if (isset($_POST['submit'])) {
		
		$days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday');
		
		$avail = '';
		foreach($days as $day) {
			$times = '0000';
			if (isset($_POST[$day])) {
				$$day = $_POST[$day];
				if(in_array('930', $$day)) 
					$times[0] = 1;
				if(in_array('1130', $$day)) 
					$times[1] = 1;
				if(in_array('130', $$day)) 
					$times[2] = 1;
				if(in_array('330', $$day)) 
					$times[3] = 1;
				$avail = $avail . $times;
			} else {
				$avail = $avail . $times;
			}
		}
		
		if(submit($_POST['guidename'], $_POST['gender'], $_POST['class_year'], $_POST['major'], $_POST['state'], $_POST['ethnicity'], $_POST['school'], $_POST['athlete'], $_POST['study_abroad'], $_POST['num_tours'], $avail)) {
			echo 'Submitted! <br/>';
		} else {
			echo 'Failed to submit... <br/>';
		}
	}
	
	if (isset($_POST['run'])) {
		if (make_schedule()) {
			echo 'Made schedule! <br/>';
		} else {
			echo 'Failed to make schedule. <br/>';
		}
	}
?>

<h1 style="text-align: center;">Bowdoin College Tour Guide Availability</h1>

<form enctype="application/x-www-form-urlencoded" method="post" target="_self" action="index.php">
<p>Name: <input type="text" name = "guidename"/></p>

<p>Gender: <select name = "gender"><option value="male">Male</option><option value="female">Female</option></select></p>

<p>Class year: <select name = "class_year"><option value="2016">2016</option><option value="2017">2017</option><option value="2018">2018</option><option value="2019">2019</option></select></p>

<p>Major: <select name = "major"><option value="philosophy">Philosophy</option><option value="computer science">Computer Science</option><option  value="english">English</option></select></p>

<p>Home state: <select name = "state"><option value="alabama">Alabama</option><option value="idaho">Idaho</option><option value="oregon">Oregon</option></select></p>

<p>Ethnicity: <select name = "ethnicity"><option value="white">White</option><option value="black">Black or African American</option><option value="hispanic">Hispanic</option></select></p>

<p>Public School:</p>

<p><input name="school" type="radio" value="true"/>Yes<input name="school" type="radio" value="false"/>No</p>

<p>Athlete</p>

<p><input name="athlete" type="radio" value="true"/>Yes<input name="athlete" type="radio" value="false"/>No</p>

<p>Study Abroad</p>

<p><input name="study_abroad" type="radio" value="true"/>Yes<input name="study_abroad" type="radio" value="false"/>No</p>

<p>Number of Tours: <input type="text" name = "num_tours"/></p>

<hr />
<h2 style="text-align: center;">Availability</h2>

<h3>Monday</h3>

<p><input name="monday[]" type="checkbox" value="930" />9:30<input name="monday[]" type="checkbox" value="1130" />11:30<input name="monday[]" type="checkbox" value="130"/>1:30<input name="monday[]" type="checkbox" value="330" />3:30</p>

<h3>Tuesday</h3>

<p><input name="tuesday[]" type="checkbox" value="930" />9:30<input name="tuesday[]" type="checkbox" value="1130" />11:30<input name="tuesday[]" type="checkbox" value="130" />1:30<input name="tuesday[]" type="checkbox" value="330" />3:30</p>

<h3>Wednesday</h3>

<p><input name="wednesday[]" type="checkbox" value="930"/>9:30<input name="wednesday[]" type="checkbox" value="1130"/>11:30<input name="wednesday[]" type="checkbox" value="130"/>1:30<input name="wednesday[]" type="checkbox" value="330"/>3:30</p>

<h3>Thursday</h3>

<p><input name="thursday[]" type="checkbox" value="930"/>9:30<input name="thursday[]" type="checkbox" value="1130"/>11:30<input name="thursday[]" type="checkbox" value="130"/>1:30<input name="thursday[]" type="checkbox" value="330"/>3:30</p>

<h3>Friday</h3>

<p><input name="friday[]" type="checkbox" value="930"/>9:30<input name="friday[]" type="checkbox" value="1130"/>11:30<input name="friday[]" type="checkbox" value="130"/>1:30<input name="friday[]" type="checkbox" value="330"/>3:30</p>

<p style="text-align: center;"><input name="submit" type="submit" value="Submit" /></p>

<p style="text-align: center;"><input name="run" type="submit" value="Make Schedule" /></p>
</form>
</body>
</html>