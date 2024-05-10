<?php
include("./include/connexionBdd.php");

// Initialisation de $RESULT à une valeur par défaut
$RESULT = null;

// Traitement du formulaire de filtre
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $filterDate = $_POST["filterDate"];
    $filterHeureDebut = isset($_POST["filterHeureDebut"]) ? $_POST["filterHeureDebut"] : null;
    $filterHeureFin = isset($_POST["filterHeureFin"]) ? $_POST["filterHeureFin"] : null;
    $filterLieu = isset($_POST["filterLieu"]) ? $_POST["filterLieu"] : null;
    $filterFormation = isset($_POST["filterFormation"]) ? $_POST["filterFormation"] : null;

    // Construction de la requête SQL en fonction des filtres
    $SQL = "SELECT sf.*, f.libelle_form, f.contenu_form
            FROM session_formation sf
            INNER JOIN formation f ON sf.id_form = f.id_form
            WHERE 1"; // Condition toujours vraie pour commencer

    if (!empty($filterDate)) {
        $SQL .= " AND sf.date_session = '$filterDate'";
    }

    if (!empty($filterHeureDebut)) {
        $SQL .= " AND sf.heure_debut = '$filterHeureDebut'";
    }

    if (!empty($filterHeureFin)) {
        $SQL .= " AND sf.heure_fin = '$filterHeureFin'";
    }

    if (!empty($filterLieu)) {
        $SQL .= " AND sf.lieu LIKE '%$filterLieu%'";
    }

    if (!empty($filterFormation)) {
        $SQL .= " AND sf.id_form = :id_form";
    }

    $RESULT = $connexion->prepare($SQL);

    // Liaison du paramètre de filtrage pour la formation
    if (!empty($filterFormation)) {
        $RESULT->bindParam(":id_form", $filterFormation, PDO::PARAM_INT);
    }

    $RESULT->execute();
}

echo "<div class='tables'>";

// Formulaire de filtre
echo "<form method='post' action='".$_SERVER["PHP_SELF"]."'>";
echo "Filtrer par date: <input type='date' name='filterDate'>";
echo "Filtrer par heure début: <input type='time' name='filterHeureDebut'>";
echo "Filtrer par heure fin: <input type='time' name='filterHeureFin'>";
echo "Filtrer par lieu: <input type='text' name='filterLieu'><br>";

// Sélection de la formation
echo "Filtrer par formation: <select name='filterFormation'>";
echo "<option value=''>Toutes les formations</option>";

$SQL_formations = "SELECT id_form, libelle_form FROM formation";
$RESULT_formations = $connexion->query($SQL_formations);

while ($ligne_formation = $RESULT_formations->fetch()) {
    echo "<option value='" . $ligne_formation['id_form'] . "'>" . $ligne_formation['libelle_form'] . "</option>";
}

echo "</select>";

echo "<input type='submit' value='Filtrer'>";
echo "</form>";

// Affichage du tableau
echo "<table>";
echo "<tr><th>Formation</th><th>Date</th><th>Heure début</th><th>Heure fin</th><th>Lieu</th></tr>";

// Utilisez isset pour vérifier si $RESULT est défini
if (isset($RESULT)) {
    while ($ligne = $RESULT->fetch()) {
        echo "
        <tr>
            <td>" . $ligne['libelle_form'] . "<br/>" . $ligne['contenu_form'] . "</td>
            <td>" . $ligne['date_session'] . "</td>
            <td>" . $ligne['heure_debut'] . "</td>
            <td>" . $ligne['heure_fin'] . "</td>
            <td>" . $ligne['lieu'] . "</td>
        </tr>";
    }
}

echo "</table>";
echo "</div>";
?>
