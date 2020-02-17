<?php
// Тестирование операций с массивами PHP при с использованием PHPUnit
// require_once 'PHPUnit/Framework.php';
use PHPUnit\Framework\TestCase;

class ArrayTest extends TestCase{
    public function testCondition(){
        
		$arr = array();
        $this->assertEquals(0, count($arr));
		
		array_push($arr, 'element');
        $this->assertEquals('element', $arr[count($arr)-1]);
        $this->assertEquals(1, count($arr));

        $this->assertEquals('element', array_pop($arr));
        $this->assertEquals(0, count($arr));
		
    }
}

?>