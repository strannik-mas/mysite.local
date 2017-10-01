<pre>
<?php
	function foo1($a, $b, $c) { }
	function foo2(Exception $a, &$b, $c) { }
	function foo3(ReflectionFunction $a, $b = 1, $c = null) { }
	function foo4() { }
	
	$a = [
	's1'=>[
		's22'=>33,
		's201'=>[
		    's4'=>45
		],
		's2'=>[
			's3'=>123
		    ]
	    ]
    ];
function fn($arr, $str){
    $jstr = json_encode($arr);
    $obj = new ArrayObject($arr);
    preg_match_all('/(s[0-9]+)/',$jstr, $matches);
    $str2 = implode('.', $matches[0]);
    var_dump($matches[0],$jstr);
    var_dump(stripos($str2,$str));
    var_dump($obj->offsetGet(end(explode('.',$str))));
    if(stripos($str2,$str)!=null)
	    ;
    
}

// Создание экземпляра класса ReflectionFunction
$reflect = new ReflectionFunction("fn");

echo $reflect;
exit;


foreach ($reflect->getParameters() as $i => $param) {
    printf(
        "-- Параметр #%d: %s {\n".
        "   Допускать NULL: %s\n".
        "   Передан по ссылке: %s\n".
        "   Обязательный?: %s\n".
        "}\n",
        $i,
        $param->getName(),
        var_export($param->allowsNull(), 1),
        var_export($param->isPassedByReference(), 1),
        $param->isOptional() ? 'нет' : 'да'
    );
}
?>
</pre>