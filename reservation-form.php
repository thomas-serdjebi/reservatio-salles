<?php

session_start()

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

                        <div><input type="text" class="basicinput" name="titre" placeholder="Titre de l'évènement"></div>

                        <div><input type="text" class="textinput" name="description" placeholder="Description"></div>

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

                    </form>

                </div>

            </section>

        </main>

        <!-- RAJOUTER LE FOOTER  -->
            
    </body>
</html>