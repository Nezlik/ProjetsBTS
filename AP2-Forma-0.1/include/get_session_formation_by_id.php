<?php

function get_session_formation_by_id($id_form)
{
    include("./include/connexionBdd.php");


    $sql = "SELECT * FROM session_formation";

    // Ajoutez une condition WHERE si l'identifiant de la session est disponible
    if ($id_form) {
        $sql .= " WHERE id_form = :id_form;";
    }

    try {
        // Préparation de la requête SQL
        $resultat_sql = $connexion->prepare($sql);

        // Ajoutez une liaison si l'identifiant de la formation est disponible
        if ($id_form) {
            $resultat_sql->bindParam(':id_form', $id_form, PDO::PARAM_INT);
        }

        // Exécution de la requête SQL
        $resultat_sql->execute();
    } catch (PDOException $e) {
        die("\n Erreur de la requête SQL: " . $e->getMessage());
    }

    return ($resultat_sql);
}
