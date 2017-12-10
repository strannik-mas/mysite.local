<?php
try {
  // Создание SOAP-клиента
  $client = new SoapClient("http://mysite.local/PHP-2017/course_3/newsoap/stock.wsdl");
	
  // Посылка SOAP-запроса c получением результат
  $result = $client->getStock("3");
  echo "Текущий запас на складе: ", $result;
} catch (SoapFault $exception) {
  echo $exception->getMessage();	
}
?>