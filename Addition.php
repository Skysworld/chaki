<?php
//require_once "nusoap.php";
require_once "class.phpwsdl.php";
PhpWsdl::RunQuickMode();
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
$server = new SoapServer(Null,$options); //start server
//$soap_server -> setFunction('somme'); //assignement de la fonction
$server->setClass('addition');
$server->handle();
?>