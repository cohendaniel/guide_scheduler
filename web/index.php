<?php

	echo "Hello everyone.";
	echo getcwd();
	include('home.html');
	require('./includes/init.php');
	require('../vendor/autoload.php');
	echo "started from the bottom now we here";
	
	if (isset($_POST['enter_info'])) {
		echo "PRESSED!";
		header('Location: ./info.html');
	}
	
	if (isset($_POST['submit'])) {
		echo "<h2>Submit pressed</h2>";
		
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
	
	if (isset($_POST['admin'])) {
		if (empty($_POST['username'])) {
			echo 'Username field not filled out.';
		}
		elseif (empty($_POST['password'])) {
			echo 'Password field not filled out.';
		}
		elseif ($_POST['username'] == 'admissions' && $_POST['password'] == 'abc123') {
			header('Location: admin.html');
		}
		else {
			echo 'Invalid login. <br/>';
		}
	}
	
?>