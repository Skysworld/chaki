<?php
$wsdl = file_get_contents('http://172.17.50.155/chaki/Addition.php?wsdl');
file_put_contents("Addition.wsdl",$wsdl); //write the wsdl to a file
$service = SCA::getService('Addition.wsdl'); 
?>