<?php
	define("DB_HOST", "localhost");
	define("DB_LOGIN", "root");
	define("DB_PASSWORD", "password");
	define("DB_NAME", "eshop");
	define("ORDERS_LOG", "orders.log");
	$count = 0;
	
	$conn = mysql_connect(DB_HOST, DB_LOGIN, DB_PASSWORD) or die("Ошибка соединения с сервером баз данных");
	
	mysql_select_db(DB_NAME) or die(mysql_error());
	
	// Определение количества товаров в корзине пользователя
	$sql = "SELECT count(*) FROM basket WHERE customer='".session_id()."'";
	$result = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_row($result);
	$count = $row[0];
?>