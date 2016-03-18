<?php
	$delai=2; 
	header("Refresh: $delai;"); // permet de faire un refresh

	// Désactivation du cache WSDL
	ini_set("soap.wsdl_cache_enabled", "0");  

	$options = array('uri'=> 'http://172.17.50.155/SOAP/');
	$client = new SoapClient("wsdl.wsdl"); 
	try {

		print "\n\n "; print"Le premier test faux :";		
		$bouboul  = false; //bool
		echo "$bouboul est devenu ";
		echo $client->etat($bouboul); 
		print "<pre>\n"; 
		  print "Request : $bouboul \n".htmlspecialchars($client->__getLastRequest()) ."\n"; 
		  print "Response: ".htmlspecialchars($client->etat($bouboul))."\n"; 
		print "</pre>"; 
		
		print "\n\n "; print"Le second test vrai :";
		$bouboul2  = true; //bool
		echo " $bouboul2 est devenu ";
		echo $client->etat($bouboul2); 
		print "<pre>\n"; 
		  print "Request : $bouboul2 \n".htmlspecialchars($client->__getLastRequest()) ."\n"; 
		  print "Response: ".htmlspecialchars($client->etat($bouboul2))."\n"; 
		print "</pre>";
		
		print "\n\n "; print"Le troisieme test faux :";		
		$bouboul3  = false; //bool
		echo "$bouboul3 est devenu ";
		echo $client->etat($bouboul3); 
		print "<pre>\n"; 
		  print "Request : $bouboul3 \n".htmlspecialchars($client->__getLastRequest()) ."\n"; 
		  print "Response: ".htmlspecialchars($client->etat($bouboul3))."\n"; 
		print "</pre>"; 
		
		print "\n\n "; print"Le quatrieme test vrai :";
		$bouboul4  = true; //bool
		echo " $bouboul4 est devenu ";
		echo $client->etat($bouboul4); 
		print "<pre>\n"; 
		  print "Request : $bouboul4 \n".htmlspecialchars($client->__getLastRequest()) ."\n"; 
		  print "Response: ".htmlspecialchars($client->etat($bouboul4))."\n"; 
		print "</pre>";
		
		print "\n\n "; print"Le cinquieme test vrai :";
		$bouboul5  = true; //bool
		echo " $bouboul5 est devenu ";
		echo $client->etat($bouboul5); 
		print "<pre>\n"; 
		  print "Request : $bouboul5 \n".htmlspecialchars($client->__getLastRequest()) ."\n"; 
		  print "Response: ".htmlspecialchars($client->etat($bouboul5))."\n"; 
		print "</pre>";
		
	} catch (SoapFault $exception) { 
		echo $exception;       
	} 
?>