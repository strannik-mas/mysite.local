<?php
error_reporting(E_ALL);
function __autoload($name){
	include "$name.class.php";
}

$user1 = new User('vasya', 'admin', 'admin');
$user2 = new User('petya', 'pet', '1234');
$user3 = new User('sasha', 'ya', 'qwerty');
$u3 = clone $user1;
$user1->showInfo();
$user2->showInfo();
$user3->showInfo();

$user = new SuperUser('alex', 'sadmin', 'mas', 'admin');
$u2 = new SuperUser('sasha', 'superadmin', 'mas', 'admin');
$user->showInfo();


echo "Всего обычных пользователей: ", User::$countUser, '<br>';
echo "Всего супер пользователей: ", SuperUser::$countSuperUser, '<br>';