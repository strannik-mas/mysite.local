<?php
	require "inc/lib.inc.php";
	require "inc/db.inc.php";
	$n = clearStr($_POST['name']);
	$e = clearStr($_POST['email']);
	$p = clearStr($_POST['phone']);
	$a = clearStr($_POST['address']);
	$dt = time();
	global $basket;
	//var_dump($basket);
	//var_dump($dt);
	$arr = array($n, $e, $p, $a, $basket['orderid'], $dt);
	$order = implode("|", $arr);
	//var_dump($order);
	if(!file_put_contents('admin/'.ORDERS_LOG, $order."\n", FILE_APPEND))
		echo "Произошла ошибка записи в файл!";
	saveOrder($dt);
?>
<html>
<head>
	<title>Сохранение данных заказа</title>
</head>
<body>
	<p>Ваш заказ принят.</p>
	<p><a href="catalog.php">Вернуться в каталог товаров</a></p>
</body>
</html>