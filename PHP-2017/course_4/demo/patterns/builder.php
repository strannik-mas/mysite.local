<?php
class Window{
    private $visible = false;
    private $modal = false;
    private $dialog = false;
    
    function __construct($v, $m, $d) {
        $this->visible = $v;
        $this->dialog = $d;
        $this->modal = $m;
    }
}

class CreateWindow{
    function setDialog($flag = false){
        $this->dialog = $flag;
        return this;        //для вызова цепочкой
    }
    function setModal($flag = false){
        $this->modal = $flag;
        return this;        //для вызова цепочкой
    }
    function setVisible($flag = false){
        $this->visible = $flag;
        return this;        //для вызова цепочкой
    }
    function create(){
        return new Window($this->visible, $this->modal, $this->dialog);
    }
}
//$w = new Window(true, false, true);
$s = new CreateWindow;
$w = $s->setVisible(true)->setModal(true)->create();