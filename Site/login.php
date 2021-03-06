<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'login.php', connexion de l'utilisateur.
---------------------------------------------------------------------------
L'utilisateur :
Autorisé.
---------------------------------------------------------------------------
Le développeur :
Autorisé.
---------------------------------------------------------------------------
L'administrateur :
Autorisé.
------------------------------------------------------------------------ */

    require_once('fonctions.php');
    // on teste si nos variables sont définies et remplies
    if (isset($_POST['login']) && isset($_POST['pwd']) && !empty($_POST['login'])&& !empty($_POST['pwd'])) {
    // on appele la fonction getAuthentification en lui passant en paramètre le login et password
    $result = getAuthentification($_POST['login'], $_POST['pwd']);

        // si le résulat est VRAI
        if($result){
            // on la démarre la session
            session_start ();
            // on enregistre les paramètres de notre visiteur comme variables de session
            $_SESSION['nom'] = $result['nomUtilisateur'];;
            $_SESSION['prenom'] = $result['prenomUtilisateur'];
            $_SESSION['idUtilisateur'] = $result['idUtilisateur'];
            $_SESSION['email']=$result['email'];
            $_SESSION['role'] = $result['role'];
            $_SESSION['login'] = $result['login'];
            $_SESSION['password'] = $result['password'];
            // on redirige notre visiteur vers une page de notre section membre
            header ('location: index.php');

        }
        //si le résultat est false on redirige vers la page d'authentification
        else{
            header ('location: authentification.php?erreur');
        }
    }
    //si nos variables ne sont pas renseignées on redirige vers la page d'authentification
    else {
        header ('location: authentification.php?erreur');
    }
?>
