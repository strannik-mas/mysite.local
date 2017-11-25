<?
class User{
	public $name;
	public $login;
	public $password;
	public static $countUser = 0;
	
	public function __construct($n,$l,$p){
		$this->name = $n;
		$this->login = $l;
		$this->password = $p;
		++self::$countUser;
	}
	
	function __clone(){
		++self::$countUser;
	}
	
	public function __destruct(){
		echo '</p>Polzovatel ', $this->login, " has been deleted!</p>\n";
	}
	
	public function showInfo(){
		echo "<p>Пользователь $this->name<br>\nLogin: $this->login<br>\nPass: $this->password</p>\n";
	}
	
	
}