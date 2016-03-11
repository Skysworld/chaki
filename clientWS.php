<?php
//http://www.phpbuilder.com/articles/application-architecture/optimization/creating-real-time-applications-with-php-and-websockets.html

ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once('./class.websocket_client.php');

//creation du client ws
$client = new WebSocket('ws://www.172.17.50.156.com/');
//$client = new WebSocket('ws://172.17.50.156:9300/');
//$client = new WebSocket('172.17.50.156',9300);

$client->connect('172.17.50.156', 9300, '/demo', 'foo.lh');

$mac='#15:15:X7:AA:BB';
 
 WebSocket.onopen = function (event) {      
	//WebSocket.send('#'.$mac);
	WebSocket.sendData($mac);
 }
/* if ('POST' == $_SERVER['Modification']){
  // Envoi au WS
  WebSocket.send('#'.'Mac');
    WebSocket.onopen = function()
               {
                  // Web Socket is connected, send data using send()
                  ws.send("Message to send");
			   };  
  }	
  
  ?>