<?

$arr = [1,2,3,4,5];
function foo($v){
    return $v*10;
}
//$newArr = array_map('foo', $arr);
$newArr = array_map(function ($v){
    return $v*10;
}, $arr);

$name = 'John';
$closure = function() use($name){
    echo 'Hello, '.$name;
};
//$closure();

$add = function($num){
    return function($x)use($num){
        return $x*$num;
    };
};
$add_2 = $add(2);
echo $add_2(3);
$add_5 = $add(5);
echo '<br>',$add_5(3);
/*
function Hello($name){
    echo "hello, $name";
}
Hello('John');
$func = 'Hello';
$func('John');

$x = function ($name){
    echo "Hello, $name";
};
$x('John');
var_dump($x);
 * 
 */