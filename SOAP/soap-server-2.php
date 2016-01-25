<?php
/*
 * @param $operation Type de l'opération (add/substract)
 * @param $bouboul boolean
 * @return $resultat Résultat de l'opération
 */
 
 
$delai=2; 
header("Refresh: $delai;"); // permet de faire un refresh

//boolean

function etat($bouboul) {

	if($bouboul == false){
		$result = false;
	}
	else{
		$result = true;  
	}
	return $result; 
}





// Désactivation du cache WSDL
ini_set("soap.wsdl_cache_enabled", "0");  

 
// Catch l'erreur si l'instanciation la classe SoapServer
// échoue, on retourne l'erreur
try { 
  $server = new SoapServer('operation.wsdl');
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