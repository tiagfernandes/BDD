<?php
    require_once('fonctions.php');

    session_start ();
?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

   <head>
    <title>Ajout document</title>
    <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>


   <body>

    <?php require_once('entete.php'); ?>
        <div id="contenu">
            <div id="banniere">Ajout d'un document</div>
                <div id="form-ajout">
                    <fieldset><legend>Fiche document</legend>

                        <form method="post" action="ajout.php">


                        </form>

                    </fieldset>
                </div>
    </body>
</html>
