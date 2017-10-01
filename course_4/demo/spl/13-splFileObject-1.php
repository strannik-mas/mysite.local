<?php
$it = new SplFileObject('filename.txt');

foreach($it as $line) {
	echo $line;
}
?>