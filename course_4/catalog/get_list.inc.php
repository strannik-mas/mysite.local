<?php
$catalog = new DVD();
$id = abs((int)$_GET['id']);
$band = trim(strip_tags($_GET['band']));
$title = trim(strip_tags($_GET['title']));
//var_dump($title);
$result = $catalog->showAlbum($id);
if(!is_array($result)){
	$errMsg = $result;
}else{
	echo "<p>Всего треков: ".count($result)."</p>";
?>
	<form action="catalog.php" method="post">
	<input type="hidden" name="action" value="list"/>
	<table border="1" width="100%">
	<tr align="center"><th>Исполнитель: <?php echo $band?>. Альбом: <?php echo $title?></th></tr>
	<tr>
		<th>Трек</th>
	</tr>
<?php	
	foreach($result as $item){
		$id = $item['id'];
		$track = $item['title'];
		echo <<<LABEL
		<tr>
			<td>$track</td>
		</tr>
LABEL;
	}
?>
	<tr align="center">
		<td colspan="4">
			<input type="hidden" name="band" value="<?php echo $band?>">
			<input type="hidden" name="title" value="<?php echo $title?>">
			<input type="hidden" name="id" value="<?php echo $id?>">
			<input type="checkbox" name="format" value="1">как JSON
			<input type="submit" value="Распечатать">
		</td>
	</tr>
	</table>
	</form>
<?php	
}
?>