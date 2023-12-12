<?php
    session_start();
    include("ConnexionBdd.php");
    $username=$_POST['username'];
    $password=$_POST['password'];
    $SQL="SELECT Username, Password FROM login WHERE Username='$username';";

    $result = $connexion->query($SQL);
	$ligne = $result->fetch();
	$motPasseBdd = $ligne[1];
    if  ($motPasseBdd!=$password){
        header("location:../Connexion.php?msg=1");
    }
    else{
        $_SESSION["IsConnected"]=True;
        header("Location: ../index.php");
    }

?>