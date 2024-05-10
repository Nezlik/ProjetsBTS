<?php

function get_formation_by_id($id_formation)
{

    include("./include/connexionBdd.php");

    // Requête SQL pour sélectionner les sessions de formation en joignant les tables
    $sqlSessionFormation = "SELECT * FROM formation ";

    // Ajoutez une condition WHERE si l'identifiant de la formation est disponible
    if ($id_formation) {
        $sqlSessionFormation .= " WHERE formation.id_form = :id_formation";
    }

    try {
        // Préparation de la requête SQL
        $resultatSessionFormation = $connexion->prepare($sqlSessionFormation);

        // Ajoutez une liaison si l'identifiant de la formation est disponible
        if ($id_formation) {
            $resultatSessionFormation->bindParam(':id_formation', $id_formation, PDO::PARAM_INT);
        }

        // Exécution de la requête SQL
        $resultatSessionFormation->execute();
    } catch (PDOException $e) {
        die("\n Erreur de la requête SQL: " . $e->getMessage());
    }

    return ($resultatSessionFormation);
}
