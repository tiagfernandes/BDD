<?php
    require_once('fonctions.php');

    session_start ();

    $idEquipement=$_GET['idEquipement']

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
                <div id="banniere">Fiche équipement</div>

                    <?php
                        $resultats=$pdo->query("SELECT nomEquipement FROM equipement WHERE idEquipement='$idEquipement'");
                        $resultats->setFetchMode(PDO::FETCH_OBJ);
                        while( $resultat = $resultats->fetch() )
                        {
                            echo 'Nom : '.$resultat->nomEquipement.'<br>';
                        }
                        $resultats->closeCursor();
                    ?>

                    <?php
                        $resultats=$pdo->query("SELECT marque FROM equipement WHERE idEquipement='$idEquipement'");
                        $resultats->setFetchMode(PDO::FETCH_OBJ);
                        while( $resultat = $resultats->fetch() )
                        {
                            echo 'Marque : '.$resultat->marque.'<br>';
                        }
                        $resultats->closeCursor();
                    ?>

                    <?php
                        $resultats=$pdo->query("SELECT dateAjout FROM equipement WHERE idEquipement='$idEquipement'");
                        $resultats->setFetchMode(PDO::FETCH_OBJ);
                        while( $resultat = $resultats->fetch() )
                        {
                            echo "Date d'ajout : ".$resultat->dateAjout."<br>";
                        }
                        $resultats->closeCursor();
                    ?>
                    <?php
                        $resultats=$pdo->query("SELECT prix FROM equipement WHERE idEquipement='$idEquipement'");
                        $resultats->setFetchMode(PDO::FETCH_OBJ);
                        while( $resultat = $resultats->fetch() )
                        {
                            echo 'Prix : '.$resultat->prix.' €<br>';
                        }
                        $resultats->closeCursor();
                    ?>
                <img src="http://chart.apis.google.com/chart?cht=qr&chs=100x100&chl=http://localhost/BDD/Site/equipement.php?idEquipement=<?= $idEquipement ?>">
            </div>
    </body>
</html>
