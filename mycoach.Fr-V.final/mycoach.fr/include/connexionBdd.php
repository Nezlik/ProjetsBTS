<?php
	// D�finitions de constantes pour la connexion � MySQL
	$hote="localhost";
	$login="root";
	$mdp="";
	$nombd="mycoach";

	// Connection au serveur
	try {
			$connexion = new PDO ("mysql:host=$hote;dbname=$nombd",$login,$mdp);
	} catch ( Exception $e ) { 
		die ("\n Connexion à '$hote' impossible : ".$e->getMessage());
		  
	}
?>

