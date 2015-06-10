<?php
    require_once('fonctions.php');

    session_start ();

    $idDocument=$_GET['idDocument'];
?>
<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

   <head>
    <title>Fiche Equipement</title>
    <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="style.css">

       <script language="Javascript">
        function imprimer(){window.print();}
       </script>
    </head>


    <body>
        <?php require_once('entete.php'); ?>
            <div id ="contenu">
                <div id="banniere">Fiche document</div>
                    <?php	//fonction pour afficher le nom de l'équipement
                        $resultats=$pdo->query("SELECT nomDocument FROM document WHERE idDocument='$idDocument'");
                        $resultats->setFetchMode(PDO::FETCH_OBJ);
                        while( $resultat = $resultats->fetch() )
                        {
                            echo 'Nom : '.$resultat->nomDocument.'<br>';
                        }
                        $resultats->closeCursor();
                    ?>

            </div>
    </body>
</html>
