<?php
class FileModel{
	/* ��� ������������ */
	public $name = '';
	/* ������ ������������� */
	public $list = '';
	/* ������� ������������: ������������� ������ 
	*	� ���������� role � name ��� ������������� ������������
	*	��� ������ � ��������� name ��� ������������ ������������
	*/
	public $user = array();
	
	public function render($file) {
		/* $file - ������� ������������� */
		//var_dump($this->list);
		ob_start();
		include($file);
		//var_dump(ob_get_contents());
		return ob_get_clean();
	}
}