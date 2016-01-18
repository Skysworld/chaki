<?php
	// Désactivation du cache WSDL
	ini_set("soap.wsdl_cache_enabled", "0");  

  $client = new SoapClient("operation.wsdl"); 
  try { 
  	$operation = "add";
  	$integer1  = 3;
  	$integer2  = 4;
  	echo "$integer1 $operation $integer2 = ";
  	echo $client->getResult($operation, $integer1, $integer2); 
  } catch (SoapFault $exception) { 
    echo $exception;       
  } 
?>