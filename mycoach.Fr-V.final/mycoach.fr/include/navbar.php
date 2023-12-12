<!doctype HTML>
<html>
<head>

    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
    <?php
        if (isset($_SESSION["IsConnected"])){
            echo "<nav><ul><li><a href='./index.php'>Qui suis-je ?</a></li><li><a href='./seance.php'>Seance</a></li><li><a href='./include/Deconnect.php'>Déconnexion</a></li></ul></nav>";
        }
        else{
            echo "<nav><ul><li><a href='./index.php'>Qui suis-je ?</a></li><li><a href='./seance.php'>Seance</a></li><li><a href='./Connexion.php?msg=0'>Connexion</a></li></ul></nav>";
        }
    ?>  
</body>
</html>