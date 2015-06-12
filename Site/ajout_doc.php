<?php
    require_once('fonctions.php');

    $nom_document= $_POST['nom_document'];
    $idType_Document = $_POST['type'];
    $idProcessus = $_POST['processus'];
    $idSous_Processus = $_POST['s_processus'];


    if ($nom_document !="NULL" && $idType_Document!="NULL" && $idProcessus!="NULL" && $idSous_Processus!="NULL"){

        $sql = "INSERT INTO `etiquette_document` (idType_Document, idProcessus, idSous_Processus) VALUES ('$idType_Document', '$idProcessus', '$idSous_Processus')";
        $prep = $pdo->prepare($sql);
        $prep->execute();

        $idEtiquette_Document =$pdo->lastInsertId();

        $sql2 = "INSERT INTO `document` (idEtiquette_Document, nomDocument) VALUES ('$idEtiquette_Document','$nom_document')";
        $prep2 = $pdo->prepare($sql2);
        $prep2->execute();

        header('Location: ajout-document.php?succes');
    }

    else
        header('Location: ajout-document.php?erreur');
?>
