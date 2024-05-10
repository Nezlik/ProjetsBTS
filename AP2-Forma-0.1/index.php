<?php
session_start();
?>
<!doctype html>
<html lang="fr">

<?php include("./navbar.php"); ?>
<link href="./css/menu.css" rel="stylesheet">
<link rel="stylesheet" href="./css/presentation.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<body>

    <?php if (isset($_SESSION['statut'])) {
    ?>
        <div class="menu-container">
            <?php
            if ($_SESSION['statut'] == 2) {
            ?>

                <div class="menu-item" onclick="window.location.href='./formations.php'">
                    <img src="./asset/img/formation_img.png" alt="Image 1">
                    <div class="menu-item-text">Les Formations</div>
                </div>

                <div class="menu-item" onclick="window.location.href='./formation_inscrit.php'">
                    <img src="./asset/img/calendrier.png" alt="Image 1">
                    <div class="menu-item-text">Calendrier des sessions</div>
                </div>

                <div class="menu-item" onclick="window.location.href='./profil_utilisateur.php'">
                    <img src="./asset/img/profil_img.png" alt="Image 3">
                    <div class="menu-item-text">Mon Profil</div>
                </div>
            <?php } else if ($_SESSION['statut'] == 1) {
            ?>
                <div class="menu-item" onclick="window.location.href='./tableau_formation_admin.php '">
                    <img src="./asset/img/formation_img.png" alt="Image 1">
                    <div class="menu-item-text">Modification des formations</div>
                </div>

                <div class="menu-item" onclick="window.location.href='./profil_utilisateur.php'">
                    <img src="./asset/img/profil_img.png" alt="Image 3">
                    <div class="menu-item-text">Mon Profil</div>
                </div>

            <?php } else if ($_SESSION['statut'] == 3) { ?>

                <div class="menu-item" onclick="window.location.href='./consultation_formation.php'">
                    <img src="./asset/img/formation_img.png" alt="Image 1">
                    <div class="menu-item-text">Consulter Les Formations</div>
                </div>

                <div class="menu-item" onclick="window.location.href='./consultation_session.php'">
                    <img src="./asset/img/calendrier.png" alt="Image 1">
                    <div class="menu-item-text">Calendrier des sessions</div>
                </div>

                <div class="menu-item" onclick="window.location.href='./tableau_formation_admin.php '">
                    <img src="./asset/img/formation_img.png" alt="Image 1">
                    <div class="menu-item-text">Modification des formations</div>
                </div>

                <div class="menu-item" onclick="window.location.href='./admin_inscription.php'">
                    <img src="./asset/img/calendrier.png" alt="Image 1">
                    <div class="menu-item-text">Gerer demande d'inscriptions</div>
                </div>

                <div class="menu-item" onclick="window.location.href='./include/liste_pdf.php'">
                    <img src="./asset/img/calendrier.png" alt="Image 1">
                    <div class="menu-item-text">Obtenir liste des inscriptions</div>
                </div>

                <div class="menu-item" onclick="window.location.href='./profil_utilisateur.php'">
                    <img src="./asset/img/profil_img.png" alt="Image 3">
                    <div class="menu-item-text">Mon Profil</div>

                </div>

            <?php } ?>
        </div>
    <?php } else { ?>
        <div class="presentation">
            <img class="image_presentation" src="./asset/img/img_presentation.jpg" alt="Image 1">
            <div class="overlay">
                <h1>FORMA</h1>
                <p>Bienvenue sur FORMA, votre plateforme dédiée à l'apprentissage et à la formation continue. Explorez nos opportunités éducatives et inscrivez-vous facilement aux formations qui vous intéressent. Développez vos compétences et atteignez vos objectifs professionnels avec FORMA.</p>
                <a href="./formulaire_inscription.php" class="btn">S'inscrire maintenant</a><br>
                <a href="./connexion_utilisateur.php" class="btn">Se connecter</a>

                <div class="presentation-slider">
                    <div class="slick-slide">
                        <img class="image_presentation" src="./asset/img/img_carrousel1.jpg" alt="Image 1">
                    </div>
                    <div class="slick-slide">
                        <img class="image_presentation" src="./asset/img/img_carrousel2.jpg" alt="Image 2">
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.presentation-slider').slick({
                    arrows: false, // Supprime les flèches de navigation si vous ne les voulez pas
                    dots: true, // Ajoute des points indicateurs pour chaque slide
                    autoplay: true, // Démarre le carrousel en mode automatique
                    autoplaySpeed: 4000 // Temps en millisecondes entre chaque slide
                });
            });
        </script>
    <?php } ?>

</body>

</html>