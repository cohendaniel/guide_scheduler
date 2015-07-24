<?php
	echo 'Including database.<br/>';
	$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
	
	$db_host = $url["host"];
	$db_user = $url["user"];
	$db_password = $url["pass"];
	$db = substr($url["path"], 1);
	
	$db_name = 'bowdoin-guides';
	
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