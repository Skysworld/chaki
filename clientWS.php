<?php
//http://www.phpbuilder.com/articles/application-architecture/optimization/creating-real-time-applications-with-php-and-websockets.html

//ini_set('display_errors', 1);
//error_reporting(E_ALL);
require('class.websocket_client.php');
$socket = new WebSocketClient;
//creation du client ws
$socket->connect('172.17.50.156', 9300,'/');


//http://fr.slideshare.net/auroraeosrose/socket-programming-with-php

function Envoi_Mac(){
	$Mac='#15:15:X7:AA:BB';
	$socket.sendData($Mac);
}

?>
