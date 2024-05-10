<?php
include("./connexionBdd.php");

// Vérifie si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupère les données du formulaire
    $libelle = isset($_POST['libelle']) ? $_POST['libelle'] : '';
    $intervenant = isset($_POST['intervenant']) ? $_POST['intervenant'] : '';
    $prix = isset($_POST['prix']) ? $_POST['prix'] : '';
    $nb_max = isset($_POST['nb_max']) ? $_POST['nb_max'] : '';
    $contenu_form = isset($_POST['contenu_form']) ? $_POST['contenu_form'] : '';
    $id_domaine = isset($_POST['id_domaine']) ? $_POST['id_domaine'] : '';
    $id_form = isset($_POST['id_form']) ? $_POST['id_form'] : '';
    
    // Effectue la mise à jour des données dans la base de données
    $sql = "UPDATE formation SET libelle_form = :libelle, intervenant = :intervenant, prix = :prix, nb_max = :nb_max, contenu_form = :contenu_form, id_domaine = :id_domaine WHERE id_form = :id_form";
    
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':libelle', $libelle);
    $stmt->bindParam(':intervenant', $intervenant);
    $stmt->bindParam(':prix', $prix);
    $stmt->bindParam(':nb_max', $nb_max);
    $stmt->bindParam(':contenu_form', $contenu_form);
    $stmt->bindParam(':id_domaine', $id_domaine);
    $stmt->bindParam(':id_form', $id_form);

    $stmt->execute();

    // Redirection vers la page de liste des formations après la modification
    header('Location: ../tableau_formation_admin.php');
    exit();
} else {
    // Gérer le cas où le formulaire n'est pas soumis, par exemple, rediriger vers une page d'erreur.
    header('Location: ./erreur.php');
    exit();
}
?>
