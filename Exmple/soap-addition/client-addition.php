<?php
	// Désactivation du cache WSDL
	ini_set("soap.wsdl_cache_enabled", "0");  

	$options = array(//"trace" => true
		'uri'=> 'http://172.17.50.155/soap-addition/'
	);
  $client = new SoapClient("addition.wsdl"); 
  try { 
  	$integer1  = 3; //int
  	$integer2  = 4; //int
  	echo "$integer1 + $integer2 = ";
  	echo $client->add($integer1, $integer2); 
  	print "<pre>\n"; 
	  print "Request :\n".htmlspecialchars($client->__getLastRequest()) ."\n"; 
	  print "Response:\n".htmlspecialchars($client->__getLastResponse())."\n"; 
	print "</pre>"; 
	"<br>";
	
	echo "$integer1 + $integer2 = ";
  	echo $client->substract($integer1, $integer2); 
  	print "<pre>\n"; 
	  print "Request :\n".htmlspecialchars($client->__getLastRequest()) ."\n"; 
	  print "Response:\n".htmlspecialchars($client->__getLastResponse())."\n"; 
	print "</pre>";
	
  } catch (SoapFault $exception) { 
    echo $exception;       
  } 
?>