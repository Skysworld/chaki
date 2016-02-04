<?php

	header("Refresh: 2;"); // permet de faire un refresh

	// Désactivation du cache WSDL
	ini_set("soap.wsdl_cache_enabled", "0");  

	$options = array('uri'=> 'http://localhost/webservice/');
	$client = new SoapClient("wsdl.wsdl"); 
	try {
		print "\n\n ";	
		$Identifiant ='bleu';
		$Mac='41:45:pm';
		$Broche = array(1,0,0,1,0);

		echo "Adresse Mac prise : $Mac <br> Broche : ";
		print_r($Broche);
		echo "<br> ";
		echo $client->modification($Identifiant, $Mac, $Broche); 

		echo "<br> <br> <br> ";
		$Id ='bleu';
		$Password='123456';
		echo "Demande de connexion 1 : ";
		echo $client->authentification($Id, $Password); 
		
		echo "<br> <br> <br> ";
		$Id ='zefd';
		$Password='787';
		echo "Demande de connexion 2 : ";		
		echo $client->authentification($Id, $Password);
		
			
	} catch (SoapFault $exception) { 
		echo $exception;       
	} 
?>