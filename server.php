<?php

// permet de faire un refresh automatique
header("Refresh: 2;"); 

$date = date("d-m-Y");
$heure = date("H:i");

//creation du client ws
//$client = new WebSocket('ws://172.17.50.156:9300/');
//$client = new WebSocket('172.17.50.156',9300);

function Base_de_donnee(){
	try{
		//Connexion à my sql
		mysql_connect("localhost", "root", "");
		mysql_select_db("domotique");
	}catch (Exception $e){
		//En cas d'erreur de connexion
		die('Erreur : '.$e->getMessage());
	}
}

function Authentification($Id,$Password){
	//appel a la fonction de base de donnee
	Base_de_donnee();
	try{
		// traitement d'une requete sql
		$reponse = mysql_query("SELECT * FROM identifiant join prise ON identifiant.Identi=prise.Identity WHERE Identi='$Id' AND Password='$Password' ORDER BY Mac");
	
		if(mysql_num_rows($reponse)==0)
		{
			return 'Identifiant inconnu';
		}
		else{
			/*
			$resultat = array();
			while ($row = mysql_fetch_assoc($reponse)) {
			   $resultat[] = $row['Mac'];
			}
			return implode(",",$resultat);
			*/
			
			while ($row = mysql_fetch_assoc($reponse)) { 
				$resultat.=($resultat==""?"":"," ).$row['Mac']; 
			} 
			return $resultat;
			
			/*
			$tableau = array();
			$i = 0;
			while($row=mysql_fetch_assoc($reponse)){
				$tableau[$i]=$row[Mac];
				$i ++;	
			}
			$autre= "$tableau[0],$tableau[1],$tableau[2],$tableau[3],$tableau[4],$tableau[5]" ;
			return $autre;
			*/
		}
		
	}catch (Exception $a){
		die ('Erreur:'.$a->getMessage());
	}
}

function Modification($Identifiant,$Mac,$Broche) {
	//appel a la fonction de base de donnee
	Base_de_donnee();
	try{
	//$requete = $bdd->query("INSERT INTO prise(Identifiant,Mac, EtatBool1, EtatBool2, EtatBool3,EtatBool4, EtatBool5, date) Value('$Identifiant','$Mac','$Broche[0]','$Broche[1]','$Broche[2]','$Broche[3]','$Broche[4]')");
	$requete= mysql_query("UPDATE prise SET EtatBool1='$Broche[0]', EtatBool2='$Broche[1]', EtatBool3='$Broche[2]', EtatBool4='$Broche[3]', EtatBool5='$Broche[4]', heure=NOW() WHERE Mac='$Mac' AND Identity='$Identifiant'");
	return 'Prise ajoutees';
	}
	catch (Exception $a){
		die ('Erreur:'.$a->getMessage());
	}
}

function Mot_de_passe($Id,$NewPassword) {
	//appel a la fonction de base de donnee
	Base_de_donnee();
	try{
	//$requete = $bdd->query("INSERT INTO prise(Identifiant,Mac, EtatBool1, EtatBool2, EtatBool3,EtatBool4, EtatBool5, date) Value('$Identifiant','$Mac','$Broche[0]','$Broche[1]','$Broche[2]','$Broche[3]','$Broche[4]')");
	$requete= mysql_query("UPDATE identifiant SET Password='$NewPassword' WHERE Identi='$Id'");
	return 'Mot de passe change ';
	}
	catch (Exception $a){
		die ('Erreur:'.$a->getMessage());
	}
}

function Horodateur(){
	Base_de_donnee();
	try{
	//$requete = $bdd->query("INSERT INTO prise(Identifiant,Mac, EtatBool1, EtatBool2, EtatBool3,EtatBool4, EtatBool5, date) Value('$Identifiant','$Mac','$Broche[0]','$Broche[1]','$Broche[2]','$Broche[3]','$Broche[4]')");
	$requete= mysql_query("UPDATE identifiant SET Password='$NewPassword' WHERE Identi='$Id'");
	return 'Mot de passe change ';
	}
	catch (Exception $a){
		die ('Erreur:'.$a->getMessage());
	}
}

// Désactivation du cache WSDL
ini_set("soap.wsdl_cache_enabled", "0"); 

// Catch l'erreur si l'instanciation la classe SoapServer
// échoue, on retourne l'erreur
try {
	
// APPEL DE LA WSDL
  $server = new SoapServer('wsdl.wsdl');
  
  // Les méthodes que le serveur va gérer
  $server->addFunction("Modification");
  $server->addFunction("Authentification");
  $server->addFunction("Mot_de_passe");

}catch (Exception $e){
  echo 'erreur'.$e;
}

// Si l'appel provient d'une requête POST (Web Service)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // On lance le serveur SOAP
 $server->handle();
  
  /*
  if ('POST' == $_SERVER['Modification']){
  // Envoi au WS
  WebSocket.send('#'.'Mac');
    WebSocket.onopen = function()
               {
                  // Web Socket is connected, send data using send()
                  ws.send("Message to send");
			   };  
  }		*/	   
}
 
else {
//Print("Nous sommes le $date et il est $heure");
  echo '<ul>';
  echo '<strong>Fonctions du serveur: </strong>';
  echo '<ul>';
  foreach($server->getFunctions() as $func) {
    echo '<li>' , $func , '</li>';
  }
  echo '</ul>';
}

?>