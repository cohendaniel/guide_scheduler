<?php
	echo 'Including database.<br/>';
	$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
	
	$db_host = $url["host"];
	$db_user = $url["user"];
	$db_password = $url["pass"];
	$db = substr($url["path"], 1);
	
	$db_name = 'guides';
	
	if($connection = new mysqli($db_host, $db_user, $db_password, $db)) {
		
		echo 'Connected to the database server. <br/>';
		
		if($databse = mysqli_select_db($connection, $db_name)) {
			echo 'Database has been selected. <br/>';
		} else {
			echo 'Database was not found. <br/>';
		}
	} else {
		echo 'Unable to connect to MySql server. <br/>';
	}
?>