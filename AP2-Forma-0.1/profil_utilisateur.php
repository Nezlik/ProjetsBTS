<?php
session_start();

if (!isset($_SESSION['connected']) || $_SESSION['connected'] == false) {
    header('Location: ./index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<?php 
include("./navbar.php"); 
include("./include/profils.php");
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de l'utilisateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .profile-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .profile-header {
            background-color: #1877f2;
            padding: 20px;
            text-align: center;
            color: #fff;
        }

        .profile-header h1 {
            margin: 0;
        }

        .profile-info {
            padding: 20px;
            text-align: center;
        }

        .profile-info h2 {
            color: #333;
        }

        .profile-info p {
            margin: 10px 0;
            color: #555;
        }

        .profile-courses {
            padding: 20px;
        }

        .course-list {
            list-style-type: none;
            padding: 0;
        }

        .course-item {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .bouton {
            text-align: center;
            margin-top: 20px;
        }

        .bouton a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #1877f2;
            /* Couleur de fond du bouton */
            color: #fff;
            /* Couleur du texte du bouton */
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            /* Animation de transition de couleur de fond */
        }

        .bouton a:hover {
            background-color: #0a5bbf;
            /* Couleur de fond du bouton au survol */
        }

        /* Ajoutez plus de styles selon vos besoins */
    </style>
</head>

<body>

    <div class="profile-container">
        <div class="profile-header">
            <h1>Profil de l'utilisateur</h1>
        </div>

        <div class="profile-info">
            <h2>Informations personnelles</h2>
            <p>Nom: <?php echo $user_data['nom']; ?></p>
            <p>Prénom: <?php echo $user_data['prenom']; ?></p>
            <p>Adresse: <?php echo $user_data['adresse']; ?></p>
            <p>Code postal: <?php echo $user_data['CP']; ?></p>
            <p>Ville: <?php echo $user_data['ville']; ?></p>
            <p>Email: <?php echo $user_data['email']; ?></p>
        </div>

        <div class="profile-courses">
            <h2>Formations auxquelles l'utilisateur est inscrit</h2>
            <?php if ($result_inscriptions->rowCount() > 0) : ?>
                <ul class="course-list">
                    <?php while ($formation = $result_inscriptions->fetch()) : ?>
                        <li class="course-item"><?php echo $formation['libelle_form']; ?></li>
                    <?php endwhile; ?>
                </ul>
            <?php else : ?>
                <p>L'utilisateur n'est inscrit à aucune formation pour le moment.</p>
            <?php endif; ?>
            <div class="bouton">
                <a href="./formations.php">Retourner au tableau des formations</a>
            </div>
        </div>
    </div>

</body>

</html>