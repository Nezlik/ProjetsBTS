<!doctype HTML>
<html>
<head>
  <?php
    session_start();
    if ( !isset($_SESSION["IsConnected"])){
      header("Location: ./Connexion.php?msg=0");
    }
    else{
      include("./include/ConnexionBdd.php");
      $SQL="SELECT activites.libelle, seance.Jour, horaires.HeureDebut, horaires.HeureFin, lieu.Adresse, lieu.CodePostal, lieu.Ville FROM seance INNER JOIN activites ON seance.CodeActivites = activites.CodeActivites INNER JOIN horaires ON seance.CodeDate=horaires.CodeDate INNER JOIN lieu ON seance.CodeLieu = lieu.CodeLieu ORDER BY activites.libelle;";
      $SQL2="SELECT COUNT(CodeSeance) FROM Seance;";
      $result = $connexion->query($SQL);
      $resultcount=$connexion->query($SQL2);
      $lignecount=$resultcount->fetch();
      $count=$lignecount[0];
      $esp=" ";
      $tir=" - ";
      $tot=0;
    }
  ?>
    <title>Seance</title>
    <meta charset= "utf-8">
    <link rel="stylesheet" href="style.css">
    <?php include './include/navbar.php';?>
</head>
<body class='seance'>
<div>
<table style="background-color:#33475b">
  <thead>
    <tr>
      <th colspan="5" height=75px><b>Les séances :</b></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td width=20% height=50px><b>Séance</b></td>
      <td width=20%><b>Date</b></td>
      <td width=20%><b>Horaires</b></td>
      <td width=20%><b>Niveau</b></td>
      <td width=20%><b>Lieu</b></td>
    </tr>
    <?php
    while ($count!=$tot){
      $ligne = $result->fetch();
      $activity=$ligne[0];
      echo "<tr>";
      echo "<td height=70px>" . $activity . "</td>";
      $activity=$ligne[1];
      echo "<td>" . $activity . "</td>";
      $activity=$ligne[2];
      $resultat=$activity.$tir.$ligne[3];
      echo "<td>" . $resultat . "</td>";
      $activity=$ligne[3];
      echo "<td>" . $activity . "</td>";
      $activity=$ligne[4];
      $resultat=$activity.$esp.$ligne[5].$esp.$ligne[6];
      echo "<td>" . $resultat . "</td>";
      echo "</tr>";
      $tot+=1;
    }
    ?>
  </tbody>
  </div>
</table>
</body>
</html>