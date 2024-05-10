<?php
require('../asset/biblioteque/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial','B',12);
        $this->Cell(0,10,'Inscriptions aux Formations',0,1,'C');
        $this->Ln(10);
    }

    function ChapterTitle($title)
    {
        $this->SetFont('Arial','B',12);
        $this->Cell(0,10,$title,0,1,'L');
        $this->Ln(4);
    }

    function ChapterBody($body)
    {
        $this->SetFont('Arial','',12);
        $this->MultiCell(0,10,$body);
        $this->Ln();
    }
}

require("./connexionBdd.php");

// Requête SQL pour récupérer les données d'inscription
$sql = "SELECT 
            u.nom AS 'Nom Utilisateur',
            u.prenom AS 'Prénom Utilisateur',
            f.libelle_form AS 'Libellé Formation',
            f.contenu_form AS 'Contenu Formation',
            i.date_inscription AS 'Date Inscription',
            i.etat AS 'État Inscription'
        FROM inscription i
        JOIN utilisateur u ON i.id_utilisateur = u.id_utilisateur
        JOIN formation f ON i.id_form = f.id_form";

$result = $connexion->query($sql);

// Création du PDF
$pdf = new PDF();
$pdf->AddPage();

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $pdf->ChapterTitle($row['Nom Utilisateur'] . ' ' . $row['Prénom Utilisateur']);
    $pdf->ChapterBody('Libellé Formation: ' . $row['Libellé Formation'] . "\nContenu Formation: " . $row['Contenu Formation'] . "\nDate Inscription: " . $row['Date Inscription'] . "\nÉtat Inscription: " . $row['État Inscription']);
}

$pdf->Output();
$connexion = null; // Fermer la connexion PDO
?>
