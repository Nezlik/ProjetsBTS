<?php
include("./connexionBdd.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Récupère les données du formulaire
        $libelle = filter_var($_POST['libelle'], FILTER_SANITIZE_STRING);
        $intervenant = filter_var($_POST['intervenant'], FILTER_SANITIZE_STRING);
        $prix = filter_var($_POST['prix'], FILTER_SANITIZE_NUMBER_FLOAT);
        $nb_max = filter_var($_POST['nb_max'], FILTER_SANITIZE_NUMBER_INT);
        $contenue_form = filter_var($_POST['contenue_form'], FILTER_SANITIZE_STRING);
        $id_domaine = filter_var($_POST['id_domaine'], FILTER_SANITIZE_NUMBER_INT);

        // Obtenir le dernier ID existant dans la table formation
        $sqlLastId = "SELECT MAX(id_form) AS last_id FROM formation";
        $lastIdResult = $connexion->query($sqlLastId);
        $lastInsertedId = $lastIdResult->fetch(PDO::FETCH_ASSOC)['last_id'];
        $newId = $lastInsertedId + 1;

        // Effectue l'insertion des données dans la base de données avec le nouvel ID
        $sqlInsertFormation = "INSERT INTO formation (id_form, libelle_form, intervenant, prix, nb_max, contenu_form, id_domaine) 
                               VALUES (:newId, :libelle, :intervenant, :prix, :nb_max, :contenu_form, :id_domaine)";

        $stmtInsertFormation = $connexion->prepare($sqlInsertFormation);
        $stmtInsertFormation->bindParam(':newId', $newId);
        $stmtInsertFormation->bindParam(':libelle', $libelle);
        $stmtInsertFormation->bindParam(':intervenant', $intervenant);
        $stmtInsertFormation->bindParam(':prix', $prix);
        $stmtInsertFormation->bindParam(':nb_max', $nb_max);
        $stmtInsertFormation->bindParam(':contenu_form', $contenue_form);
        $stmtInsertFormation->bindParam(':id_domaine', $id_domaine);

        $stmtInsertFormation->execute();

        // Redirection vers la page de liste des formations après l'ajout
        header("Location: ../tableau_formation_admin.php?id=$newId");
        exit();
    } catch (PDOException $e) {
        // Gestion des erreurs PDO
        echo "Erreur d'insertion : " . $e->getMessage();
        // Vous pouvez rediriger vers une page d'erreur ou afficher un message adapté à l'utilisateur
    } catch (Exception $e) {
        // Gestion des autres erreurs
        echo "Erreur : " . $e->getMessage();
    }
}
?>
