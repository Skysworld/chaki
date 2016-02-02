<?php
/*
 * @param $operation Type de l'opération (add/substract)
 * @param $bouboul boolean
 * @return $resultat Résultat de l'opération
 */
 
 
$delai=2; 
header("Refresh: $delai;"); // permet de faire un refresh


//BASE DE DONNEE
//require_once("base.php");
// FIN BASE DE DONNEE

function etat($Identifiant,$Mac,$Broche) {
	try{
		//Connexion à my sql
		$bdd = new PDO('mysql:host=localhost;dbname=domotique', 'root', '');
	}
	catch (Exception $e){
		//En cas d'erreur de connexion
		die('Erreur : '.$e->getMessage());
	}

	$requete = $bdd->query("INSERT INTO prise(Identifiant,Mac, EtatBool1, EtatBool2, EtatBool3,EtatBool4, EtatBool5, date) Value('$Identifiant',Now(),'$Mac','$Broche[0]','$Broche[1]','$Broche[2]','$Broche[3]','$Broche[4]')");
	
	echo 'Infos ajoutées';
	
	mysql_close();
	return $Identifiant;

}


// Désactivation du cache WSDL
ini_set("soap.wsdl_cache_enabled", "0");  

 
// Catch l'erreur si l'instanciation la classe SoapServer
// échoue, on retourne l'erreur
try { 
  $server = new SoapServer('wsdl.wsdl');
  // On ajoute les méthodes que le serveur va gérer
  $server->addFunction("etat"); 

	  
} catch (Exception $e) {
  echo 'erreur'.$e;
}

// Si l'appel provient d'une requête POST (Web Service)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // On lance le serveur SOAP
  $server->handle();
}
else {
  echo '<strong>This SOAP server can handle following functions : </strong>';
  echo '<ul>';
  
  foreach($server->getFunctions() as $func) {
    echo '<li>' , $func , '</li>';
  }

  echo '</ul>';
}


?>