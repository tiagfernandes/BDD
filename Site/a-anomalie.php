<?php
    require_once('fonctions.php');

    $description = $_POST['description'];
    $datedebut = $_POST['datedano'];
    $datefin = $_POST['datefano'];
    $nom="Anomalie";

    if (!empty($description) && !empty($datedebut)){

        $sql = "INSERT INTO `anomalie` (nomAnomalie,dateAnomalie, finAnomalie, description,idUtilisateur) VALUES ('$nom','$datedebut','$datefin','$description','".$_SESSION['idUtilisateur']."')";
        $prep = $pdo->prepare($sql);
        $prep->execute();

        $idAnomalie =$pdo->lastInsertId();

         $sql2 = "INSERT INTO `fiche_de_vie_has_anomalie` (idAnomalie) VALUES ('$idAnomalie')";
         $prep2 = $pdo->prepare($sql2);
         $prep2->execute();

        header('Location: fiche-vie.php?anomalie=succes');
    }

    else
        header('Location: fiche-vie.php?anomalie=erreur');

?>
