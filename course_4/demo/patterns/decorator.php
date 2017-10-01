<?php
abstract class ACourse{
	abstract function action();
}
class Course extends ACourse{
	function action(){
	//...
	}
}
abstract class ACourseDecorator extends ACourse{
	private $_course;
	function __construct(ACourse $course){
		$this->_course = $course;
	}
	function action(){$this->_course->action();}
}
class CourseDerorator extends ACourseDecorator{
	function action(){
	//...
	parent::action();
	//...
	}
}
$c = new Course;
$c->action();

$c1 = new CourseDecorator(new Course);
$c1->action();
?>