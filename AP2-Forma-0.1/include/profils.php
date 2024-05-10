<?php

$id_utilisateur = $_SESSION['id_utilisateur'];

// Requête pour récupérer les informations de l'utilisateur
$sql_user = "SELECT * FROM utilisateur WHERE id_utilisateur = $id_utilisateur";
$result_user = $connexion->query($sql_user);
$user_data = $result_user->fetch();

// Requête pour récupérer les formations auxquelles l'utilisateur est inscrit
$sql_inscriptions = "SELECT f.* FROM formation f
                    JOIN inscription i ON f.id_form = i.id_form
                    WHERE i.id_utilisateur = $id_utilisateur";
                    
$result_inscriptions = $connexion->query($sql_inscriptions);

?>