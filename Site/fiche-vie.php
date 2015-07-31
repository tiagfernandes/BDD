<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'fiche-vie.php', affiche toutes les anomalies, calibrations,
entretien de l'équipement, ainsi que les réservation de l'équipement.
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

    $listePlanning= getPlanning($idEquipement);
	$listePlanningOccupation = getPlanningOccupation($idEquipement);

	if (isset($_GET['delete_reservation'])) { //Supprime la réservation
		$id = $_GET['delete_reservation'];
		deleteReservation($id);
	}

?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

	<head>
    	<title>Fiche de vie</title>
			<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
			<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
			<link rel="stylesheet" type="text/css" href="style.css">
    </head>


	<body>
    	<?php require_once('entete.php'); ?>

       		<div id="contenu">

            	<div id="banniere">Fiche de vie</div>

					<center><a class="Button" href="ajout-anomalie.php?idEquipement=<?= $idEquipement; ?>">Ajouter une anomalie</a>
					<a class="Button" href="ajout-calibration.php?idEquipement=<?= $idEquipement; ?>">Ajouter une calibration</a>
					<a class="Button" href="ajout-entretien.php?idEquipement=<?= $idEquipement; ?>">Ajouter un entretien</a></br></center>
					<a class="Reservation" href="reservation.php?idEquipement=<?= $idEquipement; ?>">Réserver l'équipement</a></br>

						<div id ="succes">
							<?php
								$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
								if ($monUrl == "http://localhost/BDD/Site/fiche-vie.php?idEquipement='.$idEquipement.'&anomalie=succes") {
									echo ("Anomalie ajouté avec succès");
								}
								else if ($monUrl == "http://localhost/BDD/Site/fiche-vie.php?idEquipement='.$idEquipement.'&calibration=succes") {
									echo ("Calibration ajouté avec succès");
								}
								else if ($monUrl == "http://localhost/BDD/Site/fiche-vie.php?idEquipement='.$idEquipement.'&entretien=succes") {
									echo ("Entretien ajouté avec succès");
								}
							?>
						</div>


						<table class="tableau-vie" border=0.5>

							<th>Id</th>
							<th>Nom</th>
							<th>Date</th>
							<th>Date de fin</th>
							<th>Créateur</th>
							<th>Description</th>

								<?php foreach ($listePlanning as $cle=>$valeur): ?>
									<tr>
										<?php foreach ($valeur as $val): ?>
											<?php $nom = $valeur['Nom']; ?>
											<?php $id = $valeur['Id']; ?>
											<?php $createur = $valeur['Createur']; ?>
											<td><?= htmlentities($val) ?></td>

										<?php endforeach; ?>
												<td width=20px>
													<a href="planning.php?idEquipement=<?= $idEquipement ?>&nom=<?= $nom;?>&id=<?= $id ?>&createur=<?= $createur ?>"><img class="modifier" border="0" alt="Image" src='./image/modifier.png'
													onClick="return(confirm('Modifier <?= $valeur['Nom']  ?> ?'));"/></a>
												</td>

									</tr>

								 <?php endforeach; ?>

						</table></p>

						<table class="" border=0.5>

							<th>id</th>
							<th>Date début</th>
							<th>Date fin</th>
							<th>Plateforme</th>
							<th>Lieu</th>
							<th>Pièce</th>
							<th>Fonction principal</th>
							<th>Fonction secondaire</th>
							<th>Utilisateur</th>

								<?php foreach ($listePlanningOccupation as $cle=>$valeur): ?>
									<tr>
										<?php foreach ($valeur as $val): ?>
											<td><?= htmlentities($val) ?></td>
										<?php endforeach; ?>

											<td width=20px>
												<a href="update_reservation.php?idEquipement=<?= $idEquipement ?>&&id=<?= $valeur['idPlanning_Occupation'] ?>&createur=<?= $valeur['nomUtilisateur'] ?>"><img class="modifier" border="0" alt="Image" src='./image/modifier.png'
												onClick="return(confirm('Modifier <?= $valeur['idPlanning_Occupation']  ?> ?'));"/></a>
											</td>

											<?php
												if ($_SESSION['role'] == 'Administrateur') {
											?>
													<td width=20px>
														<a href="fiche-vie.php?idEquipement=<?= $idEquipement ?>&delete_reservation=<?= htmlentities($valeur['idPlanning_Occupation']) ?>"><img class="poubelle" border="0" alt="Image" src='./image/poubelle1.png'
														onClick="return(confirm('Etes-vous sûr de vouloir supprimer la réservation n°<?= $valeur['idPlanning_Occupation'] ?> ?'));"/></a>
													</td>
											<?php
												}
											?>
									</tr>
								<?php endforeach; ?>

						</table>
			</div>
    </body>
</html>
