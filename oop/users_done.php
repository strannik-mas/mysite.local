<?php
	// Функция автоматической подгрузки классов
	function __autoload($class){
		require_once "$class.class.php";
	}
	
	// Пользователь 1
	$user1 = new User("Rasmus Lerdorf", "rasmus", "sDe3G45"); 
	$user1->showInfo();
	
	// Пользователь 2
	$user2 = new User("Zeev Suraski", "zeev", "sdsBH67"); 
	$user2->showInfo();
		
	// Пользователь 3
	$user3 = new User("Andi Gutmans", "andi", "porRFkj66"); 
	$user3->showInfo();	
	
	// Пользователь 4
	$user4 = clone $user3;
	$user4->showInfo(); 
	
	// Суперпользователь 
	$user = new SuperUser("Igor Borisov", "igor", "sdfrtRc34", "admin");
	$user->showInfo();
	echo "<hr><p>";
	$props = $user->getInfo();
	//print_r($props);
	foreach($props as $prop=>$value){
		echo "$prop = $value<br>";
	}
	// Функция проверки типа пользователя
	function checkUser($obj){
		if ($obj instanceof User) {
			if ($obj instanceof SuperUser) {
				echo "<p>", $obj->name,
				        " - cуперпользователь</p>";	
			} else {
				echo "<p>", $obj->name,
				        " - обычный пользователь</p>";
			}
		}else{
			echo '<p>$obj - неизвестный пользователь</p>';
		}
	}
	
	// Проверка типа пользователя	
	checkUser($user2);
	checkUser($user);
	
	// Количество обычных пользователей
	echo "<p>Количество обычных пользователей - ",
	        User::$users;
	// Количество суперпользователей		
	echo "<p>Количество суперпользователей - ",
	        SuperUser::$superusers;
	echo "<hr>", $user1;
	echo "<hr>", $user2;
	echo "<hr>", $user3;
	echo "<hr>", $user4;
	echo "<hr>", $user;
?>