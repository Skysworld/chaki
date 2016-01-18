<?php
/*
 * Fonction getResult sert à addition ou soustraire 2 entiers et retourne le résultat
 * @param $operation Type de l'opération (add/substract)
 * @param $integer1 Entier 1
 * @param $integer2 Entier 2
 * @return $result Résultat de l'opération
 */
 //require "index.html";
 
 
$delai=2; 
header("Refresh: $delai;"); // permet de faire un refresh

// Inclusion de la base de donnée
//require_once('base-de-donnee.php');
 
 //Addition
function add( $integer1, $integer2) {

	$result = $integer1 + $integer2;
	  
	return $result; 
}  

//soustraction
function substract( $integer1, $integer2) {

	$result = $integer1 -$integer2;
	
	return $result; 
} 

//boolean
/*function getResult3($bouboul) {

	if($bouboul = true){
		$result = false;
	}
	else{
		$result = true;  
	}
	
	return $result; 
}*/

// Désactivation du cache WSDL
ini_set("soap.wsdl_cache_enabled", "0");  

 
// Catch l'erreur si l'instanciation la classe SoapServer
// échoue, on retourne l'erreur
try { 
  $server = new SoapServer('operation.wsdl');
  // On ajoute la méthode "getResult" que le serveur va gérer
  $server->addFunction("add"); 
  $server->addFunction("substract");
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