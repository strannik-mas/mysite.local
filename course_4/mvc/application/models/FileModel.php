<?php
class FileModel{
	/* Имя пользователя */
	public $name = '';
	/* Список пользователей */
	public $list = '';
	/* Текущий пользователь: ассоциативный массив 
	*	с элементами role и name для существующего пользователя
	*	или только с элементом name для неизвестного пользователя
	*/
	public $user = array();
	
	public function render($file) {
		/* $file - текущее представление */
		//var_dump($this->list);
		ob_start();
		include($file);
		//var_dump(ob_get_contents());
		return ob_get_clean();
	}
}