<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'a-calibration.php', permet l'insersion d'une nouvelle calibration a
un équipement.
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

	$idEquipement = $_GET['idEquipement'];

    $description = $_POST['description'];
    $datecalibration = $_POST['datecalibration'];

    $nom="Calibration";

    if (!empty($description) && !empty($datecalibration)){

        $sql = "INSERT INTO `calibration` (nomCalibration, descriptionCalibration, dateCalibration, idUtilisateur) VALUES ('$nom', '$description', '$datecalibration', '".$_SESSION['idUtilisateur']."')";
        $prep = $pdo->prepare($sql);
        $prep->execute();

        $idCalibration =$pdo->lastInsertId();

         $sql2 = "INSERT INTO `fiche_de_vie_has_calibration` (idCalibration, idFicheDeVie) VALUES ('$idCalibration', '$idEquipement')";
         $prep2 = $pdo->prepare($sql2);
         $prep2->execute();

        header('Location: fiche-vie.php?idEquipement='.$idEquipement.'&calibration=succes');
    }

    else
        header('Location: fiche-vie.php?idEquipement='.$idEquipement.'&calibration=erreur');

?>
