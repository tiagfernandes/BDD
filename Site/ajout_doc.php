<?php
    require_once('fonctions.php');

    $nom_document= $_POST['nom_document'];
    $idType_Document = $_POST['type'];
    $idProcessus = $_POST['processus'];
    $idSous_Processus = $_POST['s_processus'];
    $idEtiquette_Equipement = $_POST['idEtiquetteEquipement'];

	$resultats = $pdo->query("SELECT `idEquipement` FROM `etiquette_equipement` WHERE `idEtiquette_Equipement`='$idEtiquette_Equipement'");
	$resultat = $resultats->fetch(PDO::FETCH_NUM);
	$idEquipement = $resultat[0];
	print($idEquipement);

print("$nom_document, $idType_Document, $idProcessus, $idSous_Processus, $idEtiquette_Equipement");

   	if ($nom_document !="NULL" && $idType_Document!="NULL" && $idProcessus!="NULL" && $idSous_Processus!="NULL" && $idEtiquette_Equipement!="NULL"){

        $sql = "INSERT INTO `etiquette_document` (idType_Document, idProcessus, idSous_Processus, idEtiquette_Equipement) VALUES ('$idType_Document', '$idProcessus', '$idSous_Processus', '$idEtiquette_Equipement')";
        $prep = $pdo->prepare($sql);
        $prep->execute();

        $idEtiquette_Document =$pdo->lastInsertId();

        $sql2 = "INSERT INTO `document` (idEtiquette_Document, nomDocument) VALUES ('$idEtiquette_Document','$nom_document')";
        $prep2 = $pdo->prepare($sql2);
        $prep2->execute();

		$idDoc = $pdo->lastInsertId();

		$sql3 = "INSERT INTO `equipement_has_document` (idEquipement, idDocument) VALUES ('$idEquipement', '$idDoc')";
		$prep3 = $pdo->prepare($sql3);
        $prep3->execute();

        header('Location: ajout-document.php?succes');
   	}

   	else
        header('Location: ajout-document.php?erreur');
?>
