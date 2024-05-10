<?php

include("./include/connexionBdd.php");

$SQL = "SELECT f.*, COUNT(i.id_utilisateur) AS nb_inscriptions FROM formation f
        LEFT JOIN session_formation sf ON f.id_form = sf.id_form
        LEFT JOIN inscription i ON f.id_form = i.id_form
        GROUP BY f.id_form";

$RESULT = $connexion->query($SQL);

echo "<div class='tables'>";
echo "<table>";
echo "<tr><th>Formation</th><th>Contenu</th><th>Places disponibles</th><th>Tarif</th></tr>";

while ($ligne = $RESULT->fetch()) {
    echo "
    <tr>
        <td>" . $ligne['libelle_form'] . "</td>
        <td>" . $ligne['contenu_form'] . "</td>
        <td>" . ($ligne['nb_max'] - $ligne['nb_inscriptions']) . "</td>
        <td>" . $ligne['prix'] . "€</td>
    </tr>";
}

echo "</table>";
echo "</div>";

?>
