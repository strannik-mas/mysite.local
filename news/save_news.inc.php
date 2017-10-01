<?php
	$title = $news->clearData($_POST["title"]);
	$category = $news->clearInt($_POST["category"]);
	$description = $news->clearData($_POST["description"]);
	$source = $news->clearData($_POST["source"]);
	if (!empty($title) and !empty($description) and !empty($source)){
		$result = $news->saveNews($title, $category, $description, $source);
		if (!$result) $errMsg = "Произошла ошибка при добавлении новости";
		else header("Location: news.php");
	}else $errMsg = "Заполните все поля формы!";
?>