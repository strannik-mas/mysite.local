<?php
	$dt = time();
	$page = $_SERVER['REQUEST_URI'];
	$ref = $_SERVER['HTTP_REFERER'];
	//$ref = pathinfo($ref, PATHINFO_BASENAME);
	
	$path = $dt."|".$page."|".$ref."\n";
	$handle = fopen("log/".PATH_LOG, "a+") or die("Не могу открыть файл");
	fwrite($handle, $path);
	fclose($handle);
	