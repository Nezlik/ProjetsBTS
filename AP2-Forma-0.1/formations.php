<?php
session_start();

if (!isset($_SESSION['connected']) || $_SESSION['connected'] == false) {
    header('Location: ./index.php');
    exit();
}
?>

<head>
	<link href="./css/formations.css" rel="stylesheet">
</head>

<?php
include("./navbar.php");
include("./include/nb_inscription.php");

if (verifNombreInscriptions($_SESSION['id_utilisateur'])){
	echo "<script>alert('Vous êtes déjà inscrit à 3 formations !');</script>";
	header("Refresh: 0.1; url=./index.php");
}
?>

<body>

 <?=include("./include/tableau_formations.php")?>
 
</body>