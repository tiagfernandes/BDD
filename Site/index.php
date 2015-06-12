<?php
    require_once('fonctions.php');



    $listeEquipement = getAllEquipement($pdo);
    $listeUtilisateur = getAllUtilisateur($pdo);
    $listeEtiquetteEquipement = getEtiquetteEquipement($pdo);
	//$listeEquipementEtiquette = getEquipementEtiquette($pdo);

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
				<div id="banniere">Equipement</div>

					<form action ="index.php" method="get"><!-- Barre de recherche, recherche avec soit l'étiquette, soit la -->
						<span>Recherche équipement avec étiquette :</span>
							<input type="text" id="search" name="searchCat" placeholder="Catégorie"/> -
							<input type="text" id="search" name="searchAcr" placeholder="Acronime"/> -
							<input type="text" id="search" name="searchId" placeholder="Numéro"/>
							<input type="submit" value="Envoyer">
							<input type="reset" value="Annuler">
					</form></p>

				<!-- Création du tableau-->
					<table border=2>
						<th>Id</th>
						  <th>Etiquette</th>
						  <th>Nom équipement</th>
						  <th>Marque</th>
						  <th>Fiche de Vie</th>


				<?php
					if((isset($_GET['searchCat'])) or (isset($_GET['searchAcr'])) or (isset($_GET['searchId']))) {
						//Si les champs sont remplis, on affiche les équittes correspondantes au champ

						$chaineSearchCat = addslashes($_GET['searchCat']);
						$chaineSearchAcr = addslashes($_GET['searchAcr']);
						$chaineSearchId = addslashes($_GET['searchId']);

							$requete = "SELECT `equipement`.`idEquipement`, `valeurCategorie`,`valeurAcronime`, `nomEquipement`,`marque`
										FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`
										WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
										AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
										AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
										AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
										AND valeurCategorie LIKE '".$chaineSearchCat."%'
										AND valeurAcronime LIKE '".$chaineSearchAcr."%'
										AND equipement.idEquipement LIKE '". $chaineSearchId."%'
										ORDER BY `equipement`.`idEquipement` DESC";

							// Exécution de la requête SQL
							$resultat = $pdo->query($requete) or die(print_r($pdo->errorInfo()));

							while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
								?>
							<tr style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')">
								<td><?php echo $donnees['idEquipement']; ?></td>
								<td><?php echo $donnees['valeurCategorie'],'-',$donnees['valeurAcronime'],'-',$donnees['idEquipement'];?></td>
								<td><?php echo $donnees['nomEquipement']; ?></td>
								<td><?php echo $donnees['marque']; ?></td>
							</tr>
							<?php
							}

					}


					else{
						//Sinon on affiche toute la liste
					?>
						<?php foreach ($listeEquipement as $cle=>$valeur): ?> <!--Affichage en tableau des equipement-->
							<tr>
								<form method="get" action="equipement.php?idEquipement">
									<?php foreach ($valeur as $val): ?>
										<?php $idEquipement=$valeur['idEquipement']; ?>
											<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $idEquipement;?>')"><?= htmlentities($val) ?></td>
									<?php endforeach; ?>
								</form>
							</tr>

						 <?php endforeach; ?>
				<?php
					}
				?>
        			</table><br/>
        	</div>
   </body>
</html>
