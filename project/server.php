<?php

$date = date("d-m-Y");
$heure = date("H:i");

//Refresh automatique du serveur
//header("Refresh: 2;"); 

// Librairie pour le client WebSocket
require('lib/class.websocket_client.php');


/**
 * Fonction permettant la connexion à la BDD
 */
 
function Base_de_donnees(){
	try{
		//Connexion à my sql
		mysql_connect("localhost", "root", "");
		mysql_select_db("domotique");
	}catch (Exception $e){
		//En cas d'erreur de connexion
		die('Erreur : '.$e->getMessage());
	}
}

/**
 * Fonction permettant l'autentification d'un client 
 * $Id est un string, nom du client
 * $Password est un string, mot de passe du client 	
 * Return les adresses Mac lié au client
 */
function Authentification($Id,$Password){
	//appel de la BDD
	Base_de_donnees();
	try{
		// Requete sql pour récupérer les adresses mac associées à l'identifiant
		$reponse = mysql_query("SELECT * FROM identifiant join prise ON identifiant.Identi=prise.Identity WHERE Identi='$Id' AND Password='$Password' ORDER BY Mac");
		// Vérification du contenu de la requete
		if(mysql_num_rows($reponse)==0)
		{
			return "Identifiant inconnu";
		}
		else{
			
			while ($row = mysql_fetch_assoc($reponse)) { 
				$resultat.=($resultat==""?"":"," ).$row['Mac']; 
			} 
			return $resultat;
		}
		
	}catch (Exception $a){
		//En cas d'erreur de connexion
		die ('Erreur:'.$a->getMessage());
	}
}



/**
 * Fonction permettant la modification des etats de la multiprise en mode instantane
 * $Identifiant est un string, nom du client
 * $Mac est un string, l'adresse mac de la multiprise du client 
 * $N_Prise est int, le numero de la prise
 * $Etat est un boolean, designe l etat de la prise
 * Return string
 */
 function Modification($Mac,$N_prise,$Etat) {
	
	//Appel de la BDD
	Base_de_donnees();
	try{
		$etatbool='EtatBool'.$N_prise;
		// Requete sql pour modifier l'état des prises
		$requete= mysql_query("UPDATE prise SET $etatbool='$Etat' WHERE Mac='$Mac'");
			
		switch ($N_prise){
			case 1:
				$p='10000';
			break;
			case 2:
				$p='01000';
			break;
			case 3:
				$p='00100';
			break;
			case 4:
				$p='00010';
			break;
			case 5:
				$p='00001';
			break;
		}
		
		// Création d'un client web socket et connexion au serveur
		$client = new WebsocketClient;
		$client->connect('172.17.50.156', 9300, '/');
		// Renvoi # et l'adresse Mac de la multiprise modifiée

		$client->sendData("#$Mac$p");
		
		//return "Prise $N_prise modifie <br>";
		
		}
	catch (Exception $a){
		//En cas d'erreur de connexion
		die ('Erreur:'.$a->getMessage());
	}
}




/**
 * Fonction permettant la modification du mot de passe du client
 * $Id est un string, nom du client
 * $NewPassword est un tring, le nouveau mot de passe du client
 * Return string
 */
function Mot_de_passe($Id,$NewPassword) {
	//Appel de la BDD
	Base_de_donnees();
	
	try{
		//
		$requete= mysql_query("UPDATE identifiant SET Password='$NewPassword' WHERE Identi='$Id'");
		if (mysql_num_rows($reponse)==!0){
			return "Erreur lors du changement";
		}
		else{
		return "Mot de passe change";
		}
	
	}
	catch (Exception $a){
		//En cas d'erreur de connexion
		die ('Erreur:'.$a->getMessage());
	}
}




/**
 * Fonction permettant le renvoi des états de la multiprise
 * $Mac est un string, l'adresse mac de la multiprise du client 
 * Return string, l'etat des prises sont renvoyés au client
 */
function Etat_courant($Mac){
	//appel de la BDD
	Base_de_donnees();
	try{
		// Requete sql pour récuperer les états des prises
		$requete= mysql_query("SELECT * FROM prise WHERE Mac='$Mac'");
		// Vérification du contenu de la requete
		if(mysql_num_rows($requete)==0)
		{
			return "Adresse mac inexistante";
		}
		else
		{
			while ($row = mysql_fetch_assoc($requete)) {
				$resultat.=$row['EtatBool1'].$row['EtatBool2'].$row['EtatBool3'].$row['EtatBool4'].$row['EtatBool5']; 
			}
			return "$resultat";		
		}
	}
	catch (Exception $a){
		die ('Erreur:'.$a->getMessage());
	}
}


/**
 * Fonction permettant de planifier une heure d'allumage
 * $Mac est un string, l'adresse mac de la multiprise du client 
 * $N_prise est un int, le num de la prise qui se modifie
 * $Nb_Ephe est un int, le num du slot qui se modifie
 * $Plannif est un string, le jour et l'heure est 
 */
function Ephemeride($Mac, $N_prise, $Nb_Ephe, $Plannif){
	//appel de la BDD
	Base_de_donnees();
	try{
		$ephe='Nb_Ephe_Prise'.$N_prise;
		$prise='Prise'.$N_prise.'_E'.$Nb_Ephe;	
		
		$requete=mysql_query("UPDATE programmation SET $ephe='$Nb_Ephe', $prise='$Plannif' WHERE Mac='$Mac' ");	

		switch ($N_prise){
			case 1:
				$p='10000';
			break;
			case 2:
				$p='01000';
			break;
			case 3:
				$p='00100';
			break;
			case 4:
				$p='00010';
			break;
			case 5:
				$p='00001';
			break;
		}
		
		// Création d'un client web socket et connexion au serveur
		$client = new WebsocketClient;
		$client->connect('172.17.50.155', 9300, '/');
		// Renvoi # et l'adresse Mac de la multiprise modifiée
		//$client->sendData("#$Mac$p");
	
		return "Programmation de la prise";
	}
	catch (Exception $a){
		die ('Erreur:'.$a->getMessage());
	}
}


/**
 * Fonction permettant le renvoi les heures plannifiees
 * $Mac est un string, l'adresse mac de la multiprise du client 
 * $N_prise est un int, le num de la prise qui se modifie
 * $Nb_Ephe est un int, le num du slot qui se modifie
 * Return string, l'etat des prises sont renvoyés au client
 */
function Etat_courant_ephe($Mac,$N_Prise, $Nb_Ephe){
	//appel de la BDD
	Base_de_donnees();
	try{
		$ephe='Nb_Ephe_Prise'.$N_prise;
		$prise='Prise'.$N_prise.'_E'.$Nb_Ephe;	
		// Requete sql pour récuperer les états des prises
		$requete= mysql_query("SELECT * FROM programmation WHERE Mac='$Mac' AND $ephe='$Nb_Ephe'");
		// Vérification du contenu de la requete
		if(mysql_num_rows($requete)==0)
		{
			return "Adresse mac inexistante";
		}
		else
		{
			$slot1='Prise'.$N_prise.'_E1';
			$slot2='prise'.$N_prise.'_E2';
			$slot3='prise'.$N_prise.'_E3';
			
			switch($Nb_Ephe){
			case 1:
				while ($row = mysql_fetch_assoc($requete)) {$resultat.=$row[$slot1];}
			break;
			case 2:
				while ($row = mysql_fetch_assoc($requete)) {$resultat.=$row[$slot2];}
			break;
			case 3:
				while ($row = mysql_fetch_assoc($requete)) {$resultat.=$row[$slot3];}
			break;
			}
			return "$resultat";		
		}
	}
	catch (Exception $a){
		die ('Erreur:'.$a->getMessage());
	}
}



// Désactivation du cache WSDL
ini_set("soap.wsdl_cache_enabled", "0"); 

// Catch l'erreur si l'instanciation la classe SoapServer échoue, on retourne l'erreur
try {
	// APPEL DE LA WSDL
	$server = new SoapServer('wsdl.wsdl');
  
	// Les méthodes que le serveur va gérer
	$server->addFunction("Modification");
	$server->addFunction("Authentification");
	$server->addFunction("Mot_de_passe");
	$server->addFunction("Etat_courant");
	$server->addFunction("Ephemeride");
	$server->addFunction("Etat_courant_ephe");
	}
catch (Exception $e){
	echo 'erreur'.$e;
}

// Si l'appel provient d'une requête POST (Web Service)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // On lance le serveur SOAP
 $server->handle();
}
 
else {
//Print("Nous sommes le $date et il est $heure");
  echo '<ul>';
  echo '<strong>Fonctions du serveur: </strong>';
  echo '<ul>';
  // Affiche les méthodes que le serveur va gérer
  foreach($server->getFunctions() as $func) {
    echo '<li>' , $func , '</li>';
  }
  echo '</ul>';
}

?>