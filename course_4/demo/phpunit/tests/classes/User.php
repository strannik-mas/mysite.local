<?php
class User {
	
	public $name = "Bacя";
	public $age = 24;

	public function setName($n) {
		$this->name = $n;
	}
	public function getName() {
		return $this->name;
	}
	public function setAge($a) {
		$this->age = $a;
	}
	
	public function getAge() {
		return $this->age;
	}
}