<?php
	$visitCounter = 0;
	$lastVisit = '';
	if($_COOKIE["visitCounter"]){
		$visitCounter = $_COOKIE["visitCounter"];
	}
	$visitCounter++;
	if($_COOKIE["lastVisit"]){
		$lastVisit = date("Y-m-d h:i:s", $_COOKIE["lastVisit"]);
	}
	if($visitCounter>15){
		$visitCounter = 0;
		$lastVisit = '';
	}
	//кука создаётся раз в день
	//if(date('d-m-Y', $_COOKIE["lastVisit"]) != date('d-m-Y')){
		setcookie("visitCounter", $visitCounter);
		setcookie("lastVisit", time());
	//}
//закрывающий тэг пхп можно не писать чтобы не было проблем с передачей заголовков (вывод пустых строк)