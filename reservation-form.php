<?php

session_start() ;

require('connexiondb.php') ; 

if (!empty($_GET)) {
    extract($_GET);
    $valid = (boolean) true;        // UTILISATION DE LA VARIABLE VALIDE POUR RENDRE LES ERREURS 


    // SIMPLIFICATION DES GETS

    $title = $_GET['title'];
    $description = $_GET['description'];
    $day = $_GET['day'];
    $hour = $_GET['hour'];

    // RESERVER => VERIF DES ERREURS

    if (isset($_GET['reserver'])) {

        // REQUETE POUR VOIR SI TITRE EXISTANT --> VOIR AVEC VALENTIN SI COHERENT/UTILE DE FAIRE CETTE REQUETE

        // $testtitle = mysqli_query($mysqli, "SELECT * FROM reservation-salles WHERE titre = $title") ;
        
        // $titlerows = mysqli_num_rows($testtile) ;

        // ERREURS TITRE

        if(empty($title)) {
            $valid = false;
            $err_title = "Veuillez renseigner le titre de l'évènement." ;
            echo $err_title;
        }

        elseif (strlen($title)<45) {
            $valid = false;
            $err_title = "Le titre ne doit pas dépasser 45 caractères." ;
            echo $err_title;
        }

        // VERIF SI LE TITRE EXISTANT --> VOIR AVEC VALENTIN SI COHERENT/UTILE DE FAIRE CETTE REQUETE

        elseif ($titlerows == 1 ) {
           $err_title = "Un autre évènement ayant le même titre existe déjà. Etes vous certain de vouloir en créer un nouveau ?";
           $valid = false;
           echo $err_title;
           //Afficher l'évènement en question ou créer un lien vers l'évènement ? voir avec valentin
        }

        // ERREURS DESCRIPTION

        //REQUETE POUR VOIR SI DESCRIPTION EXISTANTE --> VOIR AVEC VALENTIN SI COHERENT/UTILE DE FAIRE CETTE REQUETE

        $testdesc = mysqli_query($mysqli, "SELECT * FROM reservations WHERE description = $description") ;
        
        $descrows = mysqli_num_rows($testdesc) ;

        if (empty($description)) {
            $valid = false;
            $err_description = "Veuillez renseigner une description." ;
            echo $err_description ;
        }

        elseif (strlen($description)<500) {
            $valid = false;
            $err_description = "La description ne doit pas dépasser 500 caractères";
            echo $err_description;
        }

        // VERIF SI LA DESCRIPTION EXISTE --> VOIR AVEC VALENTIN SI COHERENT/UTILE DE FAIRE CETTE REQUETE

        elseif ($descrows == 1 ) {
            $valid = false ;
            $err_description = "Cette description existe déjà. Etes vous certain de vouloir en créer un nouveau ?" ;
            //Afficher l'évènement en question ou créer un lien vers l'évènement ? voir avec valentin
            echo $err_description;
        }

        // VERIF JOUR ET HEURES

        if($jour="" || empty($jour)) {
            $valid = false;
            $err_jour = "Veuillez sélectionner un jour pour votre évènement." ;
            echo $err_jour;
        }

        if($heure="" || empty($heure)) {
            $valid = false;
            $err_heure = "Veuillez sélectionner un créneau pour votre évènement." ;
            echo $err_heure;
        }

        // REQUETE POUR VOIR SI JOUR/CRENEAU DEJA PRIS

        








        





















    }

    


















}


?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Réservation</title>

    </head>

    <body>

        <!-- RAJOUTER LE HEADER -->

        <main>
              
            <section class="content">

                <h1 class="titre">Réservation</h1>

                <p class="intro"> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam odio, 
                    tempore saepe repellat vel consequatur sit. Nihil earum expedita enim iure alias illum nisi 
                    exercitationem architecto modi nesciunt. Voluptatum, aperiam? 
                </p>

                <div class="formbox">

                    <form action="reservation-form.php" method="get" class="styleform">

                        <div><input type="text" class="basicinput" name="title" placeholder="Titre de l'évènement"></div>

                        <div><input type="text" class="textinput" name="description" placeholder="Description"></div>

                        <!-- AJOUTER UN COMPTEUR DE CARACTERES -->

                        <div>

                            <select class="selectinput" name="day">

                                <option value="">Sélectionnez un jour</option>
                                <option valeur="lundi">lundi</option>
                                <option valeur="mardi">mardi</option>
                                <option valeur="mercredi">mercredi</option>
                                <option valeur="jeudi">jeudi</option>
                                <option valeur="vendredi">vendredi</option>

                            </select>

                        </div>

                        <div>

                            <select class="selectinput" name="hour">

                                <option value="">Sélectionnez un créneau horaire</option>
                                <option valeur="08-09">08H à 09H</option>
                                <option valeur="09-10">09H à 10H</option>
                                <option valeur="10-11">10H à 11H</option>
                                <option valeur="11-12">11H à 12H</option>
                                <option valeur="12-13">12H à 13H</option>
                                <option valeur="13-14">13H à 14H</option>
                                <option valeur="15-16">14H à 15H</option>
                                <option valeur="17-18">15H à 16H</option>
                                <option valeur="18-19">16H à 17H</option>
                                <option valeur="18-19">17H à 18H</option>
                                <option valeur="18-19">18H à 19H</option>

                            </select>

                        </div>

                        <input type="submit" name="reserver" value="Réserver" class="submitbtn">

                    </form>

                </div>

            </section>

        </main>

        <!-- RAJOUTER LE FOOTER  -->
            
    </body>
</html>