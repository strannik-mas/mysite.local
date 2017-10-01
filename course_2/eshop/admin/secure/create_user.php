<?php
require_once "session.inc.php";
require_once "secure.inc.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Хеширование SHA-1</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>

<body>
<h1>Хеширование SHA-1</h1>
<?php
$user = 'root';
$string = '1234';
$salt = '';
$iterationCount = 100;
$result = '';

if (!$salt)
	$salt = str_replace('=', '', base64_encode(md5(microtime() . '1FD37EAA5ED9425683326EA68DCD0E59')));

if ($_SERVER['REQUEST_METHOD']=='POST'){
	$user = $_POST['user'] ?: $user;
	if(!userExists($user)){
		$string = $_POST['string'] ?: $string;
		$salt = $_POST['salt'] ?: $salt;
		$iterationCount = (int) $_POST['n'] ?: $iterationCount;
		$resHash = getHash($string, $salt, $iterationCount);
		$result = 'Хеш '. $resHash. ' успешно добавлен в файл';
		if(saveHash($user, $resHash, $salt, $iterationCount))
			$result = 'Хеш '. $resHash. ' успешно добавлен в файл';
		else
			$result = 'При записи хеша '. $resHash. ' произошла ошибка';
	}else{
		$result = "Пользователь $user уже существует. Выберите другое имя.";
	}
}
?>
<h3><?php echo $result?></h3>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
	<div>
		<label for="txtUser">Логин</label>
		<input id="txtUser" type="text" name="user" value="<?php echo $user?>" style="width:40em"/>
	</div>
	<div>
		<label for="txtString">Пароль</label>
		<input id="txtString" type="text" name="string" value="<?php echo $string?>" style="width:40em"/>
	</div>
	<div>
		<label for="txtSalt">Соль</label>
		<input id="txtSalt" type="text" name="salt" value="<?php echo $salt?>"  style="width:40em"/>
	</div>	
	<div>
		<label for="txtIterationCount">Число иттераций</label>
		<input id="txtIterationCount" type="text" name="n" value="<?php echo $iterationCount?>"  style="width:4em"/>
	</div>		
	<div>
		<button type="submit">Создать</button>
	</div>	
</form>
</body>
</html>