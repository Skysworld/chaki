<?php
/*
 * Fonction getResult sert à addition ou soustraire 2 entiers et retourne le résultat
 * @param $operation Type de l'opération (add/substract)
 * @param $integer1 Entier 1
 * @param $integer2 Entier 2
 * @return $result Résultat de l'opération
 */
function getResult($operation, $integer1, $integer2) {
	$result = 0;
	
	if (($operation != "add") && ($operation != "substract")) {
	  return "Veuillez utiliser une methode d'operation valable (add/substract).";
	} 
	if (!$integer1 || !$integer2) {
	  return "Veuillez indiquer 2 entiers.";
	} 
	if ($operation == "add") {
	  $result = $integer1 + $integer2;
	}
	if ($operation == "substract") {
	  $result = $integer1 -$integer2;
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