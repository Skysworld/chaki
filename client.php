<?php
	// refresh de la page
	header("Refresh: 2;"); 

	// Désactivation du cache WSDL
	ini_set("soap.wsdl_cache_enabled", "0");  

	$options = array('uri'=> 'http://172.17.50.155/webservice/');
	$client = new SoapClient("wsdl.wsdl"); 
	try {

//echo"************************************************************Authentification*********************************************************<br><br>";
/*
	echo "Identifiant qui fonctionne <br>";
	$Identifiant = 'Paul';
	$Password = '123';
	echo "nom : $Identifiant <br> mdp : $Password <br> reponse :";
	echo $client->Authentification($Identifiant,$Password);
echo "<br> <br> <br> ";
	
	echo "Identifiant qui fonctionne pas <br>";
	$Identifiant = 'Paul';
	$Password = '456';
	echo "nom : $Identifiant <br> mdp : $Password <br> reponse :";
	echo $client->Authentification($Identifiant,$Password);
echo "<br> <br> <br> ";
*/

//echo"************************************************************Modification*********************************************************<br><br>";
/*
	echo "Modification qui fonctionne <br>";
	$Identifiant ='Paul';
	$Mac='18:fe:34:e4:c1:47';
	$N_prise = 3;
	$Etat=0;
	echo "Nom: $Identifiant <br> Mac: $Mac <br> Prise num: $N_prise <br> l'etat est $Etat <br> reponse :";
	echo $client->Modification($Identifiant,$Mac,$N_prise,$Etat);
echo "<br> <br> <br> ";

	echo "Modification qui ne fonctionne pas <br>";
	$Identifiant ='Pas Paul';
	$Mac='18:fe:34:e4:c1:47';
	$N_prise = 1;
	$Etat= 1;
	echo "Nom: $Identifiant <br> Mac: $Mac <br> Prise num: $N_prise <br> l'etat est $Etat <br> reponse : ";
	echo $client->Modification($Identifiant,$Mac,$N_prise,$Etat);
	
echo "<br> <br> <br> ";
*/

//echo"***********************************************************Mot_de_passe*********************************************************<br><br>";
/*
	echo "Modif du MDP qui fonctionne <br>";
	$Id ='Erwan';
	$Password='test';
	$NewPassword='test';	
	echo $client->Mot_de_passe($Id, $NewPassword, $Password);
echo "<br> <br> <br> ";

	echo "Modif du MDP qui ne fonctionne pas <br>";
	$Id ='';
	$Password='chaki1';
	$NewPassword='chaki';	
	echo $client->Mot_de_passe($Id, $NewPassword, $Password);
echo "<br> <br> <br> ";
*/
//echo"**********************************************Reinitialisation-que-pour-l-examen*********************************************************<br><br>";
/*
	echo "Modif du MDP qui fonctionne <br>";
	$Id ='Erwan';
	$Password='test';
	$NewPassword='test';	
	echo $client->Reinitialisation($Id, $NewPassword, $Password);
echo "<br> <br> <br> ";

	echo "Modif du MDP qui ne fonctionne pas <br>";
	$Id ='';
	$Password='chaki1';
	$NewPassword='chaki';	
	echo $client->Reinitialisation($Id, $NewPassword, $Password);
echo "<br> <br> <br> ";
*/
//echo"***********************************************************Etat_courant*********************************************************<br><br>";
/*
	echo "Etat courant qui fonctionne <br>";
	$Mac ='18:fe:34:e4:c1:47';
	echo $client->Etat_courant($Mac);
echo "<br> <br> <br> ";

	echo "Etat courant qui ne fonctionne pas <br>";
	$Mac ='52:47:58:44:11:44';
	echo $client->Etat_courant($Mac);	
echo "<br> <br> <br> ";
*/
//echo"************************************************************Ephemeride*********************************************************<br><br>";
/*
	echo "Ephemeride qui fonctionne <br>";
	$Mac='18:fe:34:e4:c1:47';
	$N_prise=1;
	$Nb_Ephe=2;
	$Plannif='103001655';
	echo "Adresse Mac prise : $Mac <br> Plannifier : $Plannif <br> prise num : $N_prise <br> slot : $Nb_Ephe <br>";
	echo $client->Ephemeride($Mac, $N_prise, $Nb_Ephe, $Plannif);	
echo "<br> <br> <br> ";

	echo "Ephemeride qui ne fonctionne pas <br>";
	$Mac='15:15:15:14:15:45';
	$N_prise=1;
	$Nb_Ephe=2;
	$Plannif='103001655';
	echo "Adresse Mac prise : $Mac <br> Plannifier : $Plannif <br> prise num : $N_prise <br> slot : $Nb_Ephe <br>";
	echo $client->Ephemeride($Mac, $N_prise, $Nb_Ephe, $Plannif);		
echo "<br> <br> <br> ";
*/
//echo"*******************************************************Etat_courant_ephe*******************************************************<br><br>";
/*
	echo "Etat des Ephemerides fonctionne<br>";
	$Mac='18:fe:34:e4:c1:47';
	$N_Prise=2;
	$Nb_Ephe=1;
	echo "Prise N°: $N_Prise <br> plage : $Nb_Ephe <br> réponse : ";
	echo $client->Etat_courant_ephe($Mac, $N_Prise, $Nb_Ephe);
echo "<br> <br> <br> ";

	echo "Etat des Ephemerides qui ne fonctionne pas <br>";
	$Mac='ff:ff:ff:ff:ff:ff';
	$N_Prise=1;
	$Nb_Ephe=2;
	echo $client->Etat_courant_ephe($Mac, $N_Prise, $Nb_Ephe);
echo "<br> <br> <br> ";
*/
//echo"************************************************************Historique*********************************************************<br><br>";
/*
	echo "Historique qui fonctionne <br>";
	$Mac='18:fe:34:e4:c1:47';
	echo $client->Historique($Mac);
echo "<br> <br> <br> ";

	echo "Historique qui ne fonctionne pas <br>";
	$Mac='ff:ff:ff:ff:ff:ff';
	echo $client->Historique($Mac);
echo "<br> <br> <br> ";
*/

	} catch (SoapFault $exception) { 
		echo $exception;       
	}
?>