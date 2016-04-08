<?php

	ini_set("soap.wsdl_cache_enabled", "0");

	$options = array('uri'=> 'http://localhost/webservice/project/');
	$client = new SoapClient("../wsdl.wsdl"); 

	try{
		$Mac=$_POST['trouve'];
		$N_prise=1;
		$Etat=$_POST['prise1'];
		echo $client->Modification($Mac,$N_prise,$Etat); 
		$N_prise=2;
		$Etat=$_POST['prise2'];
		echo $client->Modification($Mac,$N_prise,$Etat); 
		$N_prise=3;
		$Etat=$_POST['prise3'];
		echo $client->Modification($Mac,$N_prise,$Etat); 
		$N_prise=4;
		$Etat=$_POST['prise4'];
		echo $client->Modification($Mac,$N_prise,$Etat); 
		$N_prise=5;
		$Etat=$_POST['prise5'];
		echo $client->Modification($Mac,$N_prise,$Etat);	

		echo "</br>La modification de $Mac a ete prise en compte </br>";
		?>
		</br></br>
	<INPUT type="button" value="Revenir a la page principale" onClick="window.history.back()">
		<?php
	} catch (SoapFault $exception) { 
		echo $exception;       
	}		
		?>