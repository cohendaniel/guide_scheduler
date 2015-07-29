<?php
require_once('../database/DB.php');
if ($data = mysqli_query($connection, "SELECT * FROM guides")) {
	$path = './outputguides.csv';
	$output = fopen("$path", 'w');
	while ($row = mysqli_fetch_assoc($data)) {
		//echo $row["Name"];
		//echo $row["Major"];
		fputcsv($output, $row);
	}
	fclose($output);
	//chmod("./guide_scheduler_windows.exe", 0755);
	//echo "changed permissions";
	
	$return = shell_exec("./guide_scheduler $path");
	
	//local Windows access
	//$return = shell_exec("..\..\..\Debug\guide_scheduler.exe $path");
	
	echo $return;
	return true;
} else {
	echo 'Data not properly queried. <br/>';
	return false;
}

?>