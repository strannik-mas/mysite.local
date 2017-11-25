<?php
$t = $news->_db->escapeString($_POST["title"]);
$c = $news->_db->escapeString($_POST["category"]);
$d = $news->_db->escapeString($_POST["description"]);
$s = $news->_db->escapeString($_POST["source"]);
if($t && $c && $d && $s){
    if ($news->saveNews($t, $c, $d, $s))
        header("Location: news.php");
    else
        $errMsg = "Произошла ошибка при добавлении новости!";
}else $errMsg = "Заполните все поля формы!";