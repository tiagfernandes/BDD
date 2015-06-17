<?php
    require_once('fonctions.php');

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
            <a class="anomalie" href="ajout-anomalie.php">Anomalie</a></br>
            <a class="calibration" href="ajout-calibration.php">Calibration</a></br>
            <a class="entretien" href="ajout-entretien.php">Entretien</a></br>
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
    </body>
</html>
