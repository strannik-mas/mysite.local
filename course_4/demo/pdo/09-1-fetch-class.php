<?php
//class Users{
class Vasya{
	public $id;
	public $email;
	public $name;

	public function nameToUpper(){
		return strtoupper($this->name);
	}
}


    $db = new PDO("sqlite:users.db");

	//$sql = "SELECT * FROM user";
	$sql = "SELECT name as c, name, email, id FROM user";
    $stmt = $db->query($sql);

    $obj = $stmt->fetch(PDO::FETCH_CLASS|PDO::FETCH_CLASSTYPE);
	var_dump($obj);
    echo $obj->id.'<br>';
	echo $obj->nameToUpper().'<br>';
	echo $obj->email.'<br>';
    
    $db = null;

?>