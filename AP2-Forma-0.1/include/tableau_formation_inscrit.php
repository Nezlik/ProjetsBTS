<?php

// Remplacez $id_utilisateur par l'ID réel de l'utilisateur
$id_utilisateur = $_SESSION["id_utilisateur"];

// Requête pour récupérer les formations auxquelles l'utilisateur est inscrit
$sql_inscriptions = "SELECT f.*, i.date_inscription
                    FROM formation f
                    JOIN inscription i ON f.id_form = i.id_form
                    WHERE i.id_utilisateur = $id_utilisateur";

$result_inscriptions = $connexion->query($sql_inscriptions);

echo "<div class='conteneur-tableaux'>";
while ($formation = $result_inscriptions->fetch()) {
    echo "
    <table>
        <thead>
            <tr>
                <th>" . $formation['libelle_form'] . "</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    " . $formation['contenu_form'] . "<br/><br/>
                    Date d'inscription: " . $formation['date_inscription'] . "<br/>
                    Tarif: " . $formation['prix'] . "€
                    <div class='bouton-redirection'>
                        <a href='./session_formation.php?id_form=" . $formation['id_form'] . "'>Voir les sessions</a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>";
}

echo "</div>";

?>
