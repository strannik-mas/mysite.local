<?php
	require "secure/session.inc.php";
	require "../inc/lib.inc.php";
	require "../inc/db.inc.php";
?>
<html>
<head>
	<title>Поступившие заказы</title>
</head>
<body>
<h1>Поступившие заказы:</h1>
<?php
	$orders = getOrders();
	//var_dump($orders);
	if(!is_array($orders)){
			echo 'Заказов нет! Вернитесь в '."<a href='index.php'>меню</a>";
			exit;
	}
	foreach ($orders as $order){	
		//var_dump($order);
		$i = 1; $sum=0;
?>
<hr>
<h2>Заказ номер: <?php echo $order['orderid']?></h2>
<p><b>Заказчик</b>: <?php echo $order['name']?></p>
<p><b>Email</b>: <?php echo $order['email']?></p>
<p><b>Телефон</b>: <?php echo $order['phone']?></p>
<p><b>Адрес доставки</b>: <?php echo $order['address']?></p>
<p><b>Дата размещения заказа</b>: <?php echo date("d-m-Y H:i", $order['date'])?></p>

<h3>Купленные товары:</h3>
<table border="1" cellpadding="5" cellspacing="0" width="90%">
<tr>
	<th>N п/п</th>
	<th>Название</th>
	<th>Автор</th>
	<th>Год издания</th>
	<th>Цена, руб.</th>
	<th>Количество</th>
</tr>
<?php
		foreach ($order['goods'] as $item){	
			//var_dump($item);
			
?>
<tr>
	<td><?php echo $i?></td>
	<td><?php echo $item['title']?></td>
	<td><?php echo $item['author']?></td>
	<td><?php echo $item['pubyear']?></td>
	<td><?php echo $item['price']?></td>
	<td><?php echo $item['quantity']?></td>
</tr>
<?php
			$i++;
			$sum += $item['price']*$item['quantity'];	
		}		
?>
</table>
<p>Всего товаров в заказе на сумму: <?php echo $sum?> руб.</p>
<?php
		
	}
?>
</body>
</html>