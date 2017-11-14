<?php
error_reporting(E_ALL);
class User{
	public $name;
	public $login;
	public $password;
	
	public function __construct($n,$l,$p){
		$this->name = $n;
		$this->login = $l;
		$this->password = $p;
	}
	
	public function __destruct(){
		echo '</p>Polzovatel ', $this->login, " has been deleted!</p>\n";
	}
	
	public function showInfo(){
		echo "<p>Пользователь $this->name<br>\nLogin: $this->login<br>\nPass: $this->password</p>\n";
	}
	
	
}

class SuperUser extends User{
    public $role;
    
    public function __construct($n,$l,$p,$r){
        parent::__construct($n,$l,$p);
        $this->role = $r;
    }
    
    public function showInfo(){
        parent::showInfo();
        echo "<b>Доступ: $this->role</b><br>\n";
    }
}


$user1 = new User('vasya', 'admin', 'admin');
$user2 = new User('petya', 'pet', '1234');
$user3 = new User('sasha', 'ya', 'qwerty');
$user1->showInfo();
$user2->showInfo();
$user3->showInfo();

$user = new SuperUser('alex', 'sadmin', 'mas', 'admin');
$user->showInfo();