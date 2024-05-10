<?php
session_start();
?>
<!doctype html>
<html lang="fr">

<?php include("./navbar.php"); ?>

<body>
    <section>
        <form action="./include/demande_inscription.php" method="POST" class="mx-7">
        <div class="border-b border-gray-900/10 pb-10">
            <br>
            <img class="mx-auto h-10 w-auto" src="./asset/img/logo.png" alt="Forma">
            <br>
            <h1 class="text-3xl font-bold leading-9 text-gray-900 text-center">Inscription</h1>
        </div>
            <div class="space-y-12 mt-10">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Information personnel</h2>
                    <p class="mt-1 text-sm leading-5 text-gray-500">Remplissez le formulaire ci-dessous pour vous inscrire.</p>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="prenom" class="block text-sm font-medium leading-6 text-gray-900">Prenom</label>
                            <div class="mt-2">
                                <input type="text" name="prenom" id="prenom" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" require>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="nom" class="block text-sm font-medium leading-6 text-gray-900">Nom</label>
                            <div class="mt-2">
                                <input type="text" name="nom" id="nom" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" require>
                            </div>
                        </div>

                        <div class="sm:col-span-4">
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" require>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="association" class="block text-sm font-medium leading-6 text-gray-900">Association</label>
                            <div class="mt-2">
                                <select id="association" name="association" autocomplete="association-nom" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" require>
                                    <?php
                                    $sql = "SELECT * FROM association";
                                    $result = $connexion->query($sql);
                                    while ($ligne = $result->fetch()) {
                                        echo "<option value='" . $ligne['id_association'] . "'>" . $ligne['nom'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="statut" class="block text-sm font-medium leading-6 text-gray-900">statut</label>
                            <div class="mt-2">
                                <select id="statut" name="statut" autocomplete="statut-nom" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" require>
                                    <?php
                                    $sql = "SELECT * FROM statut";
                                    $result = $connexion->query($sql);
                                    while ($ligne = $result->fetch()) {
                                        echo "<option value='" . $ligne['id_statut'] . "'>" . $ligne['libelle_statut'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label for="rue" class="block text-sm font-medium leading-6 text-gray-900">Rue</label>
                            <div class="mt-2">
                                <input type="text" name="rue" id="rue" autocomplete="rue" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" require>
                            </div>
                        </div>

                        <div class="sm:col-span-2 sm:col-start-1">
                            <label for="ville" class="block text-sm font-medium leading-6 text-gray-900">Ville</label>
                            <div class="mt-2">
                                <input type="text" name="ville" id="ville" autocomplete="address-level2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" require>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="CP" class="block text-sm font-medium leading-6 text-gray-900">Code postal</label>
                            <div class="mt-2">
                                <input type="text" name="CP" id="CP" autocomplete="CP" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" require>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-b border-gray-900/10 pb-12">
                    
                    <div class="mt-10 space-y-10">
                        <fieldset>
                            <div class="mt-6 space-y-6">
                                <div class="relative flex gap-x-3">
                                    <div class="flex h-6 items-center">
                                        <input id="accept_rgpd" name="accept_rgpd" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" require>
                                    </div>
                                    <div class="text-sm leading-6">
                                        <label for="accept_rgpd" class="font-medium text-gray-900">J'ai lu et j'accepte</label>
                                        <p class="text-gray-500">En cochant cette case, je consens à la collecte, au traitement et à l'utilisation de mes données personnelles conformément à la politique de confidentialité de Froma. Je comprends que je peux retirer ce consentement à tout moment en suivant les instructions fournies dans ladite politique</p>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="mt-6 pb-4 flex items-center justify-end gap-x-6">
                <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
        </form>
    </section>

</body>

</html>