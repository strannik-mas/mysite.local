<?php
class Course{
	private $_name;
	function __construct($n){
		$this->_name = $n;
	}
	function __toString(){
		return $this->_name;
	}
}

$courses = new SplObjectStorage();
$php = new Course('php');
$xml = new Course('xml');
$java = new Course('java');

$courses->attach($php);
$courses->attach($xml);
var_dump($courses->contains($php)); //true
var_dump($courses->contains($xml)); //true
$courses->detach($xml);
var_dump($courses->contains($xml)); //false
$courses->attach($java);
$titles = array();
foreach($courses as $course){
	$titles[] = (string)$course;
}
print join(', ', $titles);

$os = new SplObjectStorage();

$person = new stdClass();// Стандартный объект
$person->name = "John";
$person->age = "25";

$os->attach($person); //Добавляем объект в storage
echo "<br>";
foreach ($os as $object){
	print_r($object);
	echo "<br>";
}

$person->name = "Mike"; //Меняем имя
echo str_repeat("-",30)."<br>"; //Просто линия

foreach ($os as $object){
	print_r($object);
	echo "<br>";
}

$person2 = new stdClass();
$person2->name = "Vasya";
$person2->age = "18";

$os->attach($person2);

echo str_repeat("-",30)."<br>";

foreach ($os as $object){
	print_r($object);
	echo "<br>";
}

if($os->contains($person))
	echo "У нас имеется объект person";
else
	echo "У нас нет объекта person";

$os->rewind();
echo "<br>" . $os->current()->name;

$os->detach($person); //Удаляем объект из коллекции

echo "<br>".str_repeat("-",30)."<br>";
foreach ($os as $object){
	print_r($object);
	echo "<br>";
}
/**/
?>
<?php
/*
foreach(get_class_methods(SplObjectStorage) as $key=>$method){
	echo $key.' -> '.$method.'<br />';
}
*/
?>