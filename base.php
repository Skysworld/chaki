<?php


	
try
{
	//Connexion à my sql
	$bdd = new PDO('mysql:host=localhost;dbname=domotique', 'root', '');
}
catch (Exception $e)
{
	//En cas d'erreur de connexion
	die('Erreur : '.$e->getMessage());
}


	$requete = $bdd->query("SELECT * FROM Prise WHERE Mac = 'a4:a4:a4:c4:c4'");
	//affichage de chaque entrée
	while ($donnees = $requete->fetch())
	{
?>
	<p>
    <strong>Nom</strong> : <?php echo $donnees['Identifiant']; ?><br />
    L'adresse Mac : <?php echo $donnees['Mac']; ?><br />
    Etat de la 1ere prise :<?php echo $donnees['EtatBool1']; ?><br />
	Etat de la 2eme prise :<?php echo $donnees['EtatBool2']; ?><br />
	Etat de la 3eme prise :<?php echo $donnees['EtatBool3']; ?><br />
	Etat de la 4eme prise :<?php echo $donnees['EtatBool4']; ?><br />
	Etat de la 5eme prise :<?php echo $donnees['EtatBool5']; ?><br />
    
   </p>
   
<?php
	}
	$requete->closeCursor(); // Termine le traitement de la requête
?>




<?php

/*
function insertion()
{
	mysql_select_db($database,$db) or die ('Erreur de selection' .mysql_error());
	
	
	$requete = "INSERT INTO ('','$p')";
	mysql_query($requete) or die('Erreur SQL !'.$sql.'<br>'.mysql_error());
	
	echo 'Les données sont enregistré';		
	
	mysql_close();
}
<em><?php echo $donnees['commentaires']; ?></em>
	*/
?>	




