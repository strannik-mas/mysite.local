<?php
	// Информация о пользователях
	abstract class AUser {
		public $name; // Имя пользователя
		public $login; // Логин
		public $password; // Пароль
		
		function __construct($name="", $login="", $password="") {
			$this->name = $name;	
			$this->login = $login;	
			$this->password = $password;
		}
		
		abstract function showInfo();
	}
?>