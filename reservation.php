<?php

require ('connexiondb.php');


$sql = mysqli_query($mysqli, "SELECT titre, description, debut, fin FROM reservations WHERE reservations.id = '".@$_GET['val']."'");

$data = mysqli_fetch_assoc($sql);

// Convertit une date ou un timestamp en français
function dateToFrench($date, $format) 
{
    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date) ) ) );
}

$heuredebut = $data['debut'];
$heurefin = $data['fin'];

$jourdebut = dateToFrench($heuredebut ,"l j F Y");
$hdebut = strtotime($heuredebut);
$hfin = strtotime($heurefin);
$debut = date("H:00", $hdebut);
$fin = date("H:00", $hfin);



?>


<html>
    <head>
        <meta charset="utf-8">
        <title>Planning</title>
        <link rel="stylesheet" href="header.css">
        <link rel="stylesheet" href="footer.css">
        <link rel="stylesheet" href="reservation.css">
    </head>
    <body>

        <?php require("header.php"); ?>

        <main>

            <section class="content">

                <div class="titrejourheure">

                    <div class="boxtitre"><?php echo $data['titre'] ; ?></div>

                    <div class="boxjourheure">
                        
                        <div class="boxjour"><?php echo $jourdebut; ?></div>

                        <div class="boxheure">
                            
                            <div class="heure"><?php echo $debut; ?></div>

                            <div class="heure"><?php echo $fin; ?></div>
                        </div>
                    </div>


                </div>

                <div class="boxdescription">
                    <?php echo $data['description'] ?>
                </div>

            </section>  

        </main>

        <?php require("footer.php"); ?>
    
    </body>
</html>