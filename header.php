<?php 

$deconnexion = 0; 

if (isset($_SESSION['login'])){
    $deconnexion == 1;

    if(isset($deconnecter)){
        session_destroy();
    }

} 
?>

<header>

    <a href="index.php"><img id="logo_header" width="182px" height="130px" src="Assets/logo_salle.png" alt="logo"></a>
    
    <?php if ($deconnexion == 1) { ?>
    <a href="index.php" name="deconnecter"><img src="Assets/deco.png" width="200px" height="200px" alt="deconnexion"></a>
    <?php } ?> 
    
    <nav>
        <a href="inscription.php">INSCRIPTION</a>
        <a href="connexion.php">CONNEXION</a>
        <a href="profil.php">PROFIL</a>
        <a href="planning.php">PLANNING</a>
        <div id="indicator"></div>
    </nav>
    
</header>