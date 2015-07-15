<?php
    require_once('fonctions.php');

$idEquipement = $_GET['idEquipement'];

	$sql = "UPDATE equipement
            SET nomEquipement = :nom,
            prix = :prix,
            marque = :marque,
            dateFabrication = :fabrication,
            dateReception = :reception,
            dateMiseService = :miseService,
            garantie = :garantie
			WHERE idEquipement = :idEquipement
			";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':nom', $_POST['newNom'], PDO::PARAM_STR);
    $stmt->bindValue(':prix', $_POST['newPrix'], PDO::PARAM_STR);
    $stmt->bindValue(':marque', $_POST['newMarque'], PDO::PARAM_STR);
    $stmt->bindValue(':fabrication', $_POST['newDateFabrication'], PDO::PARAM_STR);
    $stmt->bindValue(':reception', $_POST['newDateReception'], PDO::PARAM_STR);
    $stmt->bindValue(':miseService', $_POST['newDateMiseService'], PDO::PARAM_STR);
    $stmt->bindValue(':garantie', $_POST['newGarantie'], PDO::PARAM_STR);
    $stmt->bindValue(':idEquipement', $_GET['idEquipement'], PDO::PARAM_STR);

    $stmt->execute();

    header ('location: equipement.php?idEquipement='.$idEquipement.'&?update');
?>
