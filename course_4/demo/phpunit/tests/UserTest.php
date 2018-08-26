<?php
set_include_path ("d:/domains/mysite.local/course_4/demo/phpunit/tests/classes");
include_once('User.php');

class UserTest extends PHPUnit/Framework/TestCase {
	public function testNameIsGet() {
		$demo = new User();
		$user->name = "Петя";
		$this->assertEquals("Петя",$user->getName());
	}
}
?>
