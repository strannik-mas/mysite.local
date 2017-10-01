<?php
class registry implements ArrayAccess{
    public $props = array();

    public function offsetSet($name, $value){
        $this->props[$name] = $value;
        return true;
    }

    public function offsetExists($name){
        return isset($this->props[$name]);
    }

    public function offsetUnset($name){
        unset($this->props[$name]);
        return true;
    }

    public function offsetGet($name){
        if(!isset($this->props[$name])){
            return null;
        }
        return $this->props[$offset];
    }
}
$obj = new registry();
//var_dump($obj);
$obj["login"] = 'root';
$obj["password"] = '1234';
echo $obj->props["login"].':'.$obj->props["password"];
//print_r($obj);
?>