<!-- Основные настройки -->
<?php
define("DB_HOST", "localhost");
define("DB_LOGIN", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "gbook");
$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);
function clearStr($data){
	global $link;
	return mysqli_real_escape_string($link, trim(strip_tags($data)));
}
?>
<!-- Основные настройки -->

<!-- Сохранение записи в БД -->
<?php
// Проверяем, была ли корректным образом отправлена форма
if($_SERVER['REQUEST_METHOD']=='POST'){
	// Фильтруем полученные данные
	$name = clearStr($_POST['name']);
	$email = clearStr($_POST['email']);
	$msg = clearStr($_POST['msg']); 
	// Формируем SQL-оператор на вставку данных и выполняем его
	$sql = "INSERT INTO msgs (name, email, msg) 
				VALUES ('$name', '$email', '$msg')";
	mysqli_query($link, $sql) or die (mysqli_error($link));
	
	header('Location: ' . $_SERVER['REQUEST_URI']);
	exit;
}
?>
<!-- Сохранение записи в БД -->

<!-- Удаление записи из БД -->
<?php
	$del = $_GET['del'];
	if(is_numeric($del)){
		$sql = "DELETE FROM msgs WHERE id=$del";
		mysqli_query($link, $sql) or die (mysqli_error($link));
		header('Location: ' . $_SERVER['SCRIPT_NAME'].'?id=gbook');
		exit;
	}
?>
<!-- Удаление записи из БД -->

<h3>Оставьте запись в нашей Гостевой книге</h3>

<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
Имя: <br /><input type="text" name="name" /><br />
Email: <br /><input type="text" name="email" /><br />
Сообщение: <br /><textarea name="msg"></textarea><br />

<br />

<input type="submit" value="Отправить!" />

</form>
<!-- Вывод записей из БД -->
<?php
	$sql = "SELECT id, name, email, msg, UNIX_TIMESTAMP(datetime) as dt FROM msgs ORDER BY id DESC LIMIT 5";
	$res = mysqli_query($link, $sql) or die (mysqli_error($link));
	/* while($row = mysqli_fetch_assoc($res))
		var_dump($row); */
	mysqli_close($link);
	$count = mysqli_num_rows($res);
	echo "<p>Всего записей в гостевой книге: ".$count;
	while ($row = mysqli_fetch_assoc($res)){
		$id = $row['id'];
		$name = $row['name'];
		$email = $row['email'];
		$msg = nl2br($row['msg']);
		$dt1 = date("d-m-Y",$row["dt"]*1);
		$dt2 = date("H:i",$row["dt"]*1);
		//var_dump($row["datetime"]);
		echo <<<LABEL
		<hr>
		<p>
			<h3><a href="mailto:$email">$name</a></h3><span> $dt1 в $dt2 написал</span>
				<br>
				<i>$msg</i>
		</p>
		<p align="right">
			<a href="{$_SERVER['REQUEST_URI']}&del=$id">Удалить</a>
		</p>
LABEL;
	}
?>
<!-- Вывод записей из БД -->
