<!doctype html>
<html lang="fr">

    <head>
    <title>Connexion</title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
        <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <font><form action="formulaire-co.php" method="post" class="connexion">
            <img src="image/logo_ecotron.png" class="logo_ecotron">
            <img src="image/logo_cnrs.png" class="logo_cnrs">
            <img src="image/logo_ens.jpg" class="logo_ens">
                <hr width=335 align=left>
            <label>Votre login : </label><input type="text" name="login" placeholder="Ex: Dupont"></p>
            <label>Votre mot de passe : </label><input type="password" name="pwd"></p>
            <input class="bouton" type="submit" value="Se connecter">
        </form></font>
    <?php
    header('Content-Type: text/html; charset=utf-8');

    $login_valide = "root";
    $pwd_valide = "sio";

    if (isset($_POST['login']) && isset($_POST['pwd'])) {

        if ($login_valide == $_POST['login'] && $pwd_valide == $_POST['pwd']) {
            session_start ();
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['pwd'] = $_POST['pwd'];
            header ('location: page_membre.php');
        }

        else {
            echo '<body onLoad="alert(\'Identifiant ou mots de passe incorrect.\')">';

            //echo '<meta http-equiv="refresh" content="0;URL=formulaire-co.php">';
        }
    }
    else {
        echo '<body onLoad="alert(\'Entrez un champs.\')">';
    }
    ?>


    </body>
</html>
