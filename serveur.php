<?php

// permet de faire un refresh automatique
header("Refresh: 2;"); 

function base_de_donnee(){
	try{
		//Connexion à my sql
		mysql_connect("localhost", "root", "");
		mysql_select_db("domotique");
	}catch (Exception $e){
		//En cas d'erreur de connexion
		die('Erreur : '.$e->getMessage());
	}
}

function authentification($Id,$Password){
	//appel a la fonction de base de donnee
	base_de_donnee();
	try{
		// traitement d'une requete sql
		$reponse2 = mysql_query("SELECT Mac FROM identifiant join prise ON identifiant.Identi=prise.Identity WHERE Identi='$Id' AND Password='$Password' AND IDWeb=1 ");
		if(mysql_num_rows($reponse)==0)
		{
			return '';
		}
		else{				
			while($row=mysql_fetch_assoc($reponse2)){
			return $row[0];
			}
		}
		
	}catch (Exception $a){
		die ('Erreur:'.$a->getMessage());
	}
}
function authentification2($Id,$Password){
	//appel a la fonction de base de donnee
	base_de_donnee();
	try{
		// traitement d'une requete sql
		$reponse1 = mysql_query("SELECT Mac FROM identifiant join prise ON identifiant.Identi=prise.Identity WHERE Identi='$Id' AND Password='$Password' AND IDWeb=2 ");

		if(mysql_num_rows($reponse1)==0 AND mysql_num_rows($reponse2)==0)
		{
			return '';
		}
		else{
			while($row=mysql_fetch_assoc($reponse1)){
			return $row[Mac];	
			}
		}
	}catch (Exception $a){
		die ('Erreur:'.$a->getMessage());
	}
}

function modification($Identifiant,$Mac,$Broche) {
	//appel a la fonction de base de donnee
	base_de_donnee();

	try{
	//$requete = $bdd->query("INSERT INTO prise(Identifiant,Mac, EtatBool1, EtatBool2, EtatBool3,EtatBool4, EtatBool5, date) Value('$Identifiant','$Mac','$Broche[0]','$Broche[1]','$Broche[2]','$Broche[3]','$Broche[4]')");
	$requete= mysql_query("UPDATE prise SET EtatBool1='$Broche[0]', EtatBool2='$Broche[1]', EtatBool3='$Broche[2]', EtatBool4='$Broche[3]', EtatBool5='$Broche[4]' WHERE Mac='$Mac' AND Identity='$Identifiant'");
	return 'Infos ajoutees';
	//return $Broche[1];
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
  // On ajoute les méthodes que le serveur va gérer
  $server->addFunction("modification"); 
  $server->addFunction("authentification"); 
  $server->addFunction("base_de_donnee");
}catch (Exception $e){
  echo 'erreur'.$e;
}

// Si l'appel provient d'une requête POST (Web Service)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // On lance le serveur SOAP
  $server->handle();
}
else {
  echo '<strong>Fonctions du serveur: </strong>';
  echo '<ul>';
  foreach($server->getFunctions() as $func) {
    echo '<li>' , $func , '</li>';
  }
  echo '</ul>';
}
?>