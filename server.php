<?php
/*
 * @param $operation Type de l'opération (add/substract)
 * @param $bouboul boolean
 * @return $resultat Résultat de l'opération
 */
 
 
header("Refresh: 2;"); // permet de faire un refresh


//BASE DE DONNEE
//require_once("base.php");
// FIN BASE DE DONNEE
function authentification($Id,$Password){
	//if (isset($Id['identifiant']) && isset($Password['motdepasse'])){
		try{
			//Connexion à my sql
			$bdd = new PDO('mysql:host=localhost;dbname=domotique', 'root', '');
		}	
		catch (Exception $e){
			//En cas d'erreur de connexion
			die('Erreur : '.$e->getMessage());
		}
		
		$sql="SELECT Mac FROM identifiant, prise WHERE Identi='$Id' AND Password='$Password' AND identifiant.Identi=prise.Identi";
		//$sql="SELECT Mac FROM identifiant, prise WHERE Identi='$Id' AND Password='$Password' AND Identi.identifiant=Identi.prise";
		//$sql="SELECT Identi FROM identifiant WHERE Identi='$Id' AND Password='$Password' ";
		
		//$requete = $bdd->query("SELECT Identi FROM identifiant WHERE Identi='$Id' AND Password='$Password'");
		$requete = $bdd->query($sql);
		
		if ($requete){
			//echo 'Bien venu $Id';
			//$result=mysql_query($requete);
			//return $result;
			return $Id;
		}
		else{
			//la selection dans la base de donnée se fait bien
			echo 'erreur d identification';

			return $Password;
			//$result=mysql_query($requete);

		}
	

	//}
}

function etat($Identifiant,$Mac,$Broche) {
	try{
		//Connexion à my sql
		$bdd = new PDO('mysql:host=localhost;dbname=domotique', 'root', '');
	}
	catch (Exception $e){
		//En cas d'erreur de connexion
		die('Erreur : '.$e->getMessage());
	}

	$requete = $bdd->query("INSERT INTO prise(Identifiant,Mac, EtatBool1, EtatBool2, EtatBool3,EtatBool4, EtatBool5, date) Value('$Identifiant','$Mac','$Broche[0]','$Broche[1]','$Broche[2]','$Broche[3]','$Broche[4]')");
	
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
  $server->addFunction("authentification"); 

	  
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