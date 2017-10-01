<?php
class NumberPow implements Iterator{
    private $_start, $_end, $_cur, $_stepen;

    public function __construct($s, $e, $st){
        $this->_start = $s;
        $this->_end = $e;
        $this->_stepen = $st;
    }

    public function rewind() {
        $this->_cur = $this->_start;
    }

    public function key() {
        return $this->_cur;
    }
	
	public function current() {
        return pow($this->_cur, $this->_stepen);
    }

    public function next() {
        return $this->_cur++;
    }

    public function valid() {
        return $this->_cur <= $this->_end;
    }
}
class MyCollection implements IteratorAggregate{
    private $start;
    private $end;
    private $stepen;
	

    // Required definition of interface IteratorAggregate
    public function getIterator() {
		return new NumberPow($this->start, $this->end, $this->stepen);
    }

    public function add($s1, $e1, $st1) {
        $this->start = $s1;
        $this->end = $e1;
        $this->stepen = $st1;
    }
}
$nums = new MyCollection();
$step=7;
$nums->add(1, 5, $step);
foreach ($nums as $a => $b) {
    print "Число $a в степени $step = $b\n";
}
?>