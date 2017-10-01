<?php
	// подключение библиотек
	require "secure/session.inc.php";
	require "../inc/lib.inc.php";
	require "../inc/db.inc.php";
	$t = clearStr($_POST['title']);
	$a = $_POST['author'];//тут почему-то экранируются апострофы
	$y = clearInt($_POST['pubyear']);
	$p = clearInt($_POST['price']);
	if(!addItemToCatalog($t, $a, $y, $p)){
		echo 'Произошла ошибка при добавлении товара в каталог';
	}else{
		header("Location: add2cat.php");
		exit;
	}
?>