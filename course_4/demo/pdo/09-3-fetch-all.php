<?php
class Users{

	public $id;
	public $email;
	public $name;

	public function nameToUpper(){
		return strtoupper($this->name);
	}
}


    //$db = new PDO("sqlite:users.db");
    $db = new PDO("sqlite:users-1.db");

	//$sql = "SELECT * FROM user";
	$sql = "SELECT name, city, color FROM user";

    $stmt = $db->query($sql);

    //$obj = $stmt->fetchALL(PDO::FETCH_CLASS, 'Users');
    //$obj = $stmt->fetchALL(PDO::FETCH_COLUMN, 1);
    $obj = $stmt->fetchALL(PDO::FETCH_COLUMN|PDO::FETCH_GROUP);
	var_dump($obj);
    foreach($obj as $user){
        echo $user->nameToUpper().'<br>';
    }
    $db = null;

?>