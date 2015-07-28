<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'add.php', permet l'insersion d'un nouveau équipement.
---------------------------------------------------------------------------
L'utilisateur :
Ne peut rien faire.
---------------------------------------------------------------------------
Le développeur :
Autorisé.
---------------------------------------------------------------------------
L'administrateur :
Autorisé.
------------------------------------------------------------------------ */

    require_once('fonctions.php');

    $nom_user= $_POST['nom_user'];
    $prenom_user = $_POST['prenom_user'];
    $mail_user = $_POST['mail_user'];
    $login_user = $_POST['login_user'];
    $mdp_user = $_POST['mdp_user'];
    $role_user = $_POST['role_user'];

    if ($nom_user !=NULL && $prenom_user !=NULL && $mail_user !=NULL && $login_user !=NULL && $mdp_user !=NULL && $role_user !=NULL){

        $req = $pdo->prepare('SELECT * FROM utilisateur WHERE login = :login');
        $req->execute(array('login'=> $login_user));
        $resultat=$req->fetch();

        if(!$resultat){

            $sql = "INSERT INTO `utilisateur` (nomUtilisateur,prenomUtilisateur,email,login,password,role) VALUES ('$nom_user','$prenom_user','$mail_user','$login_user','$mdp_user','$role_user')";
            $prep = $pdo->prepare($sql);
            $prep->execute();
            header('Location: admin.php');

        }

        else{
            header('Location: add_user.php?login ');
        }
    }

    else
        header('Location: add_user.php?erreur');
?>
