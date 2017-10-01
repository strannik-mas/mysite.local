<?php
	foreach ($this->user as $name=>$rol){
		if($name==$this->name){
			echo "<h2>User ".ucfirst($this->name)." is ".$rol."</h2>";
			exit;
		}		
	}
	echo "<h2>Unknown user ".ucfirst($this->name)."</h2>";
?>