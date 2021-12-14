<?php

session_start() ;

require('connexiondb.php') ; 

// VERIF SI CONNECTE


$today = date('Y-m-d H:i', time() + 60*60); //heure du jour avec heure d'hiver


if (isset($_POST['reserver'])) {

    $valid = (boolean) true ;

    // VERIF DES ERREURS DU TITRE : VIDE, 50 CARACTERES MAX

    if (empty($_POST['title'])) {    
        $valid = false;
        $err_title = "Veuillez renseigner le titre de l'évènement.";
        echo $err_title;
        $_POST['title'] = "";
    }

    elseif (strlen($_POST['title'])>50) {
        $valid = false;
        $err_title = "Le titre de votre évènement ne doit pas dépasser 50 caractères.";
        echo $err_title;
        $_POST['title'] = "";
    }

    // VERIF DES ERREURS DE LA DESCRIPTION : VIDE, 500 CARACTERES MAX

    if (empty($_POST['description'])) {
        $valid = false;
        $err_description = "Veuillez remplir la description de votre évènement.";
        echo $err_description;
        $_POST['description'] = "";
    }

    elseif (strlen($_POST['description'])>500) {
        $valid = false;
        $err_description = "La description ne doit pas dépasser 500 caractères.";
        echo $err_description ;
        $_POST['description'] = "";
    }

    // VERIF SI CRENEAU DEJA PRIS

    $day = $_POST['day'];


    $sql = "SELECT * from reservations WHERE debut = '".$day."'";
    
    $requete = mysqli_num_rows(mysqli_query($mysqli, $sql));

    if ($requete == 1) {
        $valid = false;
        $err_indisponible = "Ce créneau n'est pas disponible. Veuillez choisir une autre disponibilité.";
        echo $err_indisponible;
        $_POST['day']="";
    }

    // VERIF SI CRENEAU EST ANTERIEUR 

    if ($day < $today) {
        $valid = false;
        $err_indisponible = "Vous ne pouvez pas réserver de date antérieure à celle du jour." ;
        echo $err_indisponible;
        $_POST['day']="";
    }

    // VERIF SI ENTRE 8H et 19H et LUNDI AU VENDREDI

    $getdate = strtotime($day);
    $array = getdate($getdate);

    // VERIF SI SAMEDI OU DIMANCHE 

    if ($array['wday'] == 6 || $array['wday'] == 7) {
        $valid = false;
        $err_indisponible = "Le créneau doit être choisi du lundi au vendredi.";
        echo $err_indisponible;
        $_POST['day']="";
    
    }
    
    // VERIF SI ENTRE 8 ET 19H

    if ( $array['hours'] < 8 || $array['hours']>19) {
        $valid = false;
        $err_indisponible = "Le créneau doit être choisi entre 8:00 et 19:00";
        echo $err_indisponible;
        $_POST['day']="";
    }



    // SI PAS DERREUR ALORS EXECUTION RESERVATION

    

    if ($valid) {

        // REQUETE RECUPERATION ID UTILISATEUR

        $sqlid = mysqli_query($mysqli, "SELECT id FROM utilisateurs WHERE login = '".$_SESSION['login']."'");

        $resultid = mysqli_fetch_assoc($sqlid);

        $id_utilisateur = $resultid['id'] ;

        

        $currenttime = $_POST['day'];
        $newtime = strtotime($currenttime . "+1hours");
        $newtime = date('Y-m-d H:i', $newtime) ;
        
        

        mysqli_query($mysqli, "INSERT INTO reservations (titre, description, debut, fin, id_utilisateur) VALUES ('".$_POST['title']."', '".$_POST['description']."', '".$_POST['day']."', '".$newtime."','".$id_utilisateur."')");
        
        
    }


}

?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Réservation</title>
        <link rel="stylesheet" href="header.css">
        <link rel="stylesheet" href="footer.css">
    </head>
    <body>

        <?php require("header.php"); ?> 

        <main>
              
            <section class="content">


                <h1 class="titre">Réservation</h1>

                <?php if(isset($_SESSION['login'])) { ?>

                    <p class="intro"> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam odio, 
                        tempore saepe repellat vel consequatur sit. Nihil earum expedita enim iure alias illum nisi 
                        exercitationem architecto modi nesciunt. Voluptatum, aperiam? 
                    </p>

                    <div class="formbox">

                        <form action="reservation-form.php" method="post" class="styleform">


                            <div class="errform"><?php if (isset($err_title)) { echo $err_title ;} ?></div>
                            <div><input type="text" class="basicinput" name="title" placeholder="Titre de l'évènement" value=<?php if(isset($_POST['title'])) {echo $_POST['title'];}?>></div>

                            <div class="errform"><?php if (isset($err_description)) { echo $err_description ;} ?></div>
                            <div><input type="text" class="textinput" name="description" placeholder="Description"  value=<?php if (isset($_POST['description'])){echo $_POST['description'];}?>></div>

                            <!-- AJOUTER UN COMPTEUR DE CARACTERES -->

                            <div class="errform"><?php if (isset($err_indisponible)) { echo $err_indisponible ;} ?></div>
                            <div><input type= "datetime-local" name="day" step="3600"></div>

                            <input type="submit" name="reserver" value="Réserver" class="submitbtn">

                        </form>

                    </div>

                <?php } ?>

                <?php if (!isset($_SESSION['login'])) { ?>

                    <p class="intro">Vous devez vous connecter pour réserver un créneau. </br>
                        Si vous n'avez pas de compte, inscrivez vous.
                    </p>

                    <form action='inscription.php' method='get'>
                            <button type='submit' class='submitbtn'>Inscription</button>
                        </form>
                    

                    
                    <form action='connexion.php' method='get'>
                        <button type='submit' class='submitbtn'>Connexion</button>      
                    </form>

                <?php } ?>
                
                

            </section>

        </main>

        <?php require("footer.php"); ?>
            
    </body>
</html>