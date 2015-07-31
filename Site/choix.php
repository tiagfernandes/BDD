<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'choix.php', choix de la page de direction.
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
?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

    <head>
    	<title>Choix</title>
    		<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="stylesheet" type="text/css" href="style.css" />
    </head>


    <body>
		<?php require_once('entete.php'); ?>
			<div id="contenu">

				<div id="banniere">Choix</div>

					<div>
						<!-- Liste d'élément à sélectionner -->
						<ul>
							<li><a href="ajout-element.php">Equipement</a></li></br>
								<ul>
									<li><a href="ajout-categorie.php">Catégorie étiquette</a></li></br>
									<li><a href="ajout-acronime.php">Acronime equipement</a></li></br>
								</ul>
							<li><a href="ajout-document.php">Document</a></li></br>
								<ul>
									<li><a href="ajout-categorie.php">Archivage</a></li></br>
									<li><a href="ajout-etiquette_doc.php">Type - Processus - Sous-Processus</a></li></br>
								</ul>
							<li><a href="ajout-fournisseur.php">Fournisseur</a></li>
						</ul>

					</div>
			</div>

    </body>
</html>
