<?php
session_start();
include("./connexionBdd.php");

$id_form = $_GET['id'];
$id_utilisateur = $_SESSION["id_utilisateur"];

// Obtenez la date actuelle au format 'YYYY-MM-DD'
$date_actuelle = date('Y-m-d');

// Utilisez une requête préparée pour éviter les injections SQL
$sql = "INSERT INTO inscription VALUES (?, ?, ?, 'ok')";
$prepared_query = $connexion->prepare($sql);

// Vérifiez si la préparation de la requête a réussi
if ($prepared_query) {
    try {
        // Liez les paramètres et exécutez la requête
        $prepared_query->bindParam(1, $id_utilisateur, PDO::PARAM_INT);
        $prepared_query->bindParam(2, $id_form, PDO::PARAM_INT);
        $prepared_query->bindParam(3, $date_actuelle, PDO::PARAM_STR);
        $prepared_query->execute();

        // Vérifiez le succès de l'insertion
        if ($prepared_query->rowCount() > 0) {
            echo "Inscription réussie!";
        } else {
            echo "Échec de l'inscription.";
        }
    } catch (PDOException $e) {
        echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
    } finally {
        // Fermez la déclaration
        $prepared_query = null;
    }
} else {
    echo "Erreur lors de la préparation de la requête.";
}

// Fermez la connexion à la base de données
$connexion = null;

// Redirigez l'utilisateur vers la page de détails de la formation
header("Location: ../formations.php");

?>

