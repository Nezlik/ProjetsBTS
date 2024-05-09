<?php
    //--------------------------------------------------------------------------------
// Inclure le fichier qui permet l'acc�s au serveur MySQL et � la base inscription
//--------------------------------------------------------------------------------
include("\includes\GestionFrais.php");
 
//--------------------------------------------------------------------------
// Initialiser les variables qui recevront les donn�es issues du formulaire
    //--------------------------------------------------------------------------
    $PeriodeEngagement="";  
    $FraisForfait="";
    $NbRepas="";
    $NbNuit="";
    $NbEtapes="";
    $libelle="";
    $HorsFofait="";
    $Date="";
    $Montant="";

//---------------------------------------------------------------------
// R�cup�rer les valeurs saisies dans le formulaire dans les variables
//---------------------------------------------------------------------
    $PeriodeEngagement=$_POST["Periode d'engagement"];
    $FraisForfait=$_POST["Frais Forfait"];
    $NbRepas=$_POST["Nombre repas"];
    $NbNuit=$_POST["Nombre nuit"];
    $NbEtapes=$_POST["Nombre Etapes"];
    $libelle=$_POST["libellé"];
    $HorsFofait=$_POST["Hors Fofait"];
    $Date=$_POST["Date"];
    $Montant=$_POST["Montant"];

   echo




?>