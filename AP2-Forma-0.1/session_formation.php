<?php
session_start();

if (!isset($_SESSION['connected']) || $_SESSION['connected'] == false) {
    header('Location: ./index.php');
    exit();
}
?>
<!doctype html>
<html lang="fr">
<head>
    <link href="./css/session_formation.css" rel="stylesheet">
</head>
<?php include("./navbar.php"); ?>
<?php include("./include/connexionBdd.php"); ?>

<body>
<?php
include("./include/calendrier_session.php");
?>
</body>

</html>