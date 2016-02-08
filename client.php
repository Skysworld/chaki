<?php

	header("Refresh: 2;"); // permet de faire un refresh

	// Désactivation du cache WSDL
	ini_set("soap.wsdl_cache_enabled", "0");  

	$options = array('uri'=> 'http://172.17.50.155/webservice/');
	$client = new SoapClient("wsdl.wsdl"); 
	try {
/*		print "\n\n ";	
		$Identifiant ='bleu';
		$Mac='41:45:pm';
		$Broche='11111';
		//$Broche = array(1,1,1,1,1);
		echo "Adresse Mac prise : $Mac <br> Broche : ";
		print_r($Broche);
		echo "<br> ";
		echo $client->modification($Identifiant, $Mac, $Broche); 
*/
		
		echo "<br> <br> <br> ";
		$Id ='bleu';
		$Password='123456';
		echo "Demande de connexion 1 : ";
		//print_r ($client->authentification($Id, $Password)); 
		echo $client->authentification($Id, $Password);
		//echo $client->authentification2($Id, $Password);
		
		echo "<br> <br> <br> ";
		$Id ='zefd';
		$Password='787';
		echo "Demande de connexion 2 : ";		
		echo $client->authentification($Id, $Password);
		
			
	} catch (SoapFault $exception) { 
		echo $exception;       
	} 
?>