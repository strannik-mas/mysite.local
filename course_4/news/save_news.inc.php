<?php
if(empty($_POST['title']) or empty($_POST['description'])){
	$errMsg = 'FIELDS are empty!</br>';
	header('news.php');
}else{
	$title = $news->clearData($_POST['title']);
	$desc = $news->clearData($_POST['description']);
	$source = $news->clearData($_POST['source']);
	$category = $_POST['category'];
	$ret = $news->saveNews($title, $category, $desc, $source);
}
if(!$ret){
	$errMsg .= 'Save error!';
}else{
	header('news.php');
}

?>