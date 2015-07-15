<?php

function submit($name, $gender, $class_year, $major, $state, $ethnicity, $school, $athlete, $study_abroad, $num_tours, $avail) {
	
	echo $name, $gender, $class_year, $major, $state, $ethnicity, $school, $athlete, $study_abroad, $num_tours;
	
	// To avoid array to string conversion. TODO: make into loop for
	// cleanliness/readability. 
	
	// TODO: Make times into binary. 9:30, 3:30 -> 1001
	/*$monday = implode(",", $monday);
	$tuesday = implode(",", $tuesday);
	$wednesday = implode(",", $wednesday);
	$thursday = implode(",", $thursday);
	$friday = implode(",", $friday);*/
	
	if(!empty($name) && !empty($gender) && !empty($class_year) && !empty($major) && !empty($state) && !empty($ethnicity) && !empty($school) && !empty($athlete) && !empty($study_abroad) && !empty($num_tours)) {
		$name = mysql_real_escape_string($name);
		$gender = mysql_real_escape_string($gender);
		$state = mysql_real_escape_string($state);
		$major = mysql_real_escape_string($major);
		$ethnicity = mysql_real_escape_string($ethnicity);
		
		$query = "INSERT INTO guides VALUES ('$name', '$gender', '$class_year', '$major', '$state', '$ethnicity', '$school', '$athlete', '$study_abroad', '$num_tours', '$avail')"; 

		if ($run = mysql_query($query)) {
			echo "Query accepted.<br/>";
			return true;
		} else {
			echo "Query not accepted.<br/>";
			return false;
		}
	} else {
		echo "Something not filled out.<br/>";
		return false;
	}
}

?>