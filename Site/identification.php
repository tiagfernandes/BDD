<?php
    header('Content-Type: text/html; charset=utf-8');

    $login_valide = "root";
    $pwd_valide = "sio";

    if (empty($_POST['login']) && empty($_POST['pwd'])) {

        echo '<body onLoad="alert(\'Entrez un champs.\')">';
        echo '<meta http-equiv="refresh" content="0;URL=formulaire-co.php">';
        header ('location: formulaire-co.php');

    }

    else {

        if ($login_valide == $_POST['login'] && $pwd_valide == $_POST['pwd']) {
            session_start ();
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['pwd'] = $_POST['pwd'];
            header ('location: page_membre.php');
        }

        else
            header ('location: formulaire-co.php');
            echo '<body onLoad="alert(\'Identifiant ou mots de passe incorrect.\')">';

        }

    ?>
