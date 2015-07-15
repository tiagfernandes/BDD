<?php
	require_once('fonctions.php');

	$dateDebut = $_POST['dateDebut'];
	$dateFin = $_POST['dateFin'];
	$plateforme = $_POST['plateforme'];
	$lieu = $_POST['lieu'];
	$piece = $_POST['piece'];
	$fonctionP = $_POST['fonctionP'];
	$fonctionS = $_POST['fonctionS'];
	$idEquipement = $_GET['idEquipement'];

	//Vérification de la saisie de lieu d'archive
if (!empty($dateDebut)){
	$sql = "INSERT INTO `planning_occupation` (dateDebut, dateFin, idPlateforme, idLieu_Utilisation, idPiece, fonctionPrincipal, fonctionSecondaire, idUtilisateur) VALUES ('$dateDebut', '$dateFin', '$plateforme', '$lieu', '$piece', '$fonctionP', '$fonctionS', ".$_SESSION['idUtilisateur'].")";
	$prep = $pdo->prepare($sql);
	$prep->execute();

	$idPlanning = $pdo->lastInsertId();

	$sql2 = "INSERT INTO `equipement_has_planning_occupation` (idEquipement, idPlanning_Occupation) VALUES ('$idEquipement', '$idPlanning')";
	$prep2 = $pdo->prepare($sql2);
	$prep2->execute();

	header('Location: fiche-vie.php?idEquipement='.$idEquipement.'');
}
else {
	header('Location: reservation.php?idEquipement='.$idEquipement.'&?erreur');
}
?>
