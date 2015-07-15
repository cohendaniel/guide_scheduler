<?php

function make_schedule() {
	if ($data = mysql_query("SELECT * FROM guides")) {
		$output = fopen('outputguides.csv', 'w');
		while ($row = mysql_fetch_assoc($data)) {
			//echo $row["Name"];
			//echo $row["Major"];
			fputcsv($output, $row);
		}
		fclose($output);
		$return = exec("C:\Users\Dan\Desktop\Projects\guide_scheduler\Debug\guide_scheduler.exe outputguides.csv");
		
		echo $return;
		return true;
	} else {
		echo 'Data not properly queried. <br/>';
		return false;
	}
}

?>