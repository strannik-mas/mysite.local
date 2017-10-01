<?php
	$result = '';
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$to = 'mas_m@ukr.net';
		$subj = trim(strip_tags($_POST['subject']));
		$body = trim(strip_tags($_POST['body']));
		$headers = 'From: webmaster@example.com' . "\r\n" .
					'Reply-To: webmaster@example.com' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();

		if (mail($to, $subj, $body, $headers))
			$result = 'Письмо передано серверу';
		else
			$result = 'Произошла ошибка при отправке письма!';
	}
?>
<h3>Адрес</h3>
<p>123456 Москва, Малый Американский переулок 21</p>
<h3>Задайте вопрос</h3>
<p><?php echo $result?></p>
<form action='<?php echo $_SERVER['REQUEST_URI']?>' method='post'>
	<label>Тема письма: </label><br />
	<input name='subject' type='text' size="50"/><br />
	<label>Содержание: </label><br />
	<textarea name='body' cols="50" rows="10"></textarea><br /><br />
	<input type='submit' value='Отправить' />
</form>	
