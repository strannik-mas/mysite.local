<?php
class User{
	private $_name;
	function __construct($n){
		$this->_name = $n;
		
	}
	function sayHello($word){
		return function() use($word){
			echo "$word {$this->_name}!</br>";//не прокатывает this из вызова $pr_1();
		};
	}
}
//{$this->_name}
$user = new User('Kuk');
$pr_1 = $user->sayHello('Hello'); //сюда приходит объект класса Closure, не строка
//$user->sayHello("Привет");
echo $pr_1();





$add = function($x){
	return $x + 2;
};
echo $add(2).'</br>'; //4
echo $add(3).'</br>'; //5
//создаём замыкание
$add = function($num){
	return function($x) use ($num){
		return $x + $num;
	};
};
$add_2 = $add(2); //function($x){return $x + 2;};
//var_dump($add_2);
$add_3 = $add(3); //function($x){return $x + 3;};
echo $add_2(5).'</br>'; //7
/*
$str = 'Hello';
$closure = function() use (&$str) {
	echo $str;
};
$str = 'bye';//если без & то в $closure будет передано фактически echo 'Hello'
$closure();


//3 варианта использования array_map
$arr = array(1, 2, 3, 4, 5);
function foo($v){
	return $v*10;
}
$newArr = array_map('foo', $arr);


$newArr = array_map(create_function('$v', 'return $v*10;'), $arr);


$newArr = array_map(function($v){return $v*10;}, $arr);


function Hello($name){
	echo "Hello, $name!";
}
$func = "Hello";
$func('John');

//тоже самое
$func = function($name){
	echo "Hello, $name!";
}; //тут обязательно ; т.к. это не декларация функции, это выражение, такое же как 2+2
$func('John'); // тут лежит объект класса Closure
*/
?>