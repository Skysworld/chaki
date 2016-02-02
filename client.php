<?php

	header("Refresh: 2;"); // permet de faire un refresh

	// Désactivation du cache WSDL
	ini_set("soap.wsdl_cache_enabled", "0");  

	$options = array('uri'=> 'http://172.17.50.155/webservice/');
	$client = new SoapClient("wsdl.wsdl"); 
	try {
		print "\n\n ";	
		$Identifiant ='test';
		$Mac='b4:b4:a4:x1';
		$Broche = array(1,1,1,1,1);
		echo "Adresse Mac prise : $Mac <br> Broche : ";
		print_r($Broche);
		echo "<br> ";
		echo $client->etat($Identifiant, $Mac, $Broche); 

			
	} catch (SoapFault $exception) { 
		echo $exception;       
	} 
?>