<?php

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

	}catch (Exception $e){
		//En cas d'erreur de connexion
		die('Erreur : '.$e->getMessage());
	}
}

/**
 * Fonction permettant l'accès à l'espace personnel d'un client 
 * $Identifiant est un string, nom du client
 * $Password est un string, mot de passe du client 	
 * Return $resultat string, renvoi les adresses Mac lié au client
 */
function Authentification($Identifiant,$Password){
	//appel de la BDD
	Base_de_donnees();
	try{
		// Codage du mdp en sha1
		$mdp_sha1 = sha1($Password);
		
		// Requete sql pour récupérer les adresses mac associées à l'identifiant en comparant l'empreinte des mots de passe 
		$requete = mysql_query("SELECT * FROM client join multiprise ON client.NomClient=multiprise.NomClient WHERE client.NomClient='$Identifiant' AND Password='$mdp_sha1' ORDER BY Mac");
		// Vérification du contenu de la requete
		if(mysql_num_rows($requete)==0)
		{
			return "Identifiant inconnu";
		}
		else{
			//concaténation des adresses Mac lié au client
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
 * Fonction permettant la modification des etats de la multiprise en mode instantane 
 * Connexion au serveur WS
 * Enregistrement des modification dans l 'historique
 * $Identifiant est un string, nom du client
 * $Mac est un string, l'adresse mac de la multiprise du client 
 * $N_Prise est int, le numero de la prise
 * $Etat est un boolean, designe l etat de la prise
 * Return $resultat string, renvoi confirmation ou echec
 */
 function Modification($Identifiant,$Mac,$N_prise,$Etat) {

	//Appel de la BDD
	Base_de_donnees();
	try{
		$etatbool='EtatBool'.$N_prise;
		$ephem='Nb_Ephe_Prise'.$N_prise;
		// Requete sql qui selectionne la ligne en fonction de l'adresse mac et le nom du client associé
		$requete=mysql_query("SELECT * FROM multiprise WHERE NomClient='$Identifiant' AND Mac='$Mac'");
		
		// Vérification du contenu de la requete		
		if(mysql_num_rows($requete)==0)
		{
			return "Modification non prise en compte";
		}
		else{
			//Adresse IP du serveur WS	
			$Ip='172.17.50.152';
			//Requetes permetant la réecriture dans la BDD
			$reponse= mysql_query("UPDATE multiprise SET $etatbool='$Etat' WHERE Mac='$Mac' AND NomClient='$Identifiant'");
			$modifEphe= mysql_query("UPDATE programmation SET $ephem=0 WHERE Mac='$Mac'");		
			$recuperation = mysql_query("SELECT * FROM multiprise WHERE Mac='$Mac'");
			
			while ($row = mysql_fetch_assoc($recuperation)) {
				$etat1=$row[EtatBool1];
				$etat2=$row[EtatBool2];
				$etat3=$row[EtatBool3];
				$etat4=$row[EtatBool4];
				$etat5=$row[EtatBool5];
				//date du jour avancé à 7 jours
				$date_expiration = date("Y-m-d H:i:s",strtotime('+7 day'));
				//Enregistrement de l'historique dans la BDD
				$histori=mysql_query("INSERT INTO historique (NomClient, Mac, EtatBool1, EtatBool2, EtatBool3, EtatBool4, EtatBool5, DateExpiration) VALUES('$Identifiant','$Mac', $etat1, $etat2, $etat3, $etat4, $etat5, '$date_expiration')");
				
				//Le prise ayant subit une modification prend la valeur 1
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
				$client = new WebsocketClient;
				$client->connect($Ip, 9300, '/');
				// Renvoi "#" + l'adresse Mac + la prise qui a subbit le changement
				$client->sendData("#$Mac$p");
		
				return "Votre prise N°$N_prise a été modifiée ";
			}
		}
	}
	catch (Exception $a){
		//En cas d'erreur de connexion
		die ('Erreur:'.$a->getMessage());
	}
}




/**
 * Fonction permettant de changer le mot de passe du client
 * $Identifiant est un string, nom du client
 * $NewPassword est un string, le nouveau mot de passe du client
 * $Password est un string, il s'agit du MDP qui est a servit à la connexion à l'espace personnel
 * Return $resultat string, renvoi confirmation ou echec
 */
function Mot_de_passe($Identifiant,$NewPassword,$Password) {
	//Appel de la BDD
	Base_de_donnees();
	
	try{
		//Cryptage des mots de passe en sha1
		$mdp_sha1 = sha1($Password);
		$New_mdp_sha1 = sha1($NewPassword);
		
		//Requete sql qui selectionne tout en fonction du nom du client et du mot de passe courant
		$requete=mysql_query("SELECT * FROM client WHERE NomClient='$Identifiant' AND Password='$mdp_sha1'");
	
		// Vérification du contenu de la requete			
		if(mysql_num_rows($requete)==0)
		{
			return "Requete non prise en compte";
		}
		else{
			//Requete permetant de mettre a jour le mot de passe
			$reponse= mysql_query("UPDATE client SET Password='$New_mdp_sha1' WHERE NomClient='$Identifiant' AND Password='$mdp_sha1'");
			return "Mot de passe a bien changé";
		}
	}
	catch (Exception $a){
		//En cas d'erreur de connexion
		die ('Erreur:'.$a->getMessage());
	}
}

/**
 * Fonction permettant de modifier le mot de passe présent en sha1 dans la BDD
 * $Identifiant est un string, nom du client
 * $NewPassword est un tring, le nouveau mot de passe du client
 * $Password est un string, il s'agit du MDP qui est a servit à la connexion à l'espace personnel
 * Return $resultat string, renvoi confirmation ou echec
 */
function Reinitialisation($Identifiant,$NewPassword,$Password) {
	//Appel de la BDD
	Base_de_donnees();
	
	try{
		//Cryptage des mots de passe en sha1
		$mdp_sha1 = sha1($Password);
		
		//Requete sql qui selectionne tout en fonction du nom du client et du mot de passe courant
		$requete=mysql_query("SELECT * FROM client WHERE NomClient='$Identifiant' AND Password='$Password'");
		
		// Vérification du contenu de la requete	
		if(mysql_num_rows($requete)==0)
		{
			return "Requete non prise en compte";
		}
		else{
			//Requete permetant de mettre a jour le mot de passe
			$reponse= mysql_query("UPDATE client SET Password='$mdp_sha1' WHERE NomClient='$Identifiant' AND Password='$Password'");
			return "Mot de passe a bien changé";
		}
	}
	catch (Exception $a){
		//En cas d'erreur de connexion
		die ('Erreur:'.$a->getMessage());
	}
}



/**
 * Fonction permettant le renvoi des états actuels des prises
 * $Mac est un string, l'adresse mac de la multiprise du client 
 * Return $resultat string, renvoi confirmation ou echec
 */
function Etat_courant($Mac){

	//appel de la BDD
	Base_de_donnees();
	try{
		// Requete sql associe le client avec l'adresse mac 
		$requete= mysql_query("SELECT * FROM multiprise WHERE Mac='$Mac'");
		// Vérification du contenu de la requete
		if(mysql_num_rows($requete)==0)
		{
			return "Adresse mac inexistante";
		}
		else
		{
			//concaténation des états avant leurs renvoi 
			while ($row = mysql_fetch_assoc($requete)) {
				$resultat.=$row['EtatBool1'].$row['EtatBool2'].$row['EtatBool3'].$row['EtatBool4'].$row['EtatBool5']; 
			}
			return "$resultat";		
		}
	}
	catch (Exception $a){
		//En cas d'erreur de connexion		
		die ('Erreur:'.$a->getMessage());
	}
}


/**
 * Fonction permettant la planification horaire 
 * $Mac est un string, l'adresse mac de la multiprise du client 
 * $N_prise est un int, le numéro de la prise qui se modifie
 * $Nb_Ephe est un int, le nombre d'éphémeride
 * $Plannif est un string, il s'agit du jouer et l'heure planifié pour un changement d'etat 
 * Return $resultat string, renvoi confirmation ou echec
 */
function Ephemeride($Mac, $N_prise, $Nb_Ephe, $Plannif){
	//Adresse IP du serveur WS
	$Ip='172.17.50.152';
	
	//appel de la BDD
	Base_de_donnees();
	
	try{
		$ephe='Nb_Ephe_Prise'.$N_prise;
		$prise='Prise'.$N_prise.'_E'.$Nb_Ephe;	
		// Requete sql qui selectionne la ligne en fonction de l'adresse mac
		$requete= mysql_query("SELECT * FROM multiprise WHERE Mac='$Mac'");
		
		// Vérification du contenu de la requete
		if(mysql_num_rows($requete)==0)
		{
			return "Impossible d'effectuer cette action";
		}
		else{
			//requete permettant la mise a jour de la table programmation contenant les données de la planification
			$reponse=mysql_query("UPDATE programmation SET $ephe='$Nb_Ephe', $prise='$Plannif' WHERE Mac='$Mac' ");
			
			//Le prise ayant subit une planification horaire prend la valeur 1
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
			$client->connect($Ip, 9300, '/');
			// Renvoi "#" + l'adresse Mac + la prise qui a subbit le changement
			$client->sendData("#$Mac$p");
			
			return "Programmation de la prise effectuée";
		}
	}
	catch (Exception $a){
		//En cas d'erreur de connexion		
		die ('Erreur:'.$a->getMessage());
	}
}


/**
 * Fonction permettant le renvoi des heures plannifiees
 * $Mac est un string, l'adresse mac de la multiprise du client 
 * $N_prise est un int, le numéro de la prise qui se modifie
 * $Nb_Ephe est un int, le nombre d'éphémeride
 * Return $resultat string, renvoi confirmation ou echec
 */
function Etat_courant_ephe($Mac, $N_Prise, $Nb_Ephe){
	//appel de la BDD
	Base_de_donnees();
	
	try{
		$ephe='Nb_Ephe_Prise'.$N_Prise;
		$prise='Prise'.$N_Prise.'_E'.$Nb_Ephe;	
		// Requete sql qui selectionne la ligne en fonction de l'adresse mac
		$requete= mysql_query("SELECT * FROM programmation WHERE Mac='$Mac'");
		
		// Vérification du contenu de la requete
		if(mysql_num_rows($requete)==0)
		{
			return "Impossible d'effectuer cette action";
		}
		else
		{
			//changement de case en fonction du nombre de l'ephemeride que le client choisi
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
		//En cas d'erreur de connexion	
		die ('Erreur:'.$a->getMessage());
	}
}


/**
 * Fonction permettant au client de consulter l'historique 
 * $Mac est un string, l'adresse mac de la multiprise du client 
 * Return $resultat string, renvoi confirmation ou echec
 */
 function Historique($Mac) {

	//Appel de la BDD
	Base_de_donnees();
	try{

		//requete qui efface l'historique datant de plus de 7 jours
		$delhistorique = mysql_query("DELETE FROM historique WHERE Date >= DateExpiration");
		// Requete sql pour recuperer l'historique
		$requete= mysql_query("SELECT * FROM historique WHERE Mac='$Mac'");
		// Vérification du contenu de la requete
		if(mysql_num_rows($requete)==0)
		{
			return "Il n'y a actuellement pas d'historique";
		}
		else{
			//concaténation des etats des prises avec sa date du changement  
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
	// Appel de la wsdl
	$server = new SoapServer('GetServerService.wsdl');
  
	// Les méthodes que le serveur va gérer
	$server->addFunction("Modification");
	$server->addFunction("Authentification");
	$server->addFunction("Mot_de_passe");
	$server->addFunction("Reinitialisation");
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
$date = date("d-m-Y");
$heure = date("H:i");
Print("Nous sommes le $date et il est $heure");
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