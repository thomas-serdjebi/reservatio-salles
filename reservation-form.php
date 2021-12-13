<?php

session_start() ;

require('connexiondb.php') ; 

$jour = date ('w') ; // numéro du jour actuel de 0(dimanche) à 6(samedi)







if (isset($_POST['reserver'])) {

    

    if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['day'])) {

        // REQUETE RECUPERATION ID UTILISATEUR

        $sqlid = mysqli_query($mysqli, "SELECT id FROM utilisateurs WHERE login = '".$_SESSION['login']."'");

        $resultid = mysqli_fetch_assoc($sqlid);

        $id_utilisateur = $resultid['id'] ;

        
        
        echo $fin;

        mysqli_query($mysqli, "INSERT INTO reservations (titre, description, debut, fin, id_utilisateur) 
        VALUES ( '".$_POST['title']."', '".$_POST['description']."', '".$_POST['day']."', '".strtotime(($_POST['day'])+3600)."','".$id_utilisateur."' )");

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

                <p class="intro"> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam odio, 
                    tempore saepe repellat vel consequatur sit. Nihil earum expedita enim iure alias illum nisi 
                    exercitationem architecto modi nesciunt. Voluptatum, aperiam? 
                </p>

                <div class="formbox">

                    <form action="reservation-form.php" method="post" class="styleform">

                        <div><input type="text" class="basicinput" name="title" placeholder="Titre de l'évènement"></div>

                        <div><input type="text" class="textinput" name="description" placeholder="Description"></div>

                        <!-- AJOUTER UN COMPTEUR DE CARACTERES -->

                        <div><input type= "datetime-local" name="day" step="3600"></div>


                        

                        <input type="submit" name="reserver" value="Réserver" class="submitbtn">

                    </form>

                </div>

            </section>

        </main>

        <?php require("footer.php"); ?>
            
    </body>
</html>