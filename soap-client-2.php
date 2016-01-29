<?php
	$delai=2; 
	header("Refresh: $delai;"); // permet de faire un refresh

	// Désactivation du cache WSDL
	ini_set("soap.wsdl_cache_enabled", "0");  

	$options = array('uri'=> 'http://172.17.50.155/SOAP/');
	$client = new SoapClient("wsdl.wsdl"); 
	try {

		print "\n\n ";	
		//$Prise = array ('br1'=>true,'br2'=>false,'br3'=>false,'br4'=>true,'br5'=>false );
		$Prise = 1; //à remplacer par @mac
		$Branche = 1; //à remplacer par @mac
		$Modif = false;		
		echo "(0-0) La prise $Prise change sa broche $Branche de $Modif en";
		echo $client->etat($Prise, $Branche, $Modif); 
		$client->__getLastResponse(); 
		
			
		print "<br> ";	
		//$Prise = array ('br1'=>true,'br2'=>false,'br3'=>false,'br4'=>true,'br5'=>false );
		$Prise = 1; //à remplacer par @mac
		$Branche = 2; //à remplacer par @mac
		$Modif = true;		
		echo "(1-1)La prise $Prise change sa branche $Branche de $Modif en";
		echo $client->etat($Prise, $Branche, $Modif); 
		echo $client->__getLastResponse(); 

		
		print "<br> ";		
		//$Prise = array ('br1'=>true,'br2'=>false,'br3'=>false,'br4'=>true,'br5'=>false );
		$Prise = 2; //à remplacer par @mac
		$Branche = 1; //à remplacer par @mac
		$Modif = false;	
		echo "(0-1)La prise $Prise change sa branche $Branche de $Modif en ";
		echo $client->etat($Prise, $Branche, $Modif); 
		
		print "<br> ";		
		//$Prise = array ('br1'=>true,'br2'=>false,'br3'=>false,'br4'=>true,'br5'=>false );
		$Prise = 2; //à remplacer par @mac
		$Branche = 2; //à remplacer par @mac
		$Modif = false;	
		echo "(0-1)La prise $Prise change sa branche $Branche de $Modif en ";
		echo $client->etat($Prise, $Branche, $Modif); 
		
		print "<br>";	
		//$Prise = array ('br1'=>true,'br2'=>false,'br3'=>false,'br4'=>true,'br5'=>false );
		$Prise = 1; //à remplacer par @mac
		$Branche = 1; //à remplacer par @mac
		$Modif = true;		
		echo "(1-0)La prise $Prise change sa branche $Branche de $Modif en";
		echo $client->etat($Prise, $Branche, $Modif); 
		
		print "<br> ";	
		//$Prise = array ('br1'=>true,'br2'=>false,'br3'=>false,'br4'=>true,'br5'=>false );
		$Prise = 1; //à remplacer par @mac
		$Branche = 2; //à remplacer par @mac
		$Modif = false;		
		echo "(0-0)La prise $Prise change sa branche $Branche de $Modif en";
		echo $client->etat($Prise, $Branche, $Modif); 
		
		print "<br> ";		
		//$Prise = array ('br1'=>true,'br2'=>false,'br3'=>false,'br4'=>true,'br5'=>false );
		$Prise = 2; //à remplacer par @mac
		$Branche = 1; //à remplacer par @mac
		$Modif = true;		
		echo "(1-0)La prise $Prise change sa branche $Branche de $Modif en";
		echo $client->etat($Prise, $Branche, $Modif); 
		
		print "<br> ";		
		//$Prise = array ('br1'=>true,'br2'=>false,'br3'=>false,'br4'=>true,'br5'=>false );
		$Prise = 2; //à remplacer par @mac
		$Branche =2; //à remplacer par @mac
		$Modif = true;		
		echo "(1-1)La prise $Prise change sa branche $Branche de $Modif en";
		echo $client->etat($Prise, $Branche, $Modif); 
		/*
		
		
		function servir_cafe($types = array("cappuccino"), $coffeeMaker = NULL)
{
    $device = is_null($coffeeMaker) ? "les mains" : $coffeeMaker;
    return "Préparation d'une tasse de ".join(", ", $types)." avec $device.\n";
}
echo servir_cafe();
echo servir_cafe(array("cappuccino", "lavazza"), "une cafetière");
		
		*/
		/*
			$Branche [1]{
				$Modif  = false; //bool
			}	
			$Branche [2]{
				$Modif  = true; //bool
			}
			$Branche [3]{
				$Modif  = true; //bool
			}			
			$Branche [4]{
				$Modif  = false; //bool
			}
			$Branche [5]{
				$Modif  = true; //bool
			}
		);
		
	$Prise [2]
		{
			$Branche[1]{
				$Modif  = true; //bool
			}	
			$Branche[2]{
				$Modif  = false; //bool
			}
			$Branche[3]{
				$Modif  = false; //bool
			}			
			$Branche[4]{
				$Modif  = true; //bool
			}
			$Branche[5]{
				$Modif  = false; //bool
			}
		}		*/
			/*
		echo "$bouboul est devenu  ";
		echo $client->etat($bouboul); 
		print "<pre>\n"; 
		  print "Request : $bouboul \n".htmlspecialchars($client->__getLastRequest()) ."\n"; 
		  print "Response: ".htmlspecialchars($client->etat($bouboul))."\n"; 
		print "</pre>"; 
		*/
		
		
		
		/*
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
		*/
	} catch (SoapFault $exception) { 
		echo $exception;       
	} 
?>