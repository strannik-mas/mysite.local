<?php
	// Информация о пользователях
	class User extends AUser{
		static $users = 0; // Счетчик 
		protected $objNum = 0;
		function __construct($name="", $login="", $password="") {
			try{
				if(empty($name) or empty($login) or empty($password)) throw new Exception("Введены не все данные!");
				$this->name = $name;	
				$this->login = $login;	
				$this->password = $password;
				$this->objNum += ++self::$users;
			}catch(Exception $e){
				echo "Произошла ошибка ", $e->getMessage(),
					" в строке ", $e->getLine(),
					" файла ", $e->getFile();
				exit;	
			}
		}
		
		function showInfo() {
			echo "<p>Пользователь: ", $this->name;	
			echo "<br>Логин: ", $this->login;	
			echo "<br>Пароль: ", $this->password;	
		}
		
		function __clone() {
			$this->name = "Guest";	
			$this->login = "guest";	
			$this->password = "qwerty";
			self::$users++;
			$this->objNum++;
		}
		
		function __toString() {
			return "Объект #".$this->objNum.": ".$this->name;	
		}
	}
?>