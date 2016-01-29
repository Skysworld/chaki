<?php
/*
 * @param $operation Type de l'opération (add/substract)
 * @param $bouboul boolean
 * @return $resultat Résultat de l'opération
 */
 
 
$delai=2; 
header("Refresh: $delai;"); // permet de faire un refresh

//boolean

function etat($Prise,$Branche,$Modif) {

	if($Prise == 1){
		
		if($Branche == 1){
			if($Modif == true){
				$resultat = false; //1=>0
				return $resultat;
			}
			else{
				$resultat == false; //0=>0
				return $resultat;
			}
		}
		
		if($Branche == 2){
			if($Modif == true){
				$resultat = true; //1=>1
				return $resultat;
			}
			else{
				$resultat = false; //0=>0
				return $resultat;
			}
		}

	}
//prise 2
	if($Prise == 2){
		
		if($Branche == 1){
			if($Modif == true){
				$resultat = false; //1=>0
				return $resultat;
			}
			else{
				$resultat = true; //0=>1
				return $resultat;
			}
		}
		
		if($Branche == 2){
			if($Modif == true){
				$resultat = true; //1=>1 
				return $resultat;
			}
			else{
				$resultat == true; //0=>1
				return $resultat;
			}
		}

	}	

}
/*
	$Prise= array ('etat1'=>,'etat2','etat3','etat4','etat5'); //numero de la prise
	$Branche[j]=0; //numero de la prise
	$Modif=false; //etat de la Broche
	if($Prise[i]==1){
		if($Broche[i]==changed){
			
			if($Modif == false){
				$result = false;
				$i=i+1;
			}
			else{
				$result = true;  //udp
				$i=i+1;
			}
			return $result; 
		}
	}
}*/

//BASE DE DONNEE
//require_once("Base.php");
// FIN BASE DE DONNEE


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