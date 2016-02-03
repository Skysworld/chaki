<?php

	header("Refresh: 2;"); // permet de faire un refresh

	// Désactivation du cache WSDL
	ini_set("soap.wsdl_cache_enabled", "0");  

	$options = array('uri'=> 'http://localhost/webservice/');
	$client = new SoapClient("wsdl.wsdl"); 
	try {
		print "\n\n ";	/*
		$Identifiant ='paul';
		$Mac='b4:pp:a4:yy';
		$Broche = array(1,1,0,1,1);
		echo "Adresse Mac prise : $Mac <br> Broche : ";
		echo "<br> ";
		echo $client->etat($Identifiant, $Mac, $Broche); */

		echo "<br> <br> <br> ";
		$Id ='vert';
		$Password='123';
		echo "Demande de connexion : ";
		echo $client->authentification($Id, $Password); 
		
		echo "<br> <br> <br> ";
		$Id ='bleu';
		$Password='123456';
		echo "Demande de connexion : ";		
		echo $client->authentification($Id, $Password);


		
			
	} catch (SoapFault $exception) { 
		echo $exception;       
	} 
?>