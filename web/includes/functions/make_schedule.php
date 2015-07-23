<?php
require('C:\Users\Dan\Desktop\Projects\guide_scheduler\web\includes\database\DB.php');

if ($data = mysql_query("SELECT * FROM guides")) {
	$path = 'C:/Users/Dan/Desktop/Projects/guide_scheduler/output/outputguides.csv';
	$output = fopen("$path", 'w');
	while ($row = mysql_fetch_assoc($data)) {
		//echo $row["Name"];
		//echo $row["Major"];
		fputcsv($output, $row);
	}
	fclose($output);
	$return = shell_exec("C:\Users\Dan\Desktop\Projects\guide_scheduler\Debug\guide_scheduler.exe $path");
	
	echo $return;
	return true;
} else {
	echo 'Data not properly queried. <br/>';
	return false;
}

?>