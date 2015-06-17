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

        header('Location: fiche-vie.php?anomalie=succes');
    }

    else
        header('Location: fiche-vie.php?anomalie=erreur');

?>
