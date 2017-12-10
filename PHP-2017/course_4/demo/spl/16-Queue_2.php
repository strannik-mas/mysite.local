<?php
error_reporting(E_ALL);
class Boxer{
    public $name, $country;
    function __construct($n, $c) {
        $this->name = $n;
        $this->country = $c;
    }
}
function getBoxers(SplQueue $usa, SplQueue $rus){
    $lines = file('boxer.txt');
    $cnt = count($lines);
    for($i=0; $i<$cnt; ++$i){
        list($country, $name) = explode(':', $lines[$i]);
        if($country == 'USA')
            $usa->enqueue (new Boxer($name, $country));
        else
            $rus->enqueue (new Boxer($name, $country));
    }
}
function box(SplQueue $usa, SplQueue $rus){
    echo "Пара боксёров:<br>";
    while (!$usa->isEmpty() && !$rus->isEmpty()){
        $person = $usa->dequeue();
        echo "USA: " . $person->name;
        $person = $rus->dequeue();
        echo " против RUS: " . $person->name;
        echo '<br>';
    }
}
$rusBoxer = new SplQueue;
$usaBoxer = new SplQueue;
getBoxers($usaBoxer, $rusBoxer);
box($usaBoxer, $rusBoxer);
if(!$usaBoxer->isEmpty())
    echo $usaBoxer->count () . ' from USA в ожидании';
if(!$rusBoxer->isEmpty()){
    echo $rusBoxer->count () . ' from RUS в ожидании<br>';
    echo 'следующий в очереди: '. $rusBoxer->bottom()->name;
}