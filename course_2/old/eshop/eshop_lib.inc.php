<?php
	// Функция save (сохранить в базу новый товар)
	function save($author, $title, $pubyear, $price) {
		$sql = "INSERT INTO catalog(
						author,
						title,
						pubyear,
						price
					) VALUES(
						'$author',
						'$title',
						$pubyear,
						$price					
					)";
		mysql_query($sql) or die(mysql_error());
	}
	
	// Вывод всего из каталога
	function selectAll() {
		$sql = "SELECT * FROM catalog";
		$result = mysql_query($sql) or die(mysql_error());
		return $result;
	}
	
	// Добавление товаров в корзину
	function add2basket($customer, $goodsid, $quantity, $datetime) {
		$sql = "INSERT INTO basket(
					customer,
					goodsid,
					quantity,
					datetime
				) VALUES(
					'$customer',
					$goodsid,
					$quantity,
					$datetime				
				)";
		$result = mysql_query($sql) or die(mysql_error());
	}
	
	// Вывод корзины пользователя
	function myBasket() {
		$sql = "SELECT * FROM catalog, basket 
			WHERE customer='".session_id()."' 
			and catalog.id=basket.goodsid";
		$result = mysql_query($sql) or die(mysql_error());
		return $result;
	}
	
	// Удаление товара из корзины
	function basketDel($id){
		$sql = "DELETE FROM basket WHERE id = $id";
		$result = mysql_query($sql) or die(mysql_error());
	}
	
	// Пересохранение товаров из корзины в заказы
	function resave($datetime) {
		$goods = myBasket();
		while ($good = mysql_fetch_assoc($goods)) {
			$sql = "INSERT INTO orders(
						author,
						title,
						pubyear,
						price,
						customer,
						quantity,
						datetime
					) VALUES(
						'" . $good["author"] . "',
						'" . $good["title"] . "',
						" . $good["pubyear"] . ",
						" . $good["price"] . ",
						'" . $good["customer"] . "',
						" . $good["quantity"] . ", $datetime)";
				mysql_query($sql) or die(mysql_error());
				
		}
		// Удаление данных из таблицы basket
		$sql = "DELETE FROM basket WHERE customer='" . session_id() . "'";	
		mysql_query($sql) or die(mysql_error());
	}
	
	// Получение информации о заказах
	function getOrders() {
		// Получение заказчиков из log-файла 
		$orders = file(ORDERS_LOG);
		
		$allorders = array();
		
		foreach ($orders as $order) {
			list($name, $email, $phone, $address, $customer, $date) = explode("|", $order);
			
			$orderinfo = array();
			
			$orderinfo["name"] = $name;	
			$orderinfo["email"] = $email;	
			$orderinfo["phone"] = $phone;	
			$orderinfo["address"] = $address;	
			$orderinfo["customer"] = $customer;	
			$orderinfo["date"] = $date;	
			// Товары из заказов:
			$sql = "SELECT * FROM orders 
				WHERE customer='".$orderinfo["customer"]."' AND datetime=".$orderinfo["date"];
			$result = mysql_query($sql) or die(mysql_error());
			$orderinfo["goods"] = $result;
			$allorders[] = $orderinfo;
		}
		return $allorders;
	}

?>