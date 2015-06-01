<!doctype html>
<html lang="fr">

    <head> <!--Page d'autentification-->
    <title>Connexion</title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
        <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <font><form action="login.php" method="post" class="connexion">
            <img src="image/logo_ecotron.png" class="logo_ecotron">
            <img src="image/logo_cnrs.png" class="logo_cnrs">
            <img src="image/logo_ens.jpg" class="logo_ens">

                <hr width=335 align=left>
            <!--Connexion-->
            <label>Votre login : </label><input type="text" name="login" placeholder="Identifiant"></p>
            <label>Votre mot de passe : </label><input type="password" name="pwd" placeholder="Mot de Passe"></p>
            <div id ="succes">
               <?php
                $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                if ($monUrl == "http://localhost/BDD/Site/authentification.php?reco"){
                    echo ("Changement effectué avec succès , veuillez vous reconnectez ");
                }
                ?>
            </div>
            <div id ="erreur">
               <?php
                $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                if ($monUrl == "http://localhost/BDD/Site/authentification.php?erreur"){
                    echo ("Identifiant ou mot de passe incorrect ");
                }
                ?>
            </div>
            <input class="bouton" type="submit" value="Se connecter">
        </form></font>
    </body>
</html>
