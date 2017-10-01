<?php
    $a = array('one' => 1, 'two' => 2, 'three' => 3, 'four' => 4);
    //print_r($a);
	class Dog
{
    private $_name;
    protected $_color;

    public function __construct($name, $color)
    {
         $this->_name = $name;
         $this->_color = $color;
    }

    public function greet($greeting)
    {
         return function() use ($greeting) {
             echo "$greeting, I am a {$this->_color} dog named 
{$this->_name}.";
         };
    }
}

$dog = new Dog("Rover","red");
//var_dump($dog->greet("Hello"));

/*
class House
{
     public function paint($color)
     {
         return static function() use ($color) { echo "Painting the 
house $color...."; };
     }
}

$house = new House();
$house->paint('red');
*/
?>