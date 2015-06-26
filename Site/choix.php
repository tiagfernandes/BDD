<?php
    require_once('fonctions.php');
?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

    <head>
    	<title>Ajout</title>
    		<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="stylesheet" type="text/css" href="style.css">
    </head>


    <body>
		<?php require_once('entete.php'); ?>
				<div id="contenu">
					<div id="banniere">Ajout</div>

						<div id="choix_ajout">
							<a class="equipement" href="ajout-element.php">Equipement</a></br>
							<a class="document" href="ajout-document.php">Document</a></br>
							<a class="ajout-categorie" href="ajout-categorie.php">Catégorie étiquette</a></br>
							<a class="ajout-acr" href="ajout-categorie.php">Acronime equipement</a></br>
						</div>
				</div>

    </body>
</html>
