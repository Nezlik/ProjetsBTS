<?php

session_start();

if (!isset($_SESSION['connected']) || $_SESSION['connected'] == false || $_SESSION['statut'] != 3) {
    header('Location: ./index.php');
    exit();
}

?>

<!doctype html>
<html lang="fr">

<?php include("./navbar.php"); ?>

<body>
    <a href='https://example.com/profile/leslie-alexander'>
        <ul role='list' class='p-20 divide-y divide-gray-100' style='max-height: 400px; overflow-y: auto;'>

            <?php
            $sql = "SELECT * FROM demande_inscription";
            $result = $connexion->query($sql);

            while ($ligne = $result->fetch()) {
                echo "
            <div class='flex justify-center items-center'>
                <li class='flex justify-between w-1/2 py-2 bg-gray-200 border border-black rounded-lg'>
                    <div class='flex justify-between gap-x-6 py-5 px-2'>
                        <div class='flex min-w-0 gap-x-4'>
                            <div class='min-w-0 flex-auto'>
                                <p class='text-sm font-semibold leading-6 text-gray-900'>" . $ligne['prenom'] . " " . $ligne['nom'] . "</p>
                                <p class='mt-1 truncate text-xs leading-5 text-gray-500'>" . $ligne['email'] . "</p>
                            </div>
                        </div>
                    </div>
                    <div class='flex items-center gap-x-4 px-2'>
                    <a href='./include/acceptation_demande.php?id=" . $ligne['id_utilisateur'] . "'><button class='bg-green-500 text-white px-4 py-2 rounded'>Accepter</button></a>
                    <a href='./include/refus_demande.php?id=" . $ligne['id_utilisateur'] . "'><button class='bg-red-500 text-white px-4 py-2 rounded'>Refuser</button></a>
                    </div>
                </li>
            </div>";
            }
            ?>

        </ul>
    </a>
</body>

</html>