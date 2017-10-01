<?php
	// запуск сессии
	session_start();
	// подключение библиотек
	require "eshop_db.inc.php";
	require "eshop_lib.inc.php";
	
	// ID удаляемого товара
	$id = $_GET['id'];
	

	// Удаление товара из корзины
	basketDel($id);
	
	header('Location: basket.php');
?>