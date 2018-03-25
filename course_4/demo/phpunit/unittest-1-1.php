<?php
// ������������ �������� � ��������� PHP ��� � �������������� PHPUnit
// require_once 'PHPUnit/Framework.php';

class ArrayTest extends PHPUnit\Framework\TestCase{
    public function testCondition(){
        
		$arr = array();
        $this->assertEquals(0, count($arr));
		
		array_push($arr, 'element');
        $this->assertEquals('element', $arr[count($arr)-1]);
        $this->assertEquals(2, count($arr));

        $this->assertEquals('element', array_pop($arr));
        $this->assertEquals(0, count($arr));
		
    }
}

?>