<?php

class NumberPow implements Iterator {

    private $obj, $cur;

    public function __construct($obj) {
        $this->obj = $obj;
    }

    public function rewind() {
        $this->cur = $this->obj->getStart();
    }

    public function current() {
        return pow($this->cur,2);
    }

    public function key() {
        return $this->cur;
    }

    public function next() {
        return $this->cur++;
    }

    public function valid() {
        $var = $this->cur <= $this->obj->getEnd();
        return $var;
    }

}
class NumberSquare implements Iterator {

    private $obj, $cur;

    public function __construct($obj) {
        $this->obj = $obj;
    }

    public function rewind() {
        $this->cur = $this->obj->getStart();
    }

    public function current() {
        return sqrt($this->cur);
    }

    public function key() {
        return $this->cur;
    }

    public function next() {
        return $this->cur++;
    }

    public function valid() {
        $var = $this->cur <= $this->obj->getEnd();
        return $var;
    }

}
class NumberAction implements IteratorAggregate{
    private $start, $end, $action;
    public function __construct($start, $end, $action) {
        $this->start = $start;
        $this->end = $end;
        $this->action = $action;
    }
    function getStart(){
        return $this->start;
    }
    function getEnd(){
        return $this->end;
    }
    function getIterator() {
        switch ($this->action){
            case 'pow': return new NumberPow($this); break;
            case 'sqrt': return new NumberSquare($this); break;
        }
    }
}

$obj = new NumberAction(3,7, 'pow');

foreach ($obj as $key => $value) {
    print "<p>Квадрат числа $key = $value\n</p>";
}