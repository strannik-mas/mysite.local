<?php
	$curl = curl_init();
	$myurl = "http://".$_SERVER['HTTP_HOST']."/course_4/demo/curl/test.php";
	//var_dump($myurl);
	curl_setopt($curl, CURLOPT_URL, $myurl);
	curl_exec($curl);
	curl_close($curl);
?>