<?php
    session_start();
    $_SESSION['connected'] = false;
    session_destroy();
    header("Location: ../index.php");
?>