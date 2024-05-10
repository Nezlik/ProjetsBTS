<?php

include("./include/connexionBdd.php");

// Fonction pour vérifier le nombre d'inscriptions
function verifNombreInscriptions($id_utilisateur) {
    global $connexion;

    // Requête pour compter le nombre d'inscriptions de l'utilisateur
    $sql = "SELECT COUNT(*) as nb_inscriptions FROM inscription WHERE id_utilisateur = :id_utilisateur";

    // Préparation de la requête
    $requete = $connexion->prepare($sql);

    // Liaison des paramètres
    $requete->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);

    // Exécution de la requête
    if ($requete->execute()) {
        // Récupérer le résultat
        $row = $requete->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Récupérer le nombre d'inscriptions
            $nb_inscriptions = $row['nb_inscriptions'];

            // Retourner vrai si le nombre d'inscriptions est supérieur ou égal à 3
            return $nb_inscriptions >= 3;
        } else {
            echo "Aucun résultat trouvé.";
        }
    } else {
        echo "Erreur d'exécution de la requête : " . $requete->errorInfo()[2];
    }

    // $connexion = null;
}
?>
