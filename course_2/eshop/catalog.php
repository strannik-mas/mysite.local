<?php
	// подключение библиотек
	require "inc/lib.inc.php";
	require "inc/db.inc.php";
?>
<html>
<head>
	<title>Каталог товаров</title>
	<script type="text/javascript">
	
	</script>
</head>
<body>
<p>Товаров в <a href="basket.php">корзине</a>: <?php echo $count?></p>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
<tr>
	<th>Название</th>
	<th>Автор</th>
	<th>Год издания</th>
	<th>Цена, руб.</th>
	<th>В корзину</th>
	<!--<th>Количество</th>-->
</tr>
<?php
	$goods = selectAllItems();
	//var_dump($goods);
	if(!is_array($goods)){
		echo 'Произошла ошибка при выводе товаров';
		exit;
	}
	if (!$goods){
		echo 'На сегодня товаров нету!';
		exit;
	}
	foreach($goods as $item){
?>
		<tr>
			<td><?php echo $item['title']?></td>
			<td><?php echo $item['author']?></td>
			<td><?php echo $item['pubyear']?></td>
			<td><?php echo $item['price']?></td>
			<td><a href="add2basket.php?id=<?php echo $item['id']?>">В корзину</a></td>
			<!--<td><input name="kolichestvo" type="number" formmethod="get" min="1" step="1" required="required" value="1" /></td>-->
		</tr>
<?php
	}
?>
</table>
</body>
</html>