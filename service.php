<?php

$wsdl = file_get_contents('http://172.17.50.155/WebService/Addition.php?wsdl');
file_put_contents("Addition2.wsdl",$wsdl); //write the wsdl to a file
$service = SCA::getService('Addition2.wsdl'); //Obtient un proxy pour un service

?>