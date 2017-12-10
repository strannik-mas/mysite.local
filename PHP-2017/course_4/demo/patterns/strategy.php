<?php
/*
function foo($a,$b){
    if($a==$b)        return 0;
    return ($a<$b) ? -1 : 1;
}
$a = [1,2,3,4,5,-3];
usort($a, 'foo');
print_r($a);
 * 
 */
interface Strategy{
    function doOperation($num1, $num2);
}
class OperationAdd implements Strategy{
    function doOperation($num1, $num2){
        return $num1 + $num2;
    }
}
class OperationMult implements Strategy{
    function doOperation($num1, $num2){
        return $num1 * $num2;
    }
}

class Context{
    private $strategy;
    function __construct(Strategy $s) {
        $this->strategy = $s;
    }
    function execute($n1, $n2){
        return $this->strategy->doOperation($n1, $n2);
    }
}

$ctx = new Context(new OperationAdd);
echo $ctx->execute(2, 5);