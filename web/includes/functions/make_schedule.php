<?php
echo getcwd();
require_once('../database/DB.php');
echo "about to mysqli query";
if ($data = mysqli_query($connection, "SELECT * FROM guides")) {
	echo "mysqli queried";
	$path = '../../../output/outputguides.csv';
	$output = fopen("$path", 'w');
	echo "opened path";
	while ($row = mysqli_fetch_assoc($data)) {
		echo $row["Name"];
		echo $row["Major"];
		fputcsv($output, $row);
	}
	fclose($output);
	echo "about to execute program: ";
	chmod("../../../Debug/guide_scheduler.exe", 0755);
	echo substr(sprintf('%o', fileperms('../../../Debug/guide_scheduler')), -4);
	$return = shell_exec("../../../Debug/guide_scheduler $path");
	
	echo $return;
	return true;
} else {
	echo 'Data not properly queried. <br/>';
	return false;
}

?>