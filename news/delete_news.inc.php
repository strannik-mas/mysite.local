<?php
	$id = $news->clearInt($_GET["del"]);
	if($id){
		$r = $news->deleteNews($id);
		if (!$r) $errMsg = "Произошла ошибка при удалении сообщения";
		else header("Location: news.php");
		exit;
	}else $errMsg = "Хакер, не ломай мою новостную ленту!";
?>