<?php

	// Démarrage de la session
	session_start();
	
	// Initialisation des variables de session 'connected' et 'admin' à false
	$_SESSION['connected'] = false;

	// Définition de la fonction 'connecter'
	function connecter(){
		// Inclusion du fichier de connexion à la base de données
		include("../include/connexionBdd.php");

		// Récupération de l'login et hachage du mot de passe saisi
		$login = $_POST['login'];
		$password = $_POST['password'];

		echo $login;
		echo $password;

		$connected = false;

		// Requête SQL pour récupérer un utilisateur avec l'login saisi
		$sql = "SELECT * FROM connexion_utilisateur WHERE login = '$login'";
		$result = $connexion->query($sql);

		// Parcours des résultats de la requête
		while($ligne = $result->fetch()){
			// Vérification du mot de passe saisi avec le mot de passe de l'utilisateur dans la base de données
			if ($ligne['password'] == $password){
				// Si les mots de passe correspondent, définir 'connected' à true dans la session
				$_SESSION['connected'] = true;
				$_SESSION['id_utilisateur'] = $ligne["id_utilisateur"];
				
				// Vérification si l'utilisateur est un administrateur
				$sql = "SELECT * FROM utilisateur WHERE id_utilisateur = " . $ligne["id_utilisateur"];
				$result = $connexion->query($sql);
				$_SESSION['statut'] = $result->fetch()["id_statut"];

				$connected = true;
			}
		}
		// Fermeture de la connexion à la base de données
		$connexion = NULL;

		// Retourne l'état de connexion (true si l'authentification a réussi, sinon false)
		return $connected;
	}

	// Appel de la fonction 'connecter' pour tenter l'authentification
	if (connecter()){
				// Redirection vers une autre page (index.php)
				header("refresh: 0.2; url=../index.php");
	}
	else{
		// Affiche un message d'erreur en utilisant JavaScript pour un pop-up
		echo '<script>alert("L\'authentification a échoué. Veuillez vérifier vos identifiants.");</script>';

		//Redirection vers une autre page (connexionUtilisateur.php)
		header("refresh: 0.2; url=../connexion_utilisateur.php");
	}

?>
