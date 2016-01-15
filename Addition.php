<?php
	require "index.html";	
	class addition{
		public function somme($x,$y){
			return $x+$y; 	
		}
	}
	
	$options= array( 'location' => 'http://172.17.50.155/WebService/Addition.php', //localhost
					 'uri'=> 'http://172.17.50.155/WebService/' //adresse
	);

	//service
	$server = new SoapServer(Null,$options); //start server
	$server->setClass('addition'); //assignement de la class
	$server->handle();
	echo "<script>alert(\"le programme ne comporte pas d'erreur\")</script>"; 

?>