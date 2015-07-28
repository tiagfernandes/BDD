<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'update-reservation.php', modification d'une réservation.
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


	$sql = "UPDATE planning_occupation
			SET dateDebut = :dateDebut,
			dateFin = :dateFin,
			fonctionPrincipal = :fonctionPrincipal,
			fonctionSecondaire = :fonctionSecondaire,
			idPlateforme = :plateforme,
			idLieu_Utilisation = :lieu,
			idPiece = :piece
			WHERE idPlanning_Occupation = :id
			";

	$stmt = $pdo->prepare($sql);

	$stmt->bindValue(':dateDebut', $_POST['dateDebut'], PDO::PARAM_STR);
	$stmt->bindValue(':dateFin', $_POST['dateFin'], PDO::PARAM_STR);
	$stmt->bindValue(':fonctionPrincipal', $_POST['fonctionPrincipal'], PDO::PARAM_STR);
	$stmt->bindValue(':fonctionSecondaire', $_POST['fonctionSecondaire'], PDO::PARAM_STR);
	$stmt->bindValue(':plateforme', $_POST['plateforme'], PDO::PARAM_STR);
	$stmt->bindValue(':lieu', $_POST['lieu'], PDO::PARAM_STR);
	$stmt->bindValue(':piece', $_POST['piece'], PDO::PARAM_STR);
	$stmt->bindValue(':id', $_GET['id'], PDO::PARAM_STR);

	$stmt->execute();

	header ("location: fiche-vie.php?idEquipement=$idEquipement");

?>
