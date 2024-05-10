<?php

require_once "./connexionBdd.php";
// Vérifie si l'ID de formation est présent dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id_formation = $_GET['id'];

    // Requête SQL pour supprimer la formation avec l'ID spécifié
    $sql = "DELETE FROM formation WHERE id_form = :id_form";

    try {
        // Utilisation d'une requête préparée pour éviter les attaques d'injection SQL
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':id_form', $id_formation, PDO::PARAM_INT);

        // Exécution de la requête
        if($stmt->execute()) {
            // Redirection vers la page principale après la suppression
            header('Location: ../tableau_formation_admin.php');
            exit();
        } else {
            include_once("./db_connection.php");
            
            // Vérifie si l'ID de formation est présent dans l'URL
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $id_formation = $_GET['id'];
            
                // Vérifie si l'utilisateur a confirmé la suppression
                if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
                    // Requête SQL pour supprimer la formation avec l'ID spécifié
                    $sql = "DELETE FROM formation WHERE id_form = :id_form";
            
                    try {
                        // Utilisation d'une requête préparée pour éviter les attaques d'injection SQL
                        $stmt = $connexion->prepare($sql);
                        $stmt->bindParam(':id_form', $id_formation, PDO::PARAM_INT);
            
                        // Exécution de la requête
                        if ($stmt->execute()) {
                            // Redirection vers la page principale après la suppression
                            header('Location: ../tableau_formation_admin.php');
                            exit();
                        } else {
                            // Gestion des erreurs si la suppression échoue
                            echo "Erreur lors de la suppression de la formation.";
                        }
                    } catch (PDOException $e) {
                        // Gestion des erreurs liées à la base de données
                        echo "Erreur de base de données : " . $e->getMessage();
                    }
                } else {
                    // Affiche un message de confirmation avec un lien pour confirmer la suppression
                    echo "Êtes-vous sûr de vouloir supprimer cette formation?";
                    echo "<br>";
                    echo '<a href="supprimer_formation.php?id=' . $id_formation . '&confirm=true">Confirmer la suppression</a>';
                    echo " | ";
                    echo '<a href="liste_formations.php">Annuler</a>';
                }
            } else {
                // Redirection vers la page principale si l'ID de formation n'est pas spécifié
                header('Location: ../tableau_formation_admin.php');
                exit();
            }
            
            // Gestion des erreurs si la suppression échoue
            echo "Erreur lors de la suppression de la formation.";
        }
    } catch (PDOException $e) {
        // Gestion des erreurs liées à la base de données
        echo "Erreur de base de données : " . $e->getMessage();
    }
} else {
    // Redirection vers la page principale si l'ID de formation n'est pas spécifié
    header('Location: ../tableau_formation_admin.php');
    exit();
}
?>
