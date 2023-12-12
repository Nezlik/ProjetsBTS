<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <title>Inscription</title>
</head>

<body class="bodyConnexion">

    <div class="container">
    <a href='./index.php'><img class='home' src="./img/home.png"></a>
        <h1>Connexion</h1>
        <form action="./include/identif.php" method="POST">
            <div class="form-control">
                <input type="text" id="username" name="username" value="" required placeholder="Identifiant">
            </div>
            <div class="form-control">
                <input type="password" id="password" name="password" value="" required placeholder="Mot de passe">
            </div>
            <br>
            <br>
            <button type="submit" class="bouton">Valider</button>
            <?php
            if($_GET['msg'] == 1) {
            echo "<p class='hy'><br>Login ou Mot de passe incorrect</p>";
            }
            ?>
        </form>
        
    </div>
</body>

</html>
