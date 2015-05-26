<?php
    require_once('fonctions.php');
    session_start ();
?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

   <head>
    <title>Index</title>
    <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>


    <body>
    <?php require_once('entete.php'); ?>
        <div id="contenu">
            <div id="banniere">
                <em>Votre profil </em>
            </div>
            <img src="image/boba.jpg" alt="Avatar" id="avatar">
            <div id ="infos">
               <div id ="donnees">
                <?php  echo "Nom : ".$_SESSION['nom'].""; ?>
                <p>
                <?php  echo "Prénom : ".$_SESSION['prenom'].""; ?>
                <p>
                <?php  echo "Mail : ".$_SESSION['email'].""; ?>
                <p>
                <?php  echo "Identifiant : ".$_SESSION['login'].""; ?>
                <p>
                <?php  echo "Mot de passe : ".$_SESSION['password'].""; ?>
                </div>
            </div>
            <a href="update.php" class="btn" id="bmodif">Modifier profil</a>
        </div>
    </body>
</html>
