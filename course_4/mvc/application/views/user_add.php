<?php
	echo "<h2>New user ".ucfirst($this->name).": ".$this->role."</h2>";
	//из массива user выбираем отдельно массив ключей и значений, дополняем их новым значением name role и объединяем в массив и сериализуем и записываем в файл
	$keys = $values = array();
	$keys = array_keys($this->user);
	array_push($keys, $this->name);
	$values = array_values($this->user);
	array_push($values, $this->role);
	$this->user = array_combine($keys, $values);
	$this->list = serialize($this->user);
	file_put_contents(USER_DB, $this->list);
?>