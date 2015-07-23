<?php
	echo 'Including database.<br/>';
	$db_host = 'localhost';
	$db_user = 'root';
	$db_password = '';
	
	$db_name = 'guides';
	
	if($connection = mysql_connect($db_host, $db_user, $db_password)) {
		
		echo 'Connected to the database server. <br/>';
		
		if($databse = mysql_select_db($db_name, $connection)) {
			echo 'Database has been selected. <br/>';
		} else {
			echo 'Database was not found. <br/>';
		}
	} else {
		echo 'Unable to connect to MySql server. <br/>';
	}
?>