<?php
// ������������� ��������� @depends ��� �������� ������������
class StackTest extends PHPUnit\Framework\TestCase{
    
	public function testEmpty(){
        $arr = array();
        $this->assertTrue(empty($arr));

        return $arr;
    }

    /**
     * @depends testEmpty
     */
    public function testPush(array $arr){
        array_push($arr, 'foo');
        $this->assertEquals('foo', $arr[count($arr)-1]);
        $this->assertFalse(empty($arr));

        return $arr;
    }

    /**
     * @depends testPush
     */
    public function testPop(array $arr)
    {
        $this->assertEquals('foo', array_pop($arr));
        $this->assertTrue(empty($arr));
    }
}
?>