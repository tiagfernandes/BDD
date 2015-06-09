<?php
    require_once('fonctions.php');
    session_start ();
?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

   <head>
    <title>Profil</title>
    <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>


    <body>
    <?php require_once('entete.php'); ?>
        <div>
               <?php
                $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                if ($monUrl == "http://localhost/BDD/Site/profil.php?erreur"){
                    $message="Echec lors de la modification !";
                    echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
                }
            ?>
        </div>
        <!--Affichage des données utilisateur-->
        <div id="contenu">
            <div id="banniere">
                Votre profil :
            </div>
            <img src="image/avatar/dbz.jpg"  alt="Avatar" id="avatar">
            <div id ="parcourir"><form method="POST" action="upload.php" enctype="multipart/form-data">
                 Image : <input type="file" name="avatar"></p>
                 <input id="ajout-img" type="submit" name="envoyer" value="Actualiser">
            </form></div>
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
                <p>
                <?php  echo "Rôle : ".$_SESSION['role'].""; ?>
                </div>
            </div>
            <a href="update.php" class="btn" id="bmodif">Modifier profil</a>
        </div>
    </body>
</html>
