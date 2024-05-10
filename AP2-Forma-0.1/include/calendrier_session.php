    <?php

    include("./include/connexionBdd.php");

    $id_form = isset($_GET['id_form']) ? $_GET['id_form'] : null;

    // Requête SQL pour récupérer les sessions de formation liées à une formation spécifique
    $sql = "SELECT sf.id_session, sf.date_session, sf.heure_debut, sf.heure_fin, sf.lieu
            FROM session_formation sf
            WHERE sf.id_form = :id_form";

    // Préparation de la requête
    $stmt = $connexion->prepare($sql);

    // Liaison du paramètre
    $stmt->bindParam(":id_form", $id_form, PDO::PARAM_INT);

    // Exécution de la requête
    $stmt->execute();

    // Création d'un tableau associatif pour regrouper les sessions de formation par jour
    $sessions_par_jour = [];

    while ($ligneSessionFormation = $stmt->fetch()) {
        $date_session = $ligneSessionFormation["date_session"];

        // Ajout de la session de formation à la date appropriée dans le tableau associatif
        $jour_seance = date('N', strtotime($date_session)); // Récupération du jour de la semaine (1 à 7)
        $jour_nom = strftime('%A', strtotime($date_session)); // Nom du jour en français

        // Ajout de la session au tableau associatif sous le jour correspondant
        $sessions_par_jour[$jour_nom][] = $ligneSessionFormation;
    }

    // Vérifiez si le tableau est vide
    if (empty($sessions_par_jour)) {
        echo "Désolé, il n'y a pas de session programmée pour cette semaine.";
    } else {
        // Étape 2 : Affichage des données dans un tableau HTML avec des colonnes pour chaque jour
        echo '<table border="1">';
        echo '<tr>';

        // Création des entêtes de colonnes pour les jours de la semaine
        foreach ($sessions_par_jour as $date => $sessions) {
            $jour_seance = date('N', strtotime($date)); // Récupération du jour de la semaine (1 à 7)

            switch ($jour_seance) {
                case 1:
                    echo '<th> Lundi </th>';
                    break;
                case 2:
                    echo '<th> Mardi </th>';
                    break;
                case 3:
                    echo '<th> Mercredi </th>';
                    break;
                case 4:
                    echo '<th> Jeudi </th>';
                    break;
                case 5:
                    echo '<th> Vendredi </th>';
                    break;
                case 6:
                    echo '<th> Samedi </th>';
                    break;
                case 7:
                    echo '<th> Dimanche </th>';
                    break;
            }
        }
        echo '</tr>';

        // Calcul du nombre maximal de sessions parmi les jours
        $max_sessions = max(array_map('count', $sessions_par_jour));

        // Parcours et affichage des sessions de formation pour chaque jour
        for ($i = 0; $i < $max_sessions; $i++) {
            echo '<tr>';

            foreach ($sessions_par_jour as $date => $sessions) {
                if (isset($sessions[$i])) {
                    $session = $sessions[$i];
                    echo '<td>';
                    echo '<a href="./recapitulatif_inscription_session.php?id='. $session["id_session"].'" class="table-cell-link">';
                    echo '<p>' . $session["date_session"] . '</p>';
                    echo '<p>' . $session["heure_debut"] . '-' . $session["heure_fin"] . '</p>';
                    echo '<p>' . $session["lieu"] . '</p>';
                    echo '</a>';
                    echo '</td>';
                } else {
                    echo '<td></td>';
                }
            }

            echo '</tr>';
        }

        echo '</table>';
    }
    ?>
