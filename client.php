<?php
	// refresh de la page
	header("Refresh: 2;"); 

	// Désactivation du cache WSDL
	ini_set("soap.wsdl_cache_enabled", "0");  

	$options = array('uri'=> 'http://172.17.50.155/webservice/');
	$client = new SoapClient("wsdl.wsdl"); 
	try {
		// Demande de connexion => récupère des adresse Mac
		$Id ='Chaki';
		$Password='sTS2snir';
		echo "Demande de connexion 1 : ";
		echo $client->Authentification($Id, $Password);
		
		echo "<br> <br> <br> ";
		$Id ='zefd';
		$Password='787';
		echo "Demande de connexion 2 : ";		
		echo $client->Authentification($Id, $Password);		
				
		// Changement des etats des prises
		echo "<br> <br> <br> ";
		$Identifiant ='Chaki';
		$Mac='01:00:5E:CC:38:S1';
		$Broche='11111';
		echo "Adresse Mac prise : $Mac <br> Broche : $Broche";
		echo "<br> ";
		echo $client->Modification($Identifiant, $Mac, $Broche); 

		// Changement de mot de passe		
		echo "<br> <br> <br> ";
		$Id ='chose';
		$NewPassword='blabla';	
		echo $client->Mot_de_passe($Id, $NewPassword);
			
	} catch (SoapFault $exception) { 
		echo $exception;       
	} 
?>