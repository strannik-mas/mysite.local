<?php
$id = abs((int)($_GET['id']));
if(is_numeric($id)){
    if(!$news->deleteNews($id))
        $errMsg = "Произошла ошибка при удалении новости.";
    else header("Location: news.php");
}