<?php

    $db = new PDO("sqlite:users-1.db");
    
	$db->exec("CREATE TABLE user(name, city, color)");
	
	//INSERT
	$count = $db->exec("INSERT INTO user VALUES ('John', 'London', 'red')");
	$count = $db->exec("INSERT INTO user VALUES ('John', 'London', 'green')");
	$count = $db->exec("INSERT INTO user VALUES ('John', 'Moscow', 'red')");
	$count = $db->exec("INSERT INTO user VALUES ('Mike', 'Moscow', 'red')");
	$count = $db->exec("INSERT INTO user VALUES ('Mike', 'Moscow', 'green')");
	$count = $db->exec("INSERT INTO user VALUES ('Mike', 'London', 'yellow')");
	$count = $db->exec("INSERT INTO user VALUES ('Ivan', 'London', 'yellow')");
	$count = $db->exec("INSERT INTO user VALUES ('Ivan', 'Moscow', 'yellow')");
	$count = $db->exec("INSERT INTO user VALUES ('Ivan', 'Moscow', 'red')");

/*	echo $count;


	//UPDATE
	$count = $db->exec("UPDATE user SET email='john@mail.ru' WHERE name='John'");

	echo $count;

*/
?>