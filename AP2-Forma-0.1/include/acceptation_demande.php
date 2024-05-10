<?php
function acceptation_demande()
{
    include("../include/connexionBdd.php");

    try {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            throw new InvalidArgumentException("ID invalide.");
        }

        $id = $_GET['id'];

        // Utiliser une requête préparée pour éviter l'injection SQL
        $sqlLastid = "SELECT id_utilisateur FROM utilisateur ORDER BY id_utilisateur DESC LIMIT 1";
        $result = $connexion->query($sqlLastid);
        $row = $result->fetch();

        $id_insert = $row['id_utilisateur'] + 1;

        // Utiliser une requête préparée pour éviter l'injection SQL
        $sql = "SELECT * FROM demande_inscription WHERE id_utilisateur = ?";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        $nom = $row['nom'];
        $prenom = $row['prenom'];
        $email = $row['email'];
        $adresse = $row['adresse'];
        $CP = $row['CP'];
        $ville = $row['ville'];
        $id_association = $row['id_association'];
        $id_statut = $row['id_statut'];

        // Utiliser une transaction
        $connexion->beginTransaction();

        $sql = "INSERT INTO utilisateur (id_utilisateur, nom, prenom, email, adresse, CP, ville, id_association, id_statut) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([$id_insert, $nom, $prenom, $email, $adresse, $CP, $ville, $id_association, $id_statut]);

        $sql = "DELETE FROM demande_inscription WHERE id_utilisateur = ?";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([$id]);

        // Valider la transaction
        $connexion->commit();

        return true;
    } catch (Exception $e) {
        // Annuler la transaction en cas d'erreur
        $connexion->rollBack();

        // Afficher des messages d'erreur informatifs pendant le développement
        echo "Error: " . $e->getMessage();

        return false;
    }
}

if (acceptation_demande()) {
    header("Location: ../admin_inscription.php");
} else {
    echo '<script>alert("L\'acceptation a échoué.");</script>';
    header("refresh: 0.2; url=../admin_inscription.php");
}
