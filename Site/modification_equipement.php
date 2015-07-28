<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'fiche-vie.php', affiche toutes les anomalies, calibrations,
entretien de l'équipement, ainsi que les réservation de l'équipement.
---------------------------------------------------------------------------
L'utilisateur :
N'est pas autorisé.
---------------------------------------------------------------------------
Le développeur :
Autorisé.
---------------------------------------------------------------------------
L'administrateur :
Autorisé.
------------------------------------------------------------------------ */

    require_once('fonctions.php');

	$idEquipement = $_GET['idEquipement'];

	$sql = "UPDATE equipement
            SET nomEquipement = :nom,
            prix = :prix,
            idFournisseur = :fournisseur,
            marque = :marque,
            dateFabrication = :fabrication,
            dateReception = :reception,
            dateMiseService = :miseService,
            garantie = :garantie,
            responsable = :responsable,
            nomVariableAutomate = :variableAutomate,
            adresseAutomate = :adresseAutomate,
            idStoc = :idStoc,
            nFabrication = :nFabrication,
            attestationExamen = :attestationExamen,
            contratEntretien = :contratEntretien,
            suppleant = :suppleant,
            observation = :observation
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
    $stmt->bindValue(':responsable', $_POST['newResponsable'], PDO::PARAM_STR);
    $stmt->bindValue(':variableAutomate', $_POST['newVariableAutomate'], PDO::PARAM_STR);
    $stmt->bindValue(':adresseAutomate', $_POST['newAdresseAutomate'], PDO::PARAM_STR);
    $stmt->bindValue(':idStoc', $_POST['newIdStoc'], PDO::PARAM_STR);
    $stmt->bindValue(':nFabrication', $_POST['newFabrication'], PDO::PARAM_STR);
    $stmt->bindValue(':attestationExamen', $_POST['newAttestationExamen'], PDO::PARAM_STR);
    $stmt->bindValue(':contratEntretien', $_POST['newContratEntretien'], PDO::PARAM_STR);
    $stmt->bindValue(':suppleant', $_POST['newSuppleant'], PDO::PARAM_STR);
    $stmt->bindValue(':observation', $_POST['newObservation'], PDO::PARAM_STR);
    $stmt->bindValue(':fournisseur', $_POST['newFournisseur'], PDO::PARAM_STR);

    $stmt->execute();

    header ('location: equipement.php?idEquipement='.$idEquipement.'&update');
?>
