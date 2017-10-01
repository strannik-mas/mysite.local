<?php
	$start = memory_get_usage();
	//$arr = range(1, 100000);
	$array = new SplFixedArray(100000); // позволяет больше чем в 2 раза по данному примеру экономить время
	for ($i=0; $i<100000; ++$i)
		$array[$i] = $i;
	echo memory_get_usage() - $start, ' bytes';
	var_dump(spl_autoload_functions());
?>