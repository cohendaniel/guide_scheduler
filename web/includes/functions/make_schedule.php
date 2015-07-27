<?php
require_once('../database/DB.php');
if ($data = mysqli_query($connection, "SELECT * FROM guides")) {
	$path = './outputguides.csv';
	$output = fopen("$path", 'w');
	echo "opened path";
	while ($row = mysqli_fetch_assoc($data)) {
		//echo $row["Name"];
		//echo $row["Major"];
		fputcsv($output, $row);
	}
	fclose($output);
	chmod("./guide_scheduler", 0755);
	$return = shell_exec("./guide_scheduler $path");
	
	echo $return;
	return true;
} else {
	echo 'Data not properly queried. <br/>';
	return false;
}

?>