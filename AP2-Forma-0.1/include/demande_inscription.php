<?php

function demande_inscription(){

include("../include/connexionBdd.php");

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$association = $_POST['association'];
$statut = $_POST['statut'];
$rue = $_POST['rue'];
$ville = $_POST['ville'];
$CP = $_POST['CP'];

$sql = "INSERT INTO demande_inscription (nom, prenom, email, id_association, id_statut, adresse, ville, CP) VALUES ('$nom', '$prenom', '$email', '$association', '$statut', '$rue', '$ville', '$CP')";
$result = $connexion->query($sql);

return $result;
}

if (demande_inscription()){
    echo '<script>alert("Votre demande d\'inscription a bien été prise en compte. Vous recevrez un mail de confirmation.");</script>';
    header("refresh: 0.2; url=../index.php");
}
else{
    echo '<script>alert("Votre demande d\'inscription a échoué. Veuillez réessayer.");</script>';
    header("refresh: 0.2 ; url=../formulaire_inscription.php");
}
?>