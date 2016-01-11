<?php
//require_once "phpwsdl\class.phpwsdl.php";
//PhpWsdl::RunQuickMode();
class addition{
	public function somme($x,$y){
		return $x+$y; 	
	}
}
$options= array( 
	'location' => 'http://172.17.50.155/chaki/Addition.php', //localhost
	'uri'=> 'http://172.17.50.155/chaki/' //adresse
);

//service
$server = new SoapServer(Null,$options); //start server
//$soap_server -> setFunction('somme'); //assignement de la fonction
$server->setClass('addition');
$server->handle();
echo "<script>alert(\"le programme ne comporte pas d'erreur\")</script>"; 
?>