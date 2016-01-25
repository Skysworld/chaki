<?php
	$delai=2; 
	header("Refresh: $delai;"); // permet de faire un refresh

	// Désactivation du cache WSDL
	ini_set("soap.wsdl_cache_enabled", "0");  

	$options = array('uri'=> 'http://172.17.50.155/SOAP/');
	$client = new SoapClient("operation.wsdl"); 
	try { 
		$bouboul  = true; //bool
		echo "$bouboul est devenu ";
		echo $client->etat($bouboul); 
		print "<pre>\n"; 
		  print "Request : $bouboul \n".htmlspecialchars($client->__getLastRequest()) ."\n"; 
		  print "Response: ".htmlspecialchars($client->etat($bouboul))."\n"; 
		  print "</pre>"; 
	} catch (SoapFault $exception) { 
		echo $exception;       
	} 
?>