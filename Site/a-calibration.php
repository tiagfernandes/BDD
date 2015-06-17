<?php
    require_once('fonctions.php');

    $description = $_POST['description'];
    $datecalibration = $_POST['datecalibration'];
    $nom="Calibration";

    if (!empty($description) && !empty($datecalibration)){

        $sql = "INSERT INTO `calibration` (nomCalibration,descriptionCalibration, dateCalibration,idUtilisateur) VALUES ('$nom','$description','$datecalibration','".$_SESSION['idUtilisateur']."')";
        $prep = $pdo->prepare($sql);
        $prep->execute();

        header('Location: fiche-vie.php?calibration=succes');
    }

    else
        header('Location: fiche-vie.php?calibration=erreur');

?>
