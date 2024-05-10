<?php
session_start();

if (!isset($_SESSION['connected']) || $_SESSION['connected'] == false) {
    header('Location: ./index.php');
    exit();
}

?>
<head>
	<link href="./css/tableau_formation_inscrit.css" rel="stylesheet">
</head>

<?php
include("./navbar.php");
?>

<body>

 <?=include("./include/tableau_formation_inscrit.php")?>
 
</body>