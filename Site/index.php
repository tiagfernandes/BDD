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

	<head><!-- Header -->
    	<title>Base de donnée ECOTRON</title>
			<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
			<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
			<link rel="stylesheet" type="text/css" href="style.css">
   	</head>


	<body>
		<?php require_once('entete.php'); ?>
			<div id ="contenu">
				<div id="banniere">Equipement</div>

				  	<!-- Barre de recherche étiquette -->
					<form action ="index.php" method="get">
						<span>Recherche équipement avec étiquette :</span>
							<input type="text" id="search" name="searchCat" placeholder="Catégorie"/> -
							<input type="text" id="searcha" name="searchAcr" placeholder="Acronime"/> -
							<input type="text" id="searcha" name="searchId" placeholder="Numéro"/>
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
					<table class="tableau" border=0.5>

							<th>Etiquette</th>
							<th>Nom équipement</th>
							<th width=200px>Marque</th>
							<th>Lieu affectation</th>
							<th>Responsable</th>
						 	<?php
							if($_SESSION['role']=='Administrateur'){
								?>

								<?php
							}
							?>


					<?php
						if((isset($_GET['searchCat'])) or (isset($_GET['searchAcr'])) or (isset($_GET['searchId']))) {
							//Si les champs sont remplis, on affiche les équittes correspondantes au champ

							$chaineSearchCat = addslashes($_GET['searchCat']);
							$chaineSearchAcr = addslashes($_GET['searchAcr']);
							$chaineSearchId = addslashes($_GET['searchId']);

								$requete = "SELECT `equipement`.`idEquipement`, `valeurCategorie`,`valeurAcronime`, `nomEquipement`,`marque`,`responsable`,`plateforme`
											FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`,`plateforme`
											WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
											AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
											AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
											AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
											AND `equipement`.`idPlateforme` = `plateforme`.`idPlateforme`
											AND valeurCategorie LIKE '".$chaineSearchCat."%'
											AND valeurAcronime LIKE '".$chaineSearchAcr."%'
											AND equipement.idEquipement LIKE '". $chaineSearchId."%'
											ORDER BY `equipement`.`idEquipement` DESC";

								// Exécution de la requête SQL
								$resultat = $pdo->query($requete) or die(print_r($pdo->errorInfo()));

								while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
									?>
								<tr style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')">

									<td><?php echo $donnees['valeurCategorie'],'-',$donnees['valeurAcronime'],'-',$donnees['idEquipement'];?></td>
									<td><?php echo $donnees['nomEquipement']; ?></td>
									<td><?php echo $donnees['marque']; ?></td>
									<td><?php echo $donnees['plateforme']; ?></td>
									<td><?php echo $donnees['responsable']; ?></td>

									<?php
										if($_SESSION['role']=='Administrateur'){
									?>
											<td><img src="./image/poubelle1.png" alt="Image" onmouseover="javascript:this.src='./image/poubelle2.png';" onmouseout="javascript:this.src='./image/poubelle1.png';"  href=index.php?delete=<?= htmlentities($donnees['idEquipement']) ?>
											onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $donnees['nomEquipement'] ?> ?'));"/></td>

									<?php
										}
									?>
								</tr>
								<?php
								}

						}


						else if (isset($_GET['searchNom'])) {
							//Si les champs sont remplis, on affiche les équittes correspondantes au champ

							$chaineSearchNom = addslashes($_GET['searchNom']);

								$requete = "SELECT `equipement`.`idEquipement`, `valeurCategorie`,`valeurAcronime`, `nomEquipement`,`marque`,`responsable`,`plateforme`
											FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`,`plateforme`
											WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
											AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
											AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
											AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
											AND `equipement`.`idPlateforme` = `plateforme`.`idPlateforme`
											AND nomEquipement LIKE '".$chaineSearchNom."%'
											ORDER BY `equipement`.`idEquipement` DESC";

								// Exécution de la requête SQL
								$resultat = $pdo->query($requete) or die(print_r($pdo->errorInfo()));

								while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
									?>
								<tr style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')">
									<td><?php echo $donnees['valeurCategorie'],'-',$donnees['valeurAcronime'],'-',$donnees['idEquipement'];?></td>
									<td><?php echo $donnees['nomEquipement']; ?></td>
									<td><?php echo $donnees['marque']; ?></td>
									<td><?php echo $donnees['plateforme']; ?></td>
									<td><?php echo $donnees['responsable']; ?></td>

									<?php
										if($_SESSION['role']=='Administrateur'){
									?>
											<td><img src="./image/poubelle1.png" alt="Image" onmouseover="javascript:this.src='./image/poubelle2.png';" onmouseout="javascript:this.src='./image/poubelle1.png';"  href=index.php?delete=<?= htmlentities($donnees['idEquipement']) ?>
											onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $donnees['nomEquipement'] ?> ?'));"/></td>
									<?php
										}
									?>
								</tr>
								<?php
								}

						}

						else if (isset($_GET['searchDateAjout'])) {
							//Si les champs sont remplis, on affiche les équittes correspondantes au champ

							$chaineSearchDateAjout = addslashes($_GET['searchDateAjout']);

								$requete = "SELECT `equipement`.`idEquipement`, `valeurCategorie`,`valeurAcronime`, `nomEquipement`,`marque`,`responsable`,`plateforme`
											FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`, `plateforme`
											WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
											AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
											AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
											AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
											AND `equipement`.`idPlateforme` = `plateforme`.`idPlateforme`
											AND dateAjout LIKE '".$chaineSearchDateAjout."%'
											ORDER BY `equipement`.`idEquipement` DESC";

								// Exécution de la requête SQL
								$resultat = $pdo->query($requete) or die(print_r($pdo->errorInfo()));

								while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
									?>
								<tr style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')">
									<td><?php echo $donnees['valeurCategorie'],'-',$donnees['valeurAcronime'],'-',$donnees['idEquipement'];?></td>
									<td><?php echo $donnees['nomEquipement']; ?></td>
									<td><?php echo $donnees['marque']; ?></td>
									<td><?php echo $donnees['plateforme']; ?></td>
									<td><?php echo $donnees['responsable']; ?></td>

									<?php
										if($_SESSION['role']=='Administrateur'){
									?>
											<td><img src="./image/poubelle1.png" alt="Image" onmouseover="javascript:this.src='./image/poubelle2.png';" onmouseout="javascript:this.src='./image/poubelle1.png';"  href=index.php?delete=<?= htmlentities($donnees['idEquipement']) ?>
											onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $donnees['nomEquipement'] ?> ?'));"/></td>
									<?php
										}
									?>
								</tr>
								<?php
								}

						}

						else if (isset($_GET['searchMarque'])) {
							//Si les champs sont remplis, on affiche les équittes correspondantes au champ

							$chaineSearchMarque = addslashes($_GET['searchMarque']);

								$requete = "SELECT `equipement`.`idEquipement`, `valeurCategorie`,`valeurAcronime`, `nomEquipement`,`marque`,`responsable`, `plateforme`
											FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`, `plateforme`
											WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
											AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
											AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
											AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
											AND `equipement`.`idPlateforme` = `plateforme`.`idPlateforme`
											AND marque LIKE '".$chaineSearchMarque."%'
											ORDER BY `equipement`.`idEquipement` DESC";

								// Exécution de la requête SQL
								$resultat = $pdo->query($requete) or die(print_r($pdo->errorInfo()));

								while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
									?>
								<tr style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')">
									<td><?php echo $donnees['valeurCategorie'],'-',$donnees['valeurAcronime'],'-',$donnees['idEquipement'];?></td>
									<td><?php echo $donnees['nomEquipement']; ?></td>
									<td><?php echo $donnees['marque']; ?></td>
									<td><?php echo $donnees['plateforme']; ?></td>
									<td><?php echo $donnees['responsable']; ?></td>

									<?php
										if($_SESSION['role']=='Administrateur'){
									?>
											<td><img src="./image/poubelle1.png" alt="Image" onmouseover="javascript:this.src='./image/poubelle2.png';" onmouseout="javascript:this.src='./image/poubelle1.png';"  href=index.php?delete=<?= htmlentities($donnees['idEquipement']) ?>
											onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $donnees['nomEquipement'] ?> ?'));"/></td>
									<?php
										}
									?>
								</tr>
								<?php
								}

						}

						else{
							//Sinon on affiche toute la liste
							//Si les champs sont remplis, on affiche les équittes correspondantes au champ


								$requete = "SELECT `equipement`.`idEquipement`, `valeurCategorie`,`valeurAcronime`, `nomEquipement`,`marque`,`responsable`, `plateforme`
											FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`, `plateforme`
											WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
											AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
											AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
											AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
											AND `equipement`.`idPlateforme` = `plateforme`.`idPlateforme`
											ORDER BY `equipement`.`idEquipement` DESC";

								// Exécution de la requête SQL
								$resultat = $pdo->query($requete) or die(print_r($pdo->errorInfo()));

								while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
									?>
								<tr style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')">
									<td><?php echo $donnees['valeurCategorie'],'-',$donnees['valeurAcronime'],'-',$donnees['idEquipement'];?></td>
									<td><?php echo $donnees['nomEquipement']; ?></td>
									<td><?php echo $donnees['marque']; ?></td>
									<td><?php echo $donnees['plateforme']; ?></td>
									<td><?php echo $donnees['responsable']; ?></td>

									<?php
										if($_SESSION['role']=='Administrateur'){
									?>
											<td><img src="./image/poubelle1.png" alt="Image" onmouseover="javascript:this.src='./image/poubelle2.png';" onmouseout="javascript:this.src='./image/poubelle1.png';"  href=index.php?delete=<?= htmlentities($donnees['idEquipement']) ?>
											onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $donnees['nomEquipement'] ?> ?'));"/></td>
									<?php
										}
									?>
								</tr>
						<?php
								}

						}
						?>
					</table><br/>
        	</div>
   </body>
</html>
