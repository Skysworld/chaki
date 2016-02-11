<?php

	header("Refresh: 2;"); // permet de faire un refresh

	// Désactivation du cache WSDL
	ini_set("soap.wsdl_cache_enabled", "0");  

	$options = array('uri'=> 'http://172.17.50.155/webservice/');
	$client = new SoapClient("array2.wsdl"); 
	try {
		print "\n\n ";	
		$Identifiant ='bleu';
		$Mac='00:00:11:00';
		$Broche='11111';
		//$Broche = array(1,1,1,1,1);
		echo "Adresse Mac prise : $Mac <br> Broche : ";
		print_r($Broche);
		echo "<br> ";
		echo $client->Modification($Identifiant, $Mac, $Broche); 

		
		echo "<br> <br> <br> ";
		$Id ='bleu';
		$Password='123456';
		echo "Demande de connexion 1 : ";
		print_r ($client->Authentification($Id, $Password)); 
		//echo $client->Authentification($Id, $Password);
		
		echo "<br> <br> <br> ";
		$Id ='zefd';
		$Password='787';
		echo "Demande de connexion 2 : ";		
		//echo $client->Authentification($Id, $Password);
		
			
	} catch (SoapFault $exception) { 
		echo $exception;       
	} 
?>