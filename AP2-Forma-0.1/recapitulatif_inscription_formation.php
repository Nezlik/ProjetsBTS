<?php
session_start();

if (!isset($_SESSION['connected']) || $_SESSION['connected'] == false) {
    header('Location: ./index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<link rel="stylesheet" href="./css/recapitulatif.css">

<?php
include("./navbar.php");
include("./include/recapitulatif.php");

$id_form = isset($_GET['id_form']) ? $_GET['id_form'] : null;
$formationDetails = get_formation_details($id_form);

?>

<body>

    <header class="header">
        <h1>Récapitulatif Inscription</h1>
    </header>

    <div class="container">
        <div class="info-session">
            <p>
                <strong class="label">Libellé de la formation:</strong> <?php echo $formationDetails['libelle_form']; ?><br>
                <strong class="label">Intervenant:</strong> <?php echo $formationDetails['intervenant']; ?><br>
                <strong class="label">Prix:</strong> <?php echo $formationDetails['prix']; ?><br>
                <strong class="label">Nombre de places:</strong> <?php echo $formationDetails['nb_place']; ?><br>
            </p>
        </div>

        <a href="./include/inscription_formation.php?id=<?php echo ($id_form) ?>" class="button">M'inscrire</a>
    </div>

</body>


</html>