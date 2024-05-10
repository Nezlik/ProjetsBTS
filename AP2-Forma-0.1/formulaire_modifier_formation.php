<?php
session_start();

if (!isset($_SESSION['connected']) || $_SESSION['connected'] == false || $_SESSION['statut'] == 2) {
    header('Location: ./index.php');
    exit();
}
?>
<?php
include("./include/get_formation_by_id.php");
include("./include/connexionBdd.php");

$id_form = isset($_GET['id']) ? $_GET['id'] : null;

$resultatFormation = get_formation_by_id($id_form);
$ligne_resultat_formation = $resultatFormation->fetch();

include("./navbar.php");
?>

<link rel="stylesheet" href="./css/modifier.css">

<body>

    <form action="./include/modifier_formation.php" method="POST">

        <input type="hidden" name="id_form" value="<?= $id_form?>">

        <label for="libelle">Libellé de la Formation:</label>
        <input type="text" name="libelle" value="<?= $ligne_resultat_formation['libelle_form']; ?>" required>

        <label for="intervenant">Intervenant:</label>
        <input type="text" name="intervenant" value="<?= $ligne_resultat_formation['intervenant']; ?>">

        <label for="prix">Prix:</label>
        <input type="number" name="prix" value="<?= $ligne_resultat_formation['prix']; ?>" required>

        <label for="nb_max">Nombre Max de Participants:</label>
        <input type="number" name="nb_max" value="<?= $ligne_resultat_formation['nb_max']; ?>" required>

        <label for="contenue_form">Contenu de la Formation:</label>
        <textarea name="contenu_form" rows="4"><?= $ligne_resultat_formation['contenu_form']; ?></textarea>

        <label for="id_domaine">Domaine:</label>
        <select name="id_domaine" required>
            <option value="1" <?= ($ligne_resultat_formation['id_domaine'] == 1) ? 'selected' : ''; ?>>Gestion</option>
            <option value="2" <?= ($ligne_resultat_formation['id_domaine'] == 2) ? 'selected' : ''; ?>>Informatique</option>
            <option value="3" <?= ($ligne_resultat_formation['id_domaine'] == 3) ? 'selected' : ''; ?>>Développement Durable</option>
        </select>

        <button type="submit">Modifier</button>
    </form>

</body>

</html>
