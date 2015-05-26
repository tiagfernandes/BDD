<?php
    require_once('fonctions.php');
    session_start ();
?>

<!doctype html>
<html lang="fr">

    <head>
    <title>Modifier profil</title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
        <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <font><form action="maj.php" method="post" class="connexion">
            <img src="image/logo_ecotron.png" class="logo_ecotron">
            <img src="image/logo_cnrs.png" class="logo_cnrs">
            <img src="image/logo_ens.jpg" class="logo_ens">

                <hr width=335 align=left>
            <!--Mise a jour !-->
            <label>Nom : </label><input type="text" name="nnom" value="<?php  echo "".$_SESSION['nom']."";?>"></p>
            <label>Prénom : </label><input type="text" name="nprenom" value="<?php  echo "".$_SESSION['prenom']."";?>"></p>
            <label>Mail : </label><input type="text" name="nmail" value="<?php  echo "".$_SESSION['email']."";?>"></p>
            <label>Identifiant : </label><input type="text" name="nidentifiant" value="<?php  echo "".$_SESSION['login']."";?>"></p>
            <label>Mot de passe : </label><input type="text" name="nmdp" value="<?php  echo "".$_SESSION['password']."";?>"></p>
            <input class="bouton" type="submit" value="Modifier">
        </form></font>
    </body>
</html>
