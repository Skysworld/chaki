<?php
	// refresh de la page
	//header("Refresh: 2;"); 

	// Désactivation du cache WSDL
	ini_set("soap.wsdl_cache_enabled", "0");  

	$options = array('uri'=> 'http://172.17.50.155/webservice/');
	$client = new SoapClient("wsdl.wsdl"); 
	try {
		
	
		$Identifiant ='Erwan';
		$Mac='18:fe:34:e4:c1:47';
		$N_prise = 2;
		$Etat= 0;
		echo "Nom: $Identifiant <br> Mac: $Mac <br> Prise num: $N_prise <br> l'etat est $Etat <br>";
		//echo $client->Modification($Identifiant,$Mac,$N_prise,$Etat); 
		echo "<br> <br> <br> ";

		
		$Mac='18:fe:34:e4:c1:47';
		$N_prise=3;
		$Nb_Ephe=2;
		$Plannif='114001655';
		echo "Adresse Mac prise : $Mac <br> Plannifier : $Plannif <br> prise num : $N_prise <br> slot : $Nb_Ephe <br>";
		echo "<br>";
	echo $client->Ephemeride($Mac, $N_prise, $Nb_Ephe, $Plannif); 
		echo "<br> ";	

		// Demande de connexion => récupère des adresse Mac
		$Id ='Paul';
		$Password='123';
		echo "Demande de connexion 1 : ";
		echo $client->Authentification($Id, $Password);
		
		echo "<br> <br> <br> ";
		$Id ='zefd';
		$Password='787';
		echo "Demande de connexion 2 : ";		
		echo $client->Authentification($Id, $Password);		
				

		
		// Changement de mot de passe		
		echo "<br> <br> <br> ";
		$Id ='Chaki';
		$NewPassword='blabla';	
		echo $client->Mot_de_passe($Id, $NewPassword);
		
		//Affichage des etats courant 
		echo "<br> <br> <br> ";
		$Mac ='91-70-1B-DC-9E-FF';
		echo $client->Etat_courant($Mac);
	
		//$prise=['Nb_Ephe_Prise'].$N_prise;
		

		
	} catch (SoapFault $exception) { 
		echo $exception;       
	} 
?>