<?php
	// refresh de la page
	//header("Refresh: 2;"); 

	// Désactivation du cache WSDL
	ini_set("soap.wsdl_cache_enabled", "0");  

	$options = array('uri'=> 'http://172.17.50.155/webservice/');
	$client = new SoapClient("wsdl.wsdl"); 
	try {
		// Demande de connexion => récupère des adresse Mac
		$Id ='Erwan';
		$Password='7110eda4d09e062aa5e4';
		echo "Demande de connexion 1 : ";
		echo $client->Authentification($Id, $Password);
		
		echo "<br> <br> <br> ";
		$Id ='zefd';
		$Password='787';
		echo "Demande de connexion 2 : ";		
		echo $client->Authentification($Id, $Password);		
				
		// Changement des etats des prises
		echo "<br> <br> <br> ";
		$Identifiant ='Erwan';
		$Mac='18:fe:34:e4:c1:47';
		$Broche='510001';
		echo "Adresse Mac prise : $Mac <br> Broche : $Broche";
		echo "<br> ";
		echo $client->Modification($Identifiant, $Mac, $Broche); 
		
		// Changement de mot de passe		
		echo "<br> <br> <br> ";
		$Id ='Chaki';
		$NewPassword='blabla';	
		echo $client->Mot_de_passe($Id, $NewPassword);
		
		//Affichage des etats courant 
		echo "<br> <br> <br> ";
		$Mac ='91-70-1B-DC-9E-FF';
		echo $client->Etat_courant($Mac);
			
	} catch (SoapFault $exception) { 
		echo $exception;       
	} 
?>