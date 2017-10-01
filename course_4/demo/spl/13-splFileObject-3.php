<?php
$it = new SplFileObject('data.csv');

while($array = $it->fgetcsv()) {
	var_export($array);
}
?>