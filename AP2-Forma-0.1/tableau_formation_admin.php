<?php

session_start();

if (!isset($_SESSION['connected']) || $_SESSION['connected'] == false || $_SESSION['statut'] == 2) {
    header('Location: ./index.php');
    exit();
}
include("./navbar.php");

$sql = "SELECT * FROM formation";
$resultat = $connexion->query($sql);
$formations = $resultat->fetchAll(PDO::FETCH_ASSOC);

// Récupération des intervenants depuis la base de données
$sqlIntervenants = "SELECT id_interlocuteur, CONCAT(nom, ' ', prenom) AS intervenant_nom FROM interlocuteur";
$resultatIntervenants = $connexion->query($sqlIntervenants);
$intervenants = $resultatIntervenants->fetchAll(PDO::FETCH_ASSOC);

// Récupération des domaines depuis la base de données
$sqlDomaines = "SELECT id_domaine, libelle_domaine FROM domaine_formation";
$resultatDomaines = $connexion->query($sqlDomaines);
$domaines = $resultatDomaines->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<link href="./css/tableau_admin.css" rel="stylesheet">

<body>

    <h1 class="page-title">Liste des Formations</h1>

    <!-- Tableau affichant les formations -->
    <table class="data-table">
        <thead>
            <tr>
                <th>ID Formation</th>
                <th>Libellé</th>
                <th>Intervenant</th>
                <th>Prix</th>
                <th>Nombre Max</th>
                <th>Contenu</th>
                <th>Domaine</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($formations as $formation) : ?>
                <tr>
                    <td><?= $formation['id_form']; ?></td>
                    <td><?= $formation['libelle_form']; ?></td>
                    <td><?= $formation['intervenant']; ?></td>
                    <td><?= $formation['prix']; ?></td>
                    <td><?= $formation['nb_max']; ?></td>
                    <td><?= $formation['contenu_form']; ?></td>
                    <td><?= $formation['id_domaine']; ?></td>
                    <td>
                        <a href="./formulaire_modifier_formation.php?id=<?= $formation['id_form']; ?>" class="action-link">Modifier</a>
                        <a href="./include/supprimer_formation.php?id=<?= $formation['id_form']; ?>" class="action-link">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Formulaire d'ajout de formation -->
    <div class="add-form-container">

        <div class="page-title">
            <h1>Ajouter une Formation</h1>
        </div>

        <form action="./include/ajouter_formation.php" method="POST" class="add-form">
            <div class="form-group">
                <label for="libelle" class="form-label">Libellé de la Formation:</label>
                <input type="text" name="libelle" class="form-input" required placeholder="Entrez le libellé de la formation">
            </div>

            <div class="form-group">
                <label for="intervenant" class="form-label">Intervenant:</label>
                <select name="intervenant" class="form-input" required>
                    <?php foreach ($intervenants as $intervenantItem) : ?>
                        <option value="<?= $intervenantItem['id_interlocuteur']; ?>"><?= $intervenantItem['intervenant_nom']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="prix" class="form-label">Prix:</label>
                <input type="number" name="prix" class="form-input" required placeholder="Entrez le prix">
            </div>

            <div class="form-group">
                <label for="nb_max" class="form-label">Nombre Max de Participants:</label>
                <input type="number" name="nb_max" class="form-input" required placeholder="Entrez le nombre maximum de participants">
            </div>

            <div class="form-group">
                <label for="contenue_form" class="form-label">Contenu de la Formation:</label>
                <textarea name="contenue_form" class="form-input" rows="4" placeholder="Entrez le contenu de la formation"></textarea>
            </div>

            <div class="form-group">
                <label for="id_domaine" class="form-label">Domaine:</label>
                <select name="id_domaine" class="form-input" required>
                    <?php foreach ($domaines as $domaine) : ?>
                        <option value="<?= $domaine['id_domaine']; ?>"><?= $domaine['libelle_domaine']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="form-button">Ajouter</button>
        </form>
    </div>


</body>

</html>