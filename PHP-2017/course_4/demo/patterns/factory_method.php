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

class ShapeFactory{
    function getShape($type){
        $type = strtoupper($type);
        if(!$type)            return null;
        switch ($type){
            case 'SQUARE': return new Square; break;
            case 'RECT': return new Rectangle; break;
            case 'CIRCLE': return new Circle; break;
            default : throw new Exception('wrong type!');
        }
    }
}

$factory = new ShapeFactory();
$r = $factory->getShape('rect');
$c = $factory->getShape('circle');
$r->draw(); $c->draw();