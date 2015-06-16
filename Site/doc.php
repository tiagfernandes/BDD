<?php
    require_once('fonctions.php');



    $listeDocument = getAllDocument($pdo);

?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

	<head>
    	<title>Base de donnée ECOTRON</title>
			<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
			<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
			<link rel="stylesheet" type="text/css" href="style.css">
   	</head>


	<body>
		<?php require_once('entete.php'); ?>
			<div id ="contenu">
				<div id="banniere">Document</div>

				  	<!-- Barre de recherche étiquette -->
					<form action ="index.php" method="get">
						<span>Recherche équipement avec étiquette :</span>
							<input type="text" id="search" name="searchCat" placeholder="Catégorie"/> -
							<input type="text" id="search" name="searchAcr" placeholder="Acronime"/> -
							<input type="text" id="search" name="searchId" placeholder="Numéro"/>
								<input type="submit" value="Envoyer">
								<input type="reset" value="Annuler">
					</form></p>

					<!-- Barre de recherche nom -->
					<form action ="index.php" method="get">
						<span>Recherche par nom d'équipement :</span>
							<input type="text" id="search" name="searchNom" placeholder="Nom"/>
								<input type="submit" value="Envoyer">
					</form></p>

					<!-- Barre de recherche marque -->
					<form action ="index.php" method="get">
						<span>Recherche par marque d'équipement :</span>
							<input type="text" id="search" name="searchMarque" placeholder="Marque"/>
								<input type="submit" value="Envoyer">
					</form></p>

					<!-- Barre de recherche date d'ajout -->
					<form action ="index.php" method="get">
						<span>Recherche par date d'ajout d'équipement :</span>
							<input type="date" id="search" name="searchDateAjout" placeholder="AAAA/MM/JJ"/>
								<input type="submit" value="Envoyer">
					</form></p>

				<hr><!-- Trait de séparation -->

				<!-- Création du tableau-->
					<table class="tableau" border=2>
						<th>Id</th>
						<th>Nom document</th>
						<th>Etiquette</th>

						<?php foreach ($listeDocument as $cle=>$valeur): ?> <!--Affichage en tableau des equipement-->
							<tr>
								<form method="get" action="document.php?idDocument">
									<?php foreach ($valeur as $val): ?>
										<?php  $idDocument=$valeur['idDocument']; ?>
											<td style="cursor: pointer;" onClick="window.open('document.php?idDocument=<?= $idDocument;?>')"><?= htmlentities($val) ?></td>
									<?php endforeach; ?>
								</form>
							</tr>

						 <?php endforeach; ?>

        			</table><br/>
        	</div>
   </body>
</html>
