<?php
//header("Refresh: 2;"); 
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

require('lib/class.websocket_client.php');

$client = new WebsocketClient;
//creation du client ws
$client->connect('172.17.50.155', 9300, '/');

$data='#01:00:5E:CC:38:S1';
$client->sendData($data);

?>
