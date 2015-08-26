<?php
//echo 'Including submit function.<br/>';

//echo $db_name;
function submit($name, $gender, $class_year, $major, $state, $ethnicity, $school, $athlete, $study_abroad, $num_tours, $avail, $saturday) {
	//require_once('./includes/database/DB.php');
	//local windows access -- use below instead
	require_once('./includes/database/DB_local.php');
	echo $name, $gender, $class_year, $major, $state, $ethnicity, $school, $athlete, $study_abroad, $num_tours;
	
	if(!empty($name) && !empty($gender) && !empty($class_year) && !empty($major) && !empty($state) && !empty($ethnicity) && !empty($school) && !empty($athlete) && !empty($study_abroad) && !empty($num_tours)) {
		$name = mysqli_real_escape_string($connection, $name);
		$gender = mysqli_real_escape_string($connection, $gender);
		$state = mysqli_real_escape_string($connection, $state);
		$major = mysqli_real_escape_string($connection, $major);
		$ethnicity = mysqli_real_escape_string($connection, $ethnicity);

		$saturday_str = implode(", ", $saturday);
		$query = "INSERT INTO guides VALUES (NULL, '$name', '$gender', '$class_year', '$major', '$state', '$ethnicity', '$school', '$athlete', '$study_abroad', '$num_tours', '$avail', '$saturday_str')"; 

		if ($run = mysqli_query($connection, $query)) {
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