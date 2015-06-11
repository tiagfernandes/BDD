<?php
    require_once('fonctions.php');

?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

   <head>
    <title>Ajout utilisateur</title>
    <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>


   <body>

    <?php require_once('entete.php'); ?>
        <div id="contenu">
         <div id="banniere">
              Ajout d'un utilisateur
          </div>
          <div id="form-ajout"><fieldset>
               <legend>Ajout utilisateur</legend>

        <form method="post" action="add.php">

            <label id="ajout_element">Nom : </label><input type="text" name="nom_user" placeholder="Nom"></p>

            <label id="ajout_element">Prénom : </label><input type="tex" name="prenom_user" placeholder="Prénom"></p>
            <label id="ajout_element">E-mail : </label><input type="email" name="mail_user" placeholder="Email"></p>
            <label id="ajout_element">Login : </label><input type="text" name="login_user" placeholder="Login"></p>
            <label id="ajout_element">Mot de passe : </label><input type="password" name="mdp_user" placeholder="Mot de passe"></p>
            <label id="ajout_element">Rôle : </label>
            <select name="role_user" >
                <option value=NULL>-- Rôle --</option>
                <option value="Utilisateur">Utilisateur</option>
                <option value="Développeur">Développeur</option>
                <option value="Administrateur">Administrateur</option>
            </select>
            </p>

            <div id ="erreur">
                </p><?php
                $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                if ($monUrl == "http://localhost/BDD/Site/add_user.php?erreur"){
                    echo ("Veuilliez saisir tous les champs ");
                }

                else if ($monUrl == "http://localhost/BDD/Site/add_user.php?login"){
                    echo ("Login déjà utilisé ");
                }
            ?>
            </div>
            <input class="bouton" type="submit" value="Ajouter">
          </form>
          </div>
        </fieldset>
        </div>
    </body>
</html>
