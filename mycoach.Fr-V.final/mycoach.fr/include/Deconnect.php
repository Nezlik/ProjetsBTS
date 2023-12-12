<?php
session_start();
session_destroy();
header('Location: ../Connexion.php?msg=0');
?>