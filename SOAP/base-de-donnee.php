<?php
	function Connect_db(){
        $host="http://172.17.50.155/operationSOAP/identifiant.sql";
        $user= 'waka';
        $password= 'polo';
        $bdname= '';
        try{
            $bdd = new PDO('mysql:host='.$host.';dbname='.$bdname. ';charset=utf8',$user,$password);
                return $bdd;
        }
        catch(Exception $e)
        {
                die('Erreur: ' .$e->getMessage());
        }
	}

	$bdd = Connect_db();
	$SQL_Query = '';
        $query = $bdd -> prepare($SQL_Query);
        $query -> execute();
?>