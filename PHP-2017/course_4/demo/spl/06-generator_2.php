<?php
/*
function nums(){
    echo '<span>START</span><br>';
    
    for($i=0; $i<5; ++$i){
        yield $i;
        echo 'VALUE: '.$i.'<br>';        
    }
    
    echo 'FINISH<br>';
}
function get(){
    yield 'a';
    yield 'b';
    yield 'name'=>'John';
    yield 'd';
    yield 10=> 'Hello';
    yield 'e';
}
//foreach (nums() as $v);
foreach (get() as $k=>$v){
    echo "$k : $v<br>";
}
 * 
 */

function echoLogger(){
    while(true){
        echo 'Log: '. yield . '<br>';
    }
}
$logger = echoLogger();
$logger->send('Hello');
$logger->send(';lkjs');