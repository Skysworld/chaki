<?php

//Refresh automatique du serveur
//header("Refresh: 2;"); 

// Librairie pour le client WebSocket
require('lib/class.websocket_client.php');

/**
 * Fonction permettant la connexion à la BDD
 */
function Base_de_donnees(){
	try{

	include('./secure/config.php');
	mysql_connect($SQLhost, $SQLlogin, $SQLpass);
	mysql_select_db($SQLBDD);
	/*
	mysql_connect('localhost', 'root', '');
	mysql_select_db('domotique');
	*/

	//Connexion à my sql
	}catch (Exception $e){
		//En cas d'erreur de connexion
		die('Erreur : '.$e->getMessage());
	}
	
}

/**
 * Fonction permettant l'autentification d'un client 
 * $Identifiant est un string, nom du client
 * $Password est un string, mot de passe du client 	
 * Return les adresses Mac lié au client
 */
function Authentification($Identifiant,$Password){
	//appel de la BDD
	Base_de_donnees();
	try{
		// Requete sql pour récupérer les adresses mac associées à l'identifiant
		$requete = mysql_query("SELECT * FROM client join multiprise ON client.NomClient=multiprise.NomClient WHERE client.NomClient='$Identifiant' AND Password='$Password' ORDER BY Mac");
		// Vérification du contenu de la requete
		if(mysql_num_rows($requete)==0)
		{
			return "Identifiant inconnu";
		}
		else{
			
			while ($row = mysql_fetch_assoc($requete)) {
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
 * Fonction permettant la modification des etats de la multiprise en mode instantane et l'envoi des prises qui ont subit un changement au serveur WS
 * $Identifiant est un string, nom du client
 * $Mac est un string, l'adresse mac de la multiprise du client 
 * $N_Prise est int, le numero de la prise
 * $Etat est un boolean, designe l etat de la prise
 * Return string
 */
 function Modification($Identifiant,$Mac,$N_prise,$Etat) {

	//Appel de la BDD
	Base_de_donnees();
	try{
		$etatbool='EtatBool'.$N_prise;
		$ephem='Nb_Ephe_Prise'.$N_prise;
		// Requete sql pour modifier l'état des prises
		//$reponse=mysql_query("SELECT * FROM client join multiprise ON client.NomClient=multiprise.NomClient WHERE client.NomClient='$Identifiant' AND Mac='$Mac'");
		$requete=mysql_query("SELECT * FROM multiprise WHERE NomClient='$Identifiant' AND Mac='$Mac'");
		if(mysql_num_rows($requete)==0)
		{
			return "Modification non prise en compte";
		}
		else{
			$Ip='172.17.50.156';	
			$reponse= mysql_query("UPDATE multiprise SET $etatbool='$Etat' WHERE Mac='$Mac' AND NomClient='$Identifiant'");
			$modifEphe= mysql_query("UPDATE programmation SET $ephem=0 WHERE Mac='$Mac'");
			
		//	$test=mysql_query("INSERT INTO historique (NomClient, IDWeb) VALUES('nom2', 145)");
			
			//$recuperation = mysql_query("SELECT * FROM multiprise WHERE Mac='$Mac' AND NomClient='$Identifiant'");
			$recuperation = mysql_query("SELECT * FROM multiprise WHERE Mac='$Mac'");
			
			while ($row = mysql_fetch_assoc($recuperation)) {
				$etat1=$row[EtatBool1];
				$etat2=$row[EtatBool2];
				$etat3=$row[EtatBool3];
				$etat4=$row[EtatBool4];
				$etat5=$row[EtatBool5];
				$date_expiration = date("Y-m-d H:i:s",strtotime('+7 day'));
				$histori=mysql_query("INSERT INTO historique (NomClient, Mac, EtatBool1, EtatBool2, EtatBool3, EtatBool4, EtatBool5, DateExpiration) VALUES('$Identifiant','$Mac', $etat1, $etat2, $etat3, $etat4, $etat5, '$date_expiration')");
				
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
				
			// Création d'un client web socket pour une connexion au server
		//	$client = new WebsocketClient;
		//	$client->connect($Ip, 9300, '/');
			// Renvoi # et l'adresse Mac de la multiprise modifiée

		//	$client->sendData("#$Mac$p");
		
		return "$date_expiration";
			//return "Votre prise N°$N_prise est modifiée";
			}
			
		}
		
	}
	catch (Exception $a){
		//En cas d'erreur de connexion
		die ('Erreur:'.$a->getMessage());
	}
}




/**
 * Fonction permettant la modification du mot de passe du client
 * $Identifiant est un string, nom du client
 * $NewPassword est un tring, le nouveau mot de passe du client
 * Return string
 */
function Mot_de_passe($Identifiant,$NewPassword,$Password) {
	//Appel de la BDD
	Base_de_donnees();
	
	try{
	
		define('PREFIXE_SHA1', 'p8%B;Qdf78'); 
		$mdp_sha1 = sha1(PREFIXE_SHA1.$Password);	
		$requete=mysql_query("SELECT * FROM client WHERE NomClient='$Identifiant' AND Password='$mdp_sha1'");
		
		if(mysql_num_rows($requete)==0){
			return "Requete non prise en compte";
		}else{
			$newmdp_sha1 = sha1(PREFIXE_SHA1.$NewPassword);
			$reponse= mysql_query("UPDATE client SET Password='$newmdp_sha1' WHERE NomClient='$Identifiant' AND Password='$mdp_act'");
			return "Mot de passe a bien changé";
		}
		
		
/*		
		$requete=mysql_query("SELECT * FROM client WHERE NomClient='$Identifiant' AND Password='$Password'");
		
		if(mysql_num_rows($requete)==0)
		{
			return "Requete non prise en compte";
		}
		else{
			$reponse= mysql_query("UPDATE client SET Password='$mdp_new' WHERE NomClient='$Identifiant' AND Password='$Password'");
			return "Mot de passe a bien changé";
		}
*/	
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
		$requete= mysql_query("SELECT * FROM multiprise WHERE Mac='$Mac'");
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
 * Fonction permettant de planifier une heure d'allumage et l'envoi des prises qui ont subit un changement au serveur WS
 * $Mac est un string, l'adresse mac de la multiprise du client 
 * $N_prise est un int, le num de la prise qui se modifie
 * $Nb_Ephe est un int, le num du slot qui se modifie
 * $Plannif est un string, le jour et l'heure est 
 */
function Ephemeride($Mac, $N_prise, $Nb_Ephe, $Plannif){
	$Ip='172.17.50.156';
	//appel de la BDD
	Base_de_donnees();
	try{
		$ephe='Nb_Ephe_Prise'.$N_prise;
		$prise='Prise'.$N_prise.'_E'.$Nb_Ephe;	
		
		$requete= mysql_query("SELECT * FROM multiprise WHERE Mac='$Mac'");
		// Vérification du contenu de la requete
		if(mysql_num_rows($requete)==0)
		{
			return "Impossible d'effectuer cette action";
		}
		else{
			$reponse=mysql_query("UPDATE programmation SET $ephe='$Nb_Ephe', $prise='$Plannif' WHERE Mac='$Mac' ");

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
		//	$client = new WebsocketClient;
		//	$client->connect($Ip, 9300, '/');
			// Renvoi # et l'adresse Mac de la multiprise modifiée
		//	$client->sendData("#$Mac$p");
			
			return "Programmation de la prise effectuée";
		}
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
function Etat_courant_ephe($Mac, $N_Prise, $Nb_Ephe){
	//appel de la BDD
	Base_de_donnees();
	try{
		$ephe='Nb_Ephe_Prise'.$N_Prise;
		$prise='Prise'.$N_Prise.'_E'.$Nb_Ephe;	
		// Requete sql pour récuperer les états des prises
		$requete= mysql_query("SELECT * FROM programmation WHERE Mac='$Mac'");
		// Vérification du contenu de la requete
		if(mysql_num_rows($requete)==0)
		{
			return "Impossible d'effectuer cette action";
		}
		else
		{
			switch($Nb_Ephe){
			case 1:
				while ($row = mysql_fetch_assoc($requete)){
					$slot='Prise'.$N_Prise.'_E1';
					$recup=$row[$slot];
				}
			break;
			case 2:
				while ($row = mysql_fetch_assoc($requete)){
					$slot='Prise'.$N_Prise.'_E2';
					$recup=$row[$slot];
				}
			break;
			case 3:
				while ($row = mysql_fetch_assoc($requete)){
					$slot='prise'.$N_Prise.'_E3';
					$recup=$row[$slot];
				}
			break;
			case 4:
				while ($row = mysql_fetch_assoc($requete)){
					$slot='prise'.$N_Prise.'_E4';
					$recup=$row[$slot];
				}
			break;
			case 5:
				while ($row = mysql_fetch_assoc($requete)){
					$slot='prise'.$N_Prise.'_E5';
					$recup=$row[$slot];
				}
			break;
			}
			return "$recup";					
		}
	}
	catch (Exception $a){
		die ('Erreur:'.$a->getMessage());
	}
}


/**
 * Fonction permettant au client de consulter l'historique 
 * $Identifiant est un string, nom du client
 * $Mac est un string, l'adresse mac de la multiprise du client 
 * $N_Prise est int, le numero de la prise
 * $Etat est un boolean, designe l etat de la prise
 * Return string
 */
 function Historique($Mac) {

	//Appel de la BDD
	Base_de_donnees();
	try{

		// Requete sql pour recuperer l'historique
		$delhistorique = mysql_query("DELETE FROM historique WHERE Date >= DateExpiration");
		$requete= mysql_query("SELECT * FROM historique WHERE Mac='$Mac'");
		// Vérification du contenu de la requete
		if(mysql_num_rows($requete)==0)
		{
			return "Il n'y a actuellement pas d'historique";
		}
		else{
			
			while ($row = mysql_fetch_assoc($requete)) {
				$resultat.=($resultat==""?"":"," ).$row['EtatBool1'].$row['EtatBool2'].$row['EtatBool3'].$row['EtatBool4'].$row['EtatBool5'].' '.$row['Date'];
			}
			return $resultat;
		}
	
	}
	catch (Exception $a){
		//En cas d'erreur de connexion
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
	$server->addFunction("Historique");
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