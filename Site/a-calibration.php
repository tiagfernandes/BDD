<?php
    require_once('fonctions.php');

    $description = $_POST['description'];
    $datecalibration = $_POST['datecalibration'];
    $nom="Calibration";

    if (!empty($description) && !empty($datecalibration)){

        $sql = "INSERT INTO `calibration` (nomCalibration,descriptionCalibration, dateCalibration,idUtilisateur) VALUES ('$nom','$description','$datecalibration','".$_SESSION['idUtilisateur']."')";
        $prep = $pdo->prepare($sql);
        $prep->execute();

        $idCalibration =$pdo->lastInsertId();

         $sql2 = "INSERT INTO `fiche_de_vie_has_calibration` (idCalibration) VALUES ('$idCalibration')";
         $prep2 = $pdo->prepare($sql2);
         $prep2->execute();

        header('Location: fiche-vie.php?calibration=succes');
    }

    else
        header('Location: fiche-vie.php?calibration=erreur');

?>
