<?php
class StockService{
    function getStock($num){
		$stock = array(
			"1"=>100,
			"2"=>200,
			"3"=>300,
			"4"=>400,
			"5"=>500,
		);
		if(array_key_exists($num, $stock))
			return $stock[$num];
		else
			throw new SoapFault("Server", "No goods");
	}
}
/*
$o = new StockService();
echo $o->getStock("2"); 
*/
	// Описать функцию/метод Web-сервиса
	ini_set("soap.wsdl_cache_enabled","0");
	// Отключить кэширование WSDL-документа
	$server = new SoapServer("http://mysite.local/soap_old/stock.wsdl");
	// Создать SOAP-сервер
	$server->setClass("StockService");
	//$arr = array("foo1","foo2");
	//$server->addFunction($arr);
	//$server->addFunction("getStock");
	// Добавить функцию/класс к серверу
	$server->handle();
	// Запустить сервера
	
?>