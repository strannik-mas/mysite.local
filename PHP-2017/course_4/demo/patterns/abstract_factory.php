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

interface Color{
    function fill();
}
class Red implements Color{
    function fill(){
        echo __METHOD__;
    }
}
class Green implements Color{
    function fill(){
        echo __METHOD__;
    }
}
class Blue implements Color{
    function fill(){
        echo __METHOD__;
    }
}
/******************/
abstract class AbstractFactory{
    abstract function getShape($shapeType);
    abstract function getColor($colorName);
}
/**/
class ShapeFactory extends AbstractFactory{
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
    function getColor($colorName) {
        return null;
    }
}
class ColorFactory extends AbstractFactory{
    function getColor($name){
        $name = strtoupper($name);
        if(!$name)            return null;
        switch ($name){
            case 'RED': return new Red; break;
            case 'GREEN': return new Green; break;
            case 'BLUE': return new Blue; break;
            default : throw new Exception('wrong name!');
        }
    }
    function getShape($shapeType) {
        return null;
    }
}

class FactoryProducer{
    static function getFactory($factoryType){
        if(!$factoryType)            return null;
        switch (strtoupper($factoryType)){
            case 'SHAPE': return new ShapeFactory;
            case 'COLOR': return new ColorFactory;
            default : throw new Exception('wrong factory type!');
        }
    }
}

$shapeFactory = FactoryProducer::getFactory("SHAPE");
$colorFactory = FactoryProducer::getFactory("COLOR");
$c = $shapeFactory->getShape('circle')->draw();
//$c->draw();

$r = $colorFactory->getColor('red');
$r->fill();