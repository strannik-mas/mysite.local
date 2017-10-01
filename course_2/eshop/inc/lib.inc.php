<?php
	function clearInt($data){
		return abs((int)$data);
	}
	function clearStr($data){
		//импорт глобального линка
		global $link;
		return mysqli_real_escape_string($link, trim(strip_tags($data)));
	}
	function result2Array($data){
		global $basket;
		$arr = array();
		while($row = mysqli_fetch_assoc($data)){
			//var_dump($row);
			$row['quantity'] = $basket[$row['id']];
			$arr[] = $row;
		}
		return $arr;
	}
	function addItemToCatalog($title, $author, $pubyear, $price){
		global $link;
		$sql = 'INSERT INTO catalog (title, author, pubyear, price)
				VALUES (?, ?, ?, ?)';
		if (!$stmt = mysqli_prepare($link, $sql))
			return false;
		mysqli_stmt_bind_param($stmt, 'ssii', $title, $author, $pubyear, $price);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		return true;
	}
	function selectAllItems(){
		global $link;
		$sql = 'SELECT id, title, author, pubyear, price FROM catalog';
		if(!$result=mysqli_query($link, $sql))
			return false;
		$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		return $items;
	}
	function saveBasket(){
		global $basket;
		//var_dump($basket);
		$basket = base64_encode(serialize($basket));//для того, чтобы небыло битых строк из-за апострофов в полях
		setcookie('basket', $basket, 0x7fffffff);
	}
	function basketInit(){
		global $basket, $count;
		if(!isset($_COOKIE['basket'])){
			$basket = array('orderid' => uniqid());
			saveBasket();
		}else{
			$basket = unserialize(base64_decode($_COOKIE['basket']));
			$count = count($basket)-1;//из-за orderid - это первый элемент
		}		
	}
	function add2Basket($id, $q){
	//q-количество товара
		global $basket;
		$basket[$id] = $q; //присваивается количество товара
		saveBasket();
	}
	function myBasket(){
		global $basket, $link;
		var_dump($basket);
		$goods = array_keys($basket);
		array_shift($goods);
		if (!$goods)
			return array();
		//var_dump(count($goods));
		//if(count($goods))
			//$ids = implode(',', $goods);
		//else $ids = 0;для корректного отображения удалённой корзины
		//var_dump($ids);
		$ids = implode(',', $goods);
		$sql = "SELECT id, author, title, pubyear, price
				FROM catalog
				WHERE id IN ($ids)";
		if(!$result = mysqli_query($link, $sql))
			return false;
		$items = result2Array($result);
		mysqli_free_result($result);
		return $items;
	}
	function deleteItemFromBasket($id){
		global $basket;
		unset($basket["$id"]);
		saveBasket();
	}
	function saveOrder($datetime){
		global $link, $basket;
		$goods = myBasket();
		//var_dump($basket);
		//$stmt = mysqli_stmt_init($link);
		$sql = 'INSERT INTO orders (title, author, pubyear, price, quantity, orderid, datetime) 
				VALUES (?, ?, ?, ?, ?, ?, ?)';
		if (!$stmt = mysqli_prepare($link, $sql))
			return false;
		foreach ($goods as $item){
			mysqli_stmt_bind_param($stmt, 'ssiiisi', $item['title'], $item['author'], $item['pubyear'], $item['price'], $item['quantity'], $basket['orderid'], $datetime);
			mysqli_stmt_execute($stmt);
		}  
		mysqli_stmt_close($stmt);
		setcookie('basket', '', time() - 3600);
		return true;
	}
	function getOrders(){
		global $link;
		if (!is_file(ORDERS_LOG))
			return false;
		//данные пользователей из файла в виде массива
		$orders = file(ORDERS_LOG);
		$allorders = array();
		//var_dump($orders);
		foreach($orders as $order){
			list($name, $email, $phone, $address, $orderid, $date) = explode("|", $order);
			$orderinfo = array();
			$orderinfo['name'] = $name;
			$orderinfo['email'] = $email;
			$orderinfo['phone'] = $phone;
			$orderinfo['address'] = $address;
			$orderinfo['orderid'] = $orderid;
			$orderinfo['date'] = $date;
			//SQL запрос на выбор товаров из таблицы orders для конкретного покупателя
			$sql = "SELECT title, author, pubyear, price, quantity 
					FROM orders 
					WHERE orderid = '$orderid' AND datetime=$date";
			if(!$result=mysqli_query($link, $sql))
				return false;
			$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
			//var_dump($items);
			mysqli_free_result($result);
			//сохраняем результат в промежуточный массив
			$orderinfo["goods"]=$items;
			$allorders[] = $orderinfo;
		}
		return $allorders;
	}