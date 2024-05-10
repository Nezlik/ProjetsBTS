<?php
include("./include/get_formation_by_id.php");

function get_formation_details($id_form)
{
    $resultat_Formation = get_formation_by_id($id_form);
    $ligne_resultat_formation = $resultat_Formation->fetch();

    return [
        'libelle_form' => $ligne_resultat_formation["libelle_form"],
        'intervenant' => $ligne_resultat_formation["intervenant"],
        'prix' => $ligne_resultat_formation["prix"],
        'nb_place' => $ligne_resultat_formation["nb_max"],
    ];
}
?>
