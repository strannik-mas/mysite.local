<?php
interface I{
    function foo();
    function bar();
}
class A implements I{
    function foo(){echo __METHOD__;}
    function bar(){echo __METHOD__;}
}
class B implements I{
    function foo(){echo __METHOD__;}
    function bar(){echo __METHOD__;}
}
class C implements I{
    protected $class;
    function __construct() {
        $this->class = new A;
    }
    function foo(){
        $this->class->foo();        
    }
    function bar(){
        $this->class->bar();
    }
    function toA(){
        $this->class = new A;
    }
    function toB(){
        $this->class = new B;
    }
}
$c = new C;
$c->foo();
$c->toB();
$c->foo();
$c->bar();