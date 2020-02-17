<?php
set_include_path ("d:/domains/mysite.local/phpUnit/src");
include_once('User.php');
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {
	public function testNameIsGet() {
		$user = new User();
		$user->name = "Петя";
		$this->assertEquals("Петя",$user->getName());
	}
	
	function testDefaultNameIsGet(){
		$user = new User();
		$this->assertEquals("Bacя", $user->getName());
	}
	function testGetName(){
		$this->assertTrue(true, true);
		return "Андрей";
	}
	
	/**
	* @depends testGetName
	*/
	function testCreateUser(){
		$u = new User();
		$u->setName("turuue");
		$this->assertEquals("turuue", $u->getName());
		$this->assertEquals("24", $u->getAge());
	}
}
?>
