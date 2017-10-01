<?php
	$getN = $news->getNews();
	if (is_array($getN)){
		echo "<p>Всего новостей: ".count($getN);
		foreach($getN as $n){
		$id = $n['id'];
		$title = $n['title'];
		$cat = $n['category'];
		$des = nl2br($n['description']);
		$source = $n["source"];
		$dt = date("d-m-Y H:i:s",$n["datetime"]*1);
		echo <<<LABEL
		<hr>
		<p>
			<h3><a href="$source">$title</a></h3><br> from[$cat] @ $dt
				<br>$des
		</p>
		<p align="right">
			<a href="news.php?del=$id">Удалить</a>
		</p>
LABEL;
	}
	} else $errMsg = "Произошла ошибка при выводе новостной ленты";
?>