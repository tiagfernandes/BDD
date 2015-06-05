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
        <div id="contenu">
            <div id="banniere">
                Ajout :
            </div>
            <div >
                <a class="equipement" href="ajout-element.php">Equipement</a>
                </br>
                <a class="document"href="ajout-document.php">Document</a>
            </div>
        </div>
    </body>
</html>
