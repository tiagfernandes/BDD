<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'update_planning.php', modifie la calibration ou l'anomalie ou
l'entretien choisis.
---------------------------------------------------------------------------
L'utilisateur :
Autorisé.
---------------------------------------------------------------------------
Le développeur :
Autorisé.
---------------------------------------------------------------------------
L'administrateur :
Autorisé.
------------------------------------------------------------------------ */

    require_once('fonctions.php');

	$idEquipement = $_GET['idEquipement'];

	if ($_GET['nom'] == 'Calibration') {

		$sql = "UPDATE calibration
				SET dateCalibration = :date,
				finCalibration = :dateFin,
				descriptionCalibration = :description
				WHERE idCalibration = :id
				";

		$stmt = $pdo->prepare($sql);

		$stmt->bindValue(':date', $_POST['date'], PDO::PARAM_STR);
		$stmt->bindValue(':dateFin', $_POST['dateFin'], PDO::PARAM_STR);
		$stmt->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
		$stmt->bindValue(':id', $_GET['id'], PDO::PARAM_STR);

		$stmt->execute();

		header ("location: fiche-vie.php?idEquipement=$idEquipement");
	}

	else if ($_GET['nom'] == 'Anomalie') {

		$sql = "UPDATE anomalie
				SET dateAnomalie = :date,
				finAnomalie = :dateFin,
				descriptionAnomalie = :description
				WHERE idAnomalie = :id
				";

		$stmt = $pdo->prepare($sql);

		$stmt->bindValue(':date', $_POST['date'], PDO::PARAM_STR);
		$stmt->bindValue(':dateFin', $_POST['dateFin'], PDO::PARAM_STR);
		$stmt->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
		$stmt->bindValue(':id', $_GET['id'], PDO::PARAM_STR);

		$stmt->execute();

		header ("location: fiche-vie.php?idEquipement=$idEquipement");
	}

	if ($_GET['nom'] == 'Entretien') {

		$sql = "UPDATE entretien
				SET dateEntretien = :date,
				finEntretien = :dateFin,
				descriptionEntretien = :description
				WHERE idEntretien = :id
				";

		$stmt = $pdo->prepare($sql);

		$stmt->bindValue(':date', $_POST['date'], PDO::PARAM_STR);
		$stmt->bindValue(':dateFin', $_POST['dateFin'], PDO::PARAM_STR);
		$stmt->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
		$stmt->bindValue(':id', $_GET['id'], PDO::PARAM_STR);

		$stmt->execute();

		header ("location: fiche-vie.php?idEquipement=$idEquipement");
	}
?>
