<?php

$hote="localhost";
$login= "root";
$mdp = "";
$nombd="bd_forma";

try {

    $connexion = new PDO("mysql:host=$hote;dbname=$nombd;charset:-utf8",$login,$mdp);	
} catch ( Exception $e ) { 
  die("\n Connexion a '$hote' impossible : ".$e->getMessage());
}
?>

