<?php
include("./include/connexionBdd.php");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<header class="bg-white">
    <nav class="border-b border-solid border-grey rounded-lg flex items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="flex lg:flex-1">
            <a href="./index.php" class="-m-1.5 p-1.5">
                <img class="mx-auto h-10 w-auto" src="./asset/img/logo.png" alt="Forma">
            </a>
        </div>
        <div class="hidden lg:flex lg:gap-x-12">
           
        </div>
        <div class="hidden lg:flex lg:flex-1 lg:justify-end">

            <?php if (isset($_SESSION['connected']) && $_SESSION['connected'] == true) { ?>

                <a href="./include/deconnexion.php" class="text-sm font-semibold leading-6 text-gray-900">Déconnexion <-</a>

            <?php } else { ?>

                <a href="./connexion_utilisateur.php" class="text-sm font-semibold leading-6 text-gray-900">Connexion -></a>

            <?php } ?>
        </div>
    </nav>
</header>