<?php

    session_start();

    

    require('connexiondb.php');

    $newlogin="";
    $confirmlogin= "";
    $actualmdp ="";
    $newmdp ="";
    $confirmmdp ="";



   

    if (!isset($_SESSION['login'])) {                                                       // SI PAS DUTILISATEUR CONNECTE
        $err_connexion = "Vous devez vous connecter pour accéder à cette page." ;
        header('Location: connexion.php');

    } 

    else { 

        require ('connexiondb.php'); // CONNEXION A LA BDD


        // PARTIE LOGIN ----------------------------------------------------------------------------------------------------

        $validlogin = (boolean) true ;                                                          // SI TRUE = PAS DERREUR ALORS LANCE LA REQUETE
        $openlogin = 0 ;                                                                        // FORMULAIRE CACHE PAR DEFAUT

        if (isset($_POST['loginform'])) {                                                       // AFFICHAGE DU FORMULAIRE DU Login

            $openlogin = 1 ;  
        }    

        if (isset($_POST['modiflogin'])) {

            $openlogin = 1 ;                                                                    // GARDE LE FORMULAIRE OUVERT SI ERREURS

            // VARIABLES DU POST

            $newlogin = trim($_POST['newlogin']) ;
            $confirmlogin = trim($_POST['confirmlogin']) ;


            //-------------------------------------------------VERIF DES ERREURS DU NEW LOGIN
            
            if(empty($newlogin)) {                                                              // VERIF SI NEW LOGIN REMPLI

                $err_newlogin = "Veuillez renseigner votre nouveau login.";
                $validlogin = false;
                $newlogin="";
            }

            elseif (!preg_match("#^[a-z0-9]+$#" ,$newlogin)) {                                  // NEWLOGIN : SANS MAJ, SANS SPEC, MIN ET CHIFFRES OK

                $err_newlogin = "Le login doit être renseigné uniquement en lettres miniscules ou chiffres, sans caractères spéciaux ou accents." ;
                $valid = false;
                $newlogin ="";

            }        
            
            elseif(strlen($newlogin)>25) {                                                      // NEWLOGIN : MAXIMUM 25 CARACTERES                         
                          
                $err_newlogin= "Le login est trop long, il dépasse 25 caractères.";
                $valid= false;
                $newlogin ="";
            }

            elseif ($newlogin == $_SESSION['login']) {                                          // VERIF SI CEST DEJA LE LOGIN UTILISE 
               
                $err_newlogin = "Vous utilisez déjà ce login";
                $validlogin=false;
                $newlogin="";
            }

            if(empty($confirmlogin)) {                                                          // VERIF SI CONFIRM LOGIN REMPLI
               
                $err_confirmlogin = " Veuillez confirmer votre nouveau login";
                $validlogin=false;
                $confirmlogin="";
            }

            elseif($newlogin != $confirmlogin) {                                                // VERIF SI NEW LOGIN ET CONFIRM LOGIN CORRESPONDENT
                
                $err_2logins = "Les nouveaux logins ne correspondent pas." ;
                $validlogin = false;
                $confirmlogin= "";
            }

            //------------------------------------------- REQUETE MODIF LOGIN SI PAS DERREURS

            if($validlogin==true) {

                $requestlogin = "UPDATE utilisateurs SET login= '$newlogin' WHERE login = '".$_SESSION['login']."'" ;

                if(mysqli_query($mysqli, $requestlogin)) {
                  
                    $newloginok = "Le nouveau login a bien été enregistré.";
                    $openlogin = 0;                                          // FERME LE FORMULAIRE LOGIN SI MODIF OK
                    $_SESSION['login'] = $newlogin;     
                                                                   
                    
                }

                else {                                  // AFFICHE LERREUR SI BUG
                    $err_modiflogin = "Le login n'a pas pu être modifié." ;
                }
            }

        }   
        
        // PARTIE MDP  ---------------------------------------------------------------------------------------------------------------


        $validmdp = (boolean) true ;                                                          // SI TRUE = PAS DERREUR ALORS LANCE LA REQUETE
        $openmdp = 0 ;                                                                        // FORMULAIRE CACHE PAR DEFAUT

        if (isset($_POST['mdpform'])) {                                                       // AFFICHAGE DU FORMULAIRE DU Login

            $openmdp = 1 ;  
        }    

        if (isset($_POST['modifmdp'])) {


            $openmdp = 1 ;                                                                    // GARDE LE FORMULAIRE OUVERT SI ERREURS

            // VARIABLES DU POST

            $actualmdp = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['actualmdp']));
            $newmdp = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['newmdp'])) ;
            $confirmmdp = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['confirmmdp'])) ;



            //-------------------------------------------------VERIF DES ERREURS MDP

            $sql = "SELECT * FROM utilisateurs WHERE password = '".md5($actualmdp)."' && login = '".$_SESSION['login']."'"; // REQUETE VERIF ACTUAL MDP

            $testmdp = mysqli_query($mysqli, $sql);

            $resultmdp = mysqli_num_rows($testmdp);

            if(empty($actualmdp)) {                                                                                     //VERIF SI ACTUEL MDP REMPLI
                $err_actualmdp = "Veuillez renseigner votre mot de passe actuel.";
                $validmdp = false;
                $actualmdp = "";
            }



            elseif ($resultmdp == 0) {                                                                                            // SI PAS DE RESULTAT => VALID FAUX
                $err_actualmdp = "Le mot de passe actuel est incorrect.";
                $validmdp = false;
                $actualmdp = "";
            }


            
            if(empty($newmdp)) {                                                              // VERIF SI NEW MDP REMPLI
                $err_newmdp = "Veuillez renseigner votre nouveau mot de passe.";
                $validmdp = false;
                $newmdp = "";
            }

            //                                                                                 // test ENTRE 8 ET 20 CARACTERES au moins 1 majuscule/miniscule/chiffres/caracspec

            elseif(!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/', $newmdp)) {
                $err_newmdp = "Le nouveau mot de passe ne respecte pas les conditions.*";
                $validmdp = false;
                $newmdp = "";

            }

            elseif(empty($confirmmdp)) {                                                               // TEST CONFIRM MDP si vide

                $err_confirmmdp = "Veuillez confirmer votre mot de passe";
                $validmdp = false;
                $confirmmdp = "";

            }
            

            elseif($newmdp != $confirmmdp) {     
                // TESTS SI MDP ET CONFIRM MDP PAREILS
                $err_confirmmdp ="Les mots de passe ne correspondent pas.";
                $validmdp = false;
                $confirmmdp = "";



            }



            //------------------------------------------- REQUETE MODIF MDP SI PAS DERREURS

            if($validmdp) {

                $requestmdp = "UPDATE utilisateurs SET password= '".md5($newmdp)."' WHERE login = '".$_SESSION['login']."'" ;

                if(mysqli_query($mysqli, $requestmdp)) {
                    $newmdpok = "Le mot de passe a bien été modifié";
                    
                    $openmdp = 0;                                                             // FERME LE FORMULAIRE MDP SI MODIF OK
                }

                else {                               // AFFICHE LERREUR SI BUG
                    $err_modifmdp = "Le login n'a pas pu être modifié." ;
                }
            }

        }
    }   

    


?>


<html>
    <head>
        <meta charset="utf-8">
        <title>Profil</title>

    </head>

    <body>

        <!-- RAJOUTER LE HEADER -->

        <main>
              
            <section class="content">

                <h1 class="titre"><?php if(isset($_SESSION['login'])) echo $_SESSION['login'] ?></h1>

                <p class="intro"> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam odio, 
                    tempore saepe repellat vel consequatur sit. Nihil earum expedita enim iure alias illum nisi 
                    exercitationem architecto modi nesciunt. Voluptatum, aperiam? 
                </p>

                <!-- FORMULAIRE DE MODIFICATION LOGIN -->
                
                <div class="boxmodif">

                    <div id="loginstyle">

                        <form action="profil.php" method="post" class="styleform">
                            <div><input type="submit" name="loginform" value="Modifier le login" id="openlogin"></div>
                        </form>

                        <?php if ($openlogin == 1) { ?>

                            <form action ='profil.php' method='post' class='styleform'> 

                                <div class="formerror"><?php if(isset($err_newlogin)) { echo $err_newlogin;} ?></div>
                                <div><input type='text' name='newlogin' placeholder='Nouveau login' value='<?php echo $newlogin;?>'></div>

                                <div class="formerror"><?php if(isset($err_confirmlogin)) { echo $err_confirmlogin ;} ?></div>
                                <div><input type='text' name='confirmlogin' placeholder='Confirmez le nouveau login' value='<?php echo $confirmlogin;?>'></div><br>

                                <div class="formerror"><?php if(isset($err_2logins)) { echo $err_2logins ;} ?></div>
                                <div class="formerror"><?php if(isset($err_modiflogin)) { echo  $err_modiflogin ;} ?></div>

                                <div><input type='submit' name='modiflogin' value='Modifier'></div>

                                <div class="reglesmodif">Login : uniquement en lettres miniscules ou chiffres, sans caractères spéciaux, 25 caractères maximum.</div>
                            </form>

                        <?php ;}?>

                        <p class="message"><?php if (isset($newloginok)) { echo $newloginok ;} ?></p>
                        
                    </div>
                

                    <!-- FORMULAIRE DE MODIFICATION MDP -->


                    <div id="mdpstyle">

                        <form action="profil.php" method="post" class="styleform">
                            <div><input type="submit" name="mdpform" value="Modifier le mot de passe" id="openmdp"></div>
                        </form>

                        <?php if ($openmdp == 1) { ?>

                            <form action ='profil.php' method='post' class='styleform' id="passformstyle">

                                <div class="formerror"><?php if(isset($err_actualmdp)) { echo $err_actualmdp;} ?></div>
                                <div><input type='password' name='actualmdp' placeholder='Mot de passe actuel' value='<?php echo $actualmdp;?>'></div>

                                <div class="formerror"><?php if(isset($err_newmdp)) { echo  $err_newmdp ;} ?></div>
                                <div><input type='password' name='newmdp' placeholder='Nouveau mot de passe' value='<?php echo $newmdp;?>'></div>

                                <div class="formerror"><?php if(isset($err_confirmmdp)) { echo $err_confirmmdp ;} ?></div>
                                <div><input type='password' name='confirmmdp' placeholder='Confirmez le nouveau mot de passe' value='<?php echo $confirmmdp;?>'></div><br>

                                <div class="formerror"><?php if(isset($err_modifmdp)) { echo  $err_modifmdp ;} ?></div>
                                <div><input type='submit' name='modifmdp' value='Modifier' id="butmdp"></div>

                                <div class="reglesmodif">Mot de passe : entre 8 et 20 caractères, avec au moins 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial.</div>

                            </form>

                        <?php ;}?>

                        <p class="intro"><?php if (isset($newmdpok)) { echo $newmdpok ;} ?></p>
                        
                    </div>
                </div>
 
            </section>

                

        </main>

        <!-- RAJOUTER LE FOOTER  -->
            
    </body>
</html>











