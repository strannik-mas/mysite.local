<?php
interface IPlugin{
	/**	ќписание плагина
	*/
	public static function getName();
	/**	ƒл¤ вывода ссылок на сайты , опишите метод (public или public static)
	* 	‘ормат: array(link, href)  
	*	array getMenuItems(void)
	*/
	/**	ƒл¤ вывода ссылок на статьи, опишите метод (public или public static)
	* 	‘ормат: array(название статьи, href)
	* 	array getArticlesItems(void)
	*/
	/**	ƒл¤ вывода ссылок на приложени¤, опишите метод (public или public static)
	* 	‘ормат: array(название приложени¤, href)
	* 	array getAppsItems(void)
	*/
}
?>