<?php
    require_once('fonctions.php');

    $nom_document= $_POST['nom_document'];
    $idType_Document = $_POST['idType_Document'];
    $idProcessus = $_POST['idProcessus'];
    $idSous_Processus = $_POST['idSous_Processus'];


    if ($categorie !="NULL" && $acronime !="NULL" && $nom_equi !=NULL ){

        $sql = "INSERT INTO `document` (nomDocument) VALUES ('$nom_document')";
        $prep = $pdo->prepare($sql);
        $prep->execute();

        $idequipement =$pdo->lastInsertId();

        //$sql2 = "INSERT INTO `` () VALUES ('$categorie','$idequipement','$acronime')";
        //$prep2 = $pdo->prepare($sql2);
        //$prep2->execute();

        header('Location: ajout-document.php?succes');
    }

    else
        header('Location: ajout-document.php?erreur');
?>
