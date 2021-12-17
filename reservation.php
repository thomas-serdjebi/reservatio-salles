<?php

session_start();
require('connexiondb.php');

if (!isset($_SESSION['login'])) {                                                       // SI PAS DUTILISATEUR CONNECTE
    $err_connexion = "Tu dois te connecter pour accéder à cette page, redirection en cours..." ;
    header("Refresh: 3; url=connexion.php");
}

$id_event = mysqli_query($mysqli, "SELECT id FROM reservations");
$tqt = mysqli_fetch_all($id_event);
var_dump($tqt);
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Voir une réservation</title>
        <link rel="stylesheet" href="header.css">
        <link rel="stylesheet" href="footer.css">
    </head>
    <body>

        <?php require("header.php"); ?>

        <main>

        
        </main>

        <?php require("footer.php"); ?>
    
    </body>
</html>