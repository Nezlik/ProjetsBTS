<?php

function refus_demande(){
    include("../include/connexionBdd.php");
    try {
        $id = $_GET['id'];

        // Supprimer la demande
        $sql = "DELETE FROM demande_inscription WHERE id_utilisateur = '$id'";
        $result = $connexion->query($sql);

        return true;

    } catch (Exception $e) {
        // Handle the exception (error) here
        echo "Error: " . $e->getMessage();
        return false;
    }
}

if (refus_demande()){
    header("Location: ../admin_inscription.php");
} else {
    echo '<script>alert("Le refus a échoué.");</script>';
    header("refresh: 0.2; url=../admin_inscription.php");
}

?>
