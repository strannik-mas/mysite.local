<?php
$pathName = '.';

foreach(new DirectoryIterator($pathName) as $fileInfo) {
	var_dump($fileInfo);
	echo $fileInfo . "\n";
}
?>