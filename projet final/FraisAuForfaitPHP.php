<?php
// TRAVAIL BATARD !!!
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $periodeEngagement = $_POST["periode_engagement"];
    $repasMidi = $_POST["col1"];
    $nuitée = $_POST["col2"];
    $etape = $_POST["col3"];
    $km = $_POST["col4"];
    $situation = $_POST["col5"];
    $dateOperation = $_POST["col6"];
    $remboursement = $_POST["col7"];
    $dateHors = $_POST["col1_hors"];
    $libelleHors = $_POST["col2_hors"];
    $montantHors = $_POST["col3_hors"];
    $situationHors = $_POST["col4_hors"];
    $dateOperationHors = $_POST["col5_hors"];
    $nombreJustificatif = $_POST["nombre_justificatif"];

    // Connexion à la base de données
    $servername = "localhost";
    $username = "nom_utilisateur";
    $password = "mot_de_passe";
    $dbname = "nom_base_de_donnees";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion à la base de données
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données : " . $conn->connect_error);
    }

    // Préparer et exécuter la requête d'insertion des données
    $sql = "INSERT INTO frais (periode_engagement, repas_midi, nuitée, etape, km, situation, date_operation, remboursement, date_hors, libelle_hors, montant_hors, situation_hors, date_operation_hors, nombre_justificatif)
            VALUES ('$periodeEngagement', '$repasMidi', '$nuitée', '$etape', '$km', '$situation', '$dateOperation', '$remboursement', '$dateHors', '$libelleHors', '$montantHors', '$situationHors', '$dateOperationHors', '$nombreJustificatif')";

    if ($conn->query($sql) === TRUE) {
        echo "Les données ont été insérées avec succès dans la base de données.";
    } else {
        echo "Erreur lors de l'insertion des données : " . $conn->error;
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>
