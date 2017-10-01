<?php
	$lines = array();
	if (file_exists("log/".PATH_LOG)){
		$handle = fopen("log/".PATH_LOG, "r") or die("Не могу открыть файл");
		while($myLine = fgets($handle)){
			$lines[] = explode("|", $myLine);
		} 
		echo '<ol>';
		foreach ($lines as $line){
			echo '<li>';
			echo date("d-m-Y H:i:s", $line[0]), " - $line[2] -> $line[1]";
			echo "</li>";
		}
		echo '</ol>';
		//var_dump($lines);
		fclose($handle);
	}
