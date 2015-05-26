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

        <div><h2>Ajout d'un équipement</h2>
          <form method="post" action="">

            <label>Nom équipement : </label><input type="text" name="nom_equipement" placeholder="Nom"></p>
            <label>Etiquette : </label><input type="text" name="etiquette" placeholder="Etiquette"></p>
            <label>Catégorie : </label></p>
            <select name="Catégorie">
                <option value=0>-- Catégorie --</option>
                <option value="">Capteur</option>
                <option value="">Moteur</option>
             </select>
            <input class="bouton" type="submit" value="Ajouter">
          </form>

        </div>
    </body>
</html>
