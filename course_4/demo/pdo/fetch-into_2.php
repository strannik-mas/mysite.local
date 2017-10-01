<?php
class Users{

	public $id;
	public $email;
	public $name;
	public function __construct(){
		$this->id='0';
		$this->name='ZOrro';
		$this->email='zorro@mail.ru';
	}
	public function nameToUpper(){
		return strtoupper($this->name);
	}
}


    $db = new PDO("sqlite:users.db");

	$sql = "SELECT * FROM user";

    $stmt = $db->query($sql);
    $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Users');
	$obj = $stmt->fetch();
	var_dump($obj);
	exit;
	foreach($stmt as $user){
        echo $user->nameToUpper().'<br>';
    }

	$db = null;
	/*
	$user = new Users();
	$stmt->setFetchMode(PDO::FETCH_INTO, $user);
	$stmt->execute();
	$user= $stmt->fetch(PDO::FETCH_INTO);
	*/
?>