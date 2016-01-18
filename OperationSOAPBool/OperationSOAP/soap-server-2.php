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
function getResult($operation, $integer1, $integer2) {
	$result = 0;
	
	if ($operation != "add") {
	  throw new SoapFault("Server", "Veuillez utiliser une methode d'operation valable (add).");
	} 
	if (!$integer1 || !$integer2) {
	  throw new SoapFault("Server", "Veuillez indiquer 2 entiers.");
	} 
	if ($operation == "add") {
	  $result = $integer1 + $integer2;
	}	
	return $result; 
}  

//soustraction
function getResult2($operation, $integer1, $integer2) {
	$result = 0;
	
	if ($operation != "substract") {
	  throw new SoapFault("Server", "Veuillez utiliser une methode d'operation valable (substract).");
	} 
	if (!$integer1 || !$integer2) {
	  throw new SoapFault("Server", "Veuillez indiquer 2 entiers.");
	} 
	if ($operation == "substract") {
	  $result = $integer1 -$integer2;
	}
	return $result; 
} 

//boolean
function getResult3($operation, $bouboul) {
	$result = false;
	
	if ($operation != "etat") {
	  throw new SoapFault("Server", "Veuillez utiliser une methode d'operation valable (etat).");
	} 

	if ($operation == "etat") {
	  if($bouboul = true){
		$result = false;
	  }
	  else{
		$result = true;  
	  }
	}	
	return $result; 
}

// Désactivation du cache WSDL
ini_set("soap.wsdl_cache_enabled", "0");  

 
// Catch l'erreur si l'instanciation la classe SoapServer
// échoue, on retourne l'erreur
try { 
  $server = new SoapServer('operation.wsdl');
  // On ajoute la méthode "getResult" que le serveur va gérer
  $server->addFunction("getResult"); 
  $server->addFunction("getResult2");
  $server->addFunction("getResult3");
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