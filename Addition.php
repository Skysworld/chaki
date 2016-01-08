<?php
//require_once "nusoap.php";
require_once "class.phpwsdl.php";

class addition{
	public function somme($x,$y){
		return $x+$y; 	
	}
}
$options= array( 
	//'location' => 'http://localhost/chaki/Addition.php',
	'uri'=> 'http://localhost/chaki/' //adresse
);

//service
$soap_server = new SoapServer(Null,$options); //start server
//$soap_server -> set_function('somme'); //assignement de la fonction
$soap_server->setClass('addition')
$soap_server -> handle();
?>


