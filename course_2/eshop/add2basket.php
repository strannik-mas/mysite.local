<?php
	// подключение библиотек
	require "inc/lib.inc.php";
	require "inc/db.inc.php";
	$id = clearInt($_GET['id']);
	//$q = clearInt($_GET['kol']);
	$q = 1;
	add2Basket($id, $q);
	header("Location: catalog.php");
	exit;
	
?>