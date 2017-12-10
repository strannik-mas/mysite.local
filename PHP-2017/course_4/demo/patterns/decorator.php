<?php
interface Shape{    function draw();}
class Square implements Shape{
    function draw(){
        echo __METHOD__;
    }
}
class Rectangle implements Shape{
    function draw(){
        echo __METHOD__;
    }
}
class Circle implements Shape{
    function draw(){
        echo __METHOD__;
    }
}
abstract class ShapeDecorator implements Shape{
    protected $decoratedShape;
    function __construct(Shape $decoratedShape) {
        $this->decoratedShape = $decoratedShape;
    }
    function draw() {
        $this->decoratedShape->draw();
    }
}
class RedShapeDecorator extends ShapeDecorator{
    function __construct(Shape $decoratedShape) {
        parent::__construct($decoratedShape);
    }
    private function setRedBorder(){
        echo 'Border Color red';
    }
    function draw() {
        parent::draw();
        $this->setRedBorder();
    }
}
$c = new Circle; $c->draw();
$rc = new RedShapeDecorator(new Circle); $rc->draw();