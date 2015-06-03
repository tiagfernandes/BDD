<?php
    require_once('fonctions.php');

    session_start ();


?>
<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

   <head>
    <title>Base de donnée ECOTRON</title>
    <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>


    <body>
        <?php require_once('entete.php'); ?>
            <div id ="contenu">
                <div id="banniere">Votre profil</div>

                    <p><?php $idEquipement=$_GET['idEquipement']?></p>
                    <?php  print_r($idEquipement);  ?>
            </div>
    </body>
</html>
