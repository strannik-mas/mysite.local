<?php

class NumberPow implements Iterator {

    private $start, $end, $cur;

    public function __construct($start, $end) {
        $this->start = $start;
        $this->end = $end;
    }

    public function rewind() {
        $this->cur = $this->start;
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
        $var = $this->cur <= $this->end;
        return $var;
    }

}
class NumberSquare implements Iterator {

    private $start, $end, $cur;

    public function __construct($start, $end) {
        $this->start = $start;
        $this->end = $end;
    }

    public function rewind() {
        $this->cur = $this->start;
    }

    public function current() {
        return pow($this->cur,0.5);
    }

    public function key() {
        return $this->cur;
    }

    public function next() {
        return $this->cur++;
    }

    public function valid() {
        $var = $this->cur <= $this->end;
        return $var;
    }

}

$it = new NumberPow(3,7);

foreach ($it as $key => $value) {
    print "<p>Квадрат числа $key = $value\n</p>";
}

$it = new NumberSquare(3,9);

foreach ($it as $key => $value) {
    print "<p>Квадратный корень числа $key = $value\n</p>";
}