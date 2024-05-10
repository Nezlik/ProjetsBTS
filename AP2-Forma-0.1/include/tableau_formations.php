<?php

// Remplacez $id_utilisateur par l'ID réel de l'utilisateur
$id_utilisateur = $_SESSION["id_utilisateur"];

$SQL = "SELECT f.*, COUNT(i.id_utilisateur) AS nb_inscriptions FROM formation f
        LEFT JOIN session_formation sf ON f.id_form = sf.id_form
        LEFT JOIN inscription i ON f.id_form = i.id_form
        WHERE NOT EXISTS (
            SELECT 1 FROM inscription ins
            WHERE ins.id_utilisateur = $id_utilisateur AND ins.id_form = f.id_form
        )
        GROUP BY f.id_form";

$RESULT = $connexion->query($SQL);

echo "<div class='tables'>";
while ($ligne = $RESULT->fetch()) {
    // Vérifie si le nombre d'inscriptions est inférieur au nombre maximum de places
    if ($ligne['nb_inscriptions'] < $ligne['nb_max']) {
        echo "
        <table>
            <tr>
                <th>" . $ligne['libelle_form'] . "</th>
            </tr>
            <tr>
                <td>
                    " . $ligne['contenu_form'] . "<br/><br/>
                    Places disponibles: " . ($ligne['nb_max'] - $ligne['nb_inscriptions']) . "<br/>
                    Tarif: " . $ligne['prix'] . "€
                    <div class='redirect-button'>
                        <a href='./recapitulatif_inscription_formation.php?id_form=" . $ligne['id_form'] . "'>S'inscrire</a>
                    </div>
                </td>
            </tr>
        </table>";
    }
}
echo "</div>";
?>

