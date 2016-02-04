<?php
/*
 * @param 
 * @param 
 * @return 
 */
 
 
header("Refresh: 2;"); // permet de faire un refresh


//BASE DE DONNEE
//require_once("base.php");
// FIN BASE DE DONNEE
function authentification($Id,$Password){
	try{
		//Connexion à my sql
		mysql_connect("localhost", "root", "");
		mysql_select_db("domotique");
	}
	catch (Exception $e){
		//En cas d'erreur de connexion
		die('Erreur : '.$e->getMessage());
	}
	
	try{		
		$reponse = mysql_query("SELECT Mac FROM identifiant join prise ON identifiant.Identi=prise.Identity WHERE Identi='$Id' AND Password='$Password'");
		if(mysql_num_rows($reponse)==0)
		{
			return 'Pas de connexion';
		}
		else{
			/*while($row = $reponse->fetch_assoc())
			{
				echo ("Utilisateur $row[Id] as la prise suivante : $row[Mac] <br>");
			}*/
			//return 'connexion reussie';
			while($row=mysql_fetch_assoc($reponse)){
				return $row['Mac'];
			}
		}
	}
	catch (Exception $a){
		die ('Erreur:'.$a->getMessage());
	}
}

function modification($Identifiant,$Mac,$Broche) {
	try{
		//Connexion à my sql
		mysql_connect("localhost", "root", "");
		mysql_select_db("domotique");
	}
	catch (Exception $e){
		//En cas d'erreur de connexion
		die('Erreur : '.$e->getMessage());
	}
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
  $server = new SoapServer('wsdl.wsdl');
  // On ajoute les méthodes que le serveur va gérer
  $server->addFunction("modification"); 
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