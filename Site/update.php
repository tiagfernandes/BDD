<?php
    require_once('fonctions.php');

    session_start ();
?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

   <head>
    <title>Modifier Profil</title>
    <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>


   <body>

    <?php require_once('entete.php'); ?>
        <div id="contenu">
         <div id="banniere">
              Modification profil
          </div>
          <div id="form-ajout"><fieldset>
               <legend>Modifier</legend>

        <form method="post" action="maj.php">

            <label id="ajout_element">Nom : </label><input type="text" name="nnom" value="<?php  echo "".$_SESSION['nom']."";?>"></p>

            <label id="ajout_element">Prénom : </label><input type="tex" name="nprenom" value="<?php  echo "".$_SESSION['prenom']."";?>"></p>
            <label id="ajout_element">Mail : </label><input type="mail" name="nmail" value="<?php  echo "".$_SESSION['email']."";?>" ></p>
            <label id="ajout_element">Login : </label><input type="text" name="nidentifiant" value="<?php  echo "".$_SESSION['login']."";?>"></p>
            <label id="ajout_element">Mot de passe : </label><input type="text" name="nmdp" value="<?php  echo "".$_SESSION['password']."";?>"></p>
            </p>
            </div>
            <input class="bouton" onclick="return(confirm('Etes-vous sur de vouloir modifier votre profil ? '));" type="submit" value="Modifier">
          </form>
          </div>
        </fieldset>
        </div>
    </body>
</html>
