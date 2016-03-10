<?php

	header("Refresh: 2;"); // permet de faire un refresh

	// Désactivation du cache WSDL
	ini_set("soap.wsdl_cache_enabled", "0");  

	$options = array('uri'=> 'http://172.17.50.155/webservice/');
	$client = new SoapClient("wsdl.wsdl"); 
	try {
		print "\n\n ";	
		$Identifiant ='Chaki';
		$Mac='01:00:5E:CC:38:S1';
		$Broche='10110';
		//$Broche = array(1,1,1,1,1);
		echo "Adresse Mac prise : $Mac <br> Broche : ";
		print_r($Broche);
		echo "<br> ";
		echo $client->Modification($Identifiant, $Mac, $Broche); 

		
		echo "<br> <br> <br> ";
		$Id ='Chaki';
		$Password='sTS2snir';
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