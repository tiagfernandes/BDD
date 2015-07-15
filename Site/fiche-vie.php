<?php
    require_once('fonctions.php');

	$idEquipement = $_GET['idEquipement'];

    $listePlanning= getPlanning($idEquipement);
	$listePlanningOccupation = getPlanningOccupation($idEquipement);

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
						if ($monUrl == "http://localhost/BDD/Site/fiche-vie.php?idEquipement='.$idEquipement.'&?anomalie=succes"){
						 echo ("Anomalie ajouté avec succès");

						}
						else if ($monUrl == "http://localhost/BDD/Site/fiche-vie.php?idEquipement='.$idEquipement.'&?calibration=succes"){
						 echo ("Calibration ajouté avec succès");
						}
						else if ($monUrl == "http://localhost/BDD/Site/fiche-vie.php?idEquipement='.$idEquipement.'&?entretien=succes"){
						 echo ("Entretien ajouté avec succès");
						}
						?>
					</div>


					<table class="tableau-vie" border=0.5>
							<th>Id</th>
							<th>Nom</th>
							<th>Date</th>
							<th>Créateur</th>
							<th>Description</th>

							<?php foreach ($listePlanning as $cle=>$valeur): ?>
								<tr>
									<?php foreach ($valeur as $val): ?>
										<?php $nom = $valeur['Nom']; ?>
										<?php $id = $valeur['Id']; ?>
										<?php $createur = $valeur['Createur']; ?>
										<td style="cursor: pointer;" onClick="window.open('planning.php?nom=<?= $nom;?>&?id=<?= $id;?>?createur=<?= $createur;?>')"><?= htmlentities($val) ?></td>
									<?php endforeach; ?>
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
										<td  style="cursor: pointer;" onClick="window.open('update_reservation.php?idEquipement=<?= $idEquipement;?>')"><?= htmlentities($val) ?></td>
									<?php endforeach; ?>
								</tr>
							<?php endforeach; ?>
					</table>
		</div>
    </body>
</html>
