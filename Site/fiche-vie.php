<?php
    require_once('fonctions.php');
    $listePlanning= getPlanning($pdo);
	$idEquipement = $_GET['idEquipement'];

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
            <a class="anomalie" href="ajout-anomalie.php">Anomalie</a>
            <a class="calibration" href="ajout-calibration.php">Calibration</a>
            <a class="entretien" href="ajout-entretien.php">Entretien</a></br>
            <a class="entretien" href="reservation.php?idEquipement=<?= $idEquipement; ?>">Réserver l'équipement</a></br>
            <div id ="succes">
                <?php
                $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                if ($monUrl == "http://localhost/BDD/Site/fiche-vie.php?anomalie=succes"){
                 echo ("Anomalie ajouté avec succès");
                }
                else if ($monUrl == "http://localhost/BDD/Site/fiche-vie.php?calibration=succes"){
                 echo ("Calibration ajouté avec succès");
                }
                else if ($monUrl == "http://localhost/BDD/Site/fiche-vie.php?entretien=succes"){
                 echo ("Entretien ajouté avec succès");
                }
                ?>
            </div>
            <div id ="erreur">
                <?php
                $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                if ($monUrl == "http://localhost/BDD/Site/fiche-vie.php?anomalie=erreur"){
                 echo ("Erreur lors de l'ajout de l'anomalie ");
                }
                else if ($monUrl == "http://localhost/BDD/Site/fiche-vie.php?calibration=erreur"){
                 echo ("Erreur lors de l'ajout de la calibration ");
                }
                else if ($monUrl == "http://localhost/BDD/Site/fiche-vie.php?entretien=erreur"){
                 echo ("Erreur lors de l'ajout de l'entretien ");
                }
                ?>

            </div>

                <table class="tableau-vie" border=2>
						<th>Id</th>
				        <th>Nom</th>
				        <th>Date</th>
				        <th>Créateur</th>

                        <?php foreach ($listePlanning as $cle=>$valeur): ?>
							<tr>
								<?php foreach ($valeur as $val): ?>
								    <td><?= htmlentities($val) ?></td>
								<?php endforeach; ?>
							</tr>

						 <?php endforeach; ?>
				</table>

				<table class="" border=2>
						<th>id</th>
						<th>Date début</th>
				        <th>Date fin</th>
				        <th>Plateforme</th>
				        <th>Lieu</th>
				        <th>Pièce</th>
				        <th>Fonction principal</th>
				        <th>Fonction secondaire</th>
				        <th>Nom utilisateur</th>
				        <th>Prénom utilisateur</th>

                        <?php foreach ($listePlanningOccupation as $cle=>$valeur): ?>
							<tr>
								<?php foreach ($valeur as $val): ?>
								    <td  style="cursor: pointer;" onClick="window.open('update_reservation.php?id=<?= $idEquipement;?>')"><?= htmlentities($val) ?></td>
								<?php endforeach; ?>
							</tr>
						<?php endforeach; ?>
				</table>
		</div>
    </body>
</html>
