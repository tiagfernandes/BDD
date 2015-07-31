<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page d'index, avec consultation de tout les équipements qui sont stocké
dans la base de donnée. Recherche par nom, étiquette, marque ou encore
date d'ajout de l'équipement
---------------------------------------------------------------------------
L'utilisateur :
Peut voir la liste des équipements, effectué des recherches, et cliquer
pour voir la fiche info de l'équipement.
---------------------------------------------------------------------------
Le développeur :
la même chose que l'utilisateur.
---------------------------------------------------------------------------
L'administrateur :
peut faire la même chose, mais en plus peut supprimer l'équipement avec
un bouton qui s'affiche uniquement pour l'admin.
------------------------------------------------------------------------ */
    require_once('fonctions.php');



    $listeEquipement = getAllEquipement($pdo);
    $listeUtilisateur = getAllUtilisateur($pdo);
    $listeEtiquetteEquipement = getEtiquetteEquipement($pdo);
	//$listeEquipementEtiquette = getEquipementEtiquette($pdo);

	if(isset($_GET['delete'])){ //Supprime l'équipement
		$idEquipement = $_GET['delete'];
		deleteEquipement($idEquipement);
	}

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

				<!-- Tableau d'affichage des équipements -->
					<table class="tableau" border=0.5>

							<th width=150px>Etiquette</th>
							<th width=200px>Nom équipement</th>
							<th width=250px>Marque</th>
							<th width=200px>Lieu affectation</th>
							<th width=200px>Responsable</th>

						<?php

						$messagesParPage = 20; //Nous allons afficher 20 équipement par page.


				/* ------------------------------------------------------------------------
				Si le la recherche est par l'étiquette
				------------------------------------------------------------------------ */
						if( (isset($_GET['searchCat'])) or (isset($_GET['searchAcr'])) or (isset($_GET['searchId'])) ) {

							$chaineSearchCat = addslashes($_GET['searchCat']);
							$chaineSearchAcr = addslashes($_GET['searchAcr']);
							$chaineSearchId = addslashes($_GET['searchId']);

								$requete = "SELECT COUNT(`equipement`.`idEquipement`) as total
											FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`,`plateforme`
											WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
											AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
											AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
											AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
											AND `equipement`.`idPlateforme` = `plateforme`.`idPlateforme`
											AND `valeurCategorie` LIKE '".$chaineSearchCat."%'
											AND `valeurAcronime` LIKE '".$chaineSearchAcr."%'
											AND `equipement`.idEquipement LIKE '". $chaineSearchId."%'
											ORDER BY `equipement`.`idEquipement` DESC";

								$retour_total = $pdo->query($requete); //Nous récupérons le contenu de la requête dans $retour_total
								$donnees_total = $retour_total->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.

									$total = $donnees_total['total']; //On récupère le total pour le placer dans la variable $total.

									//Nous allons maintenant compter le nombre de pages.
									$nombreDePages = ceil($total/$messagesParPage);


									if (isset($_GET['page'])) { // Si la variable $_GET['page'] existe
										 $pageActuelle = intval($_GET['page']); //On inclue le numéro de la page dans la variable

										if ($pageActuelle > $nombreDePages) { // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
											$pageActuelle = $nombreDePages;
										}
									}
									else { // Sinon
										$pageActuelle = 1; // La page actuelle est la n°1
									}


									$premiereEntree = ($pageActuelle - 1) * $messagesParPage; // On calcul la première entrée à lire

									$requete2 = "SELECT `equipement`.`idEquipement`, `valeurCategorie`,`valeurAcronime`, `nomEquipement`,`marque`,`responsable`,`plateforme`
												FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`,`plateforme`
												WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
												AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
												AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
												AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
												AND `equipement`.`idPlateforme` = `plateforme`.`idPlateforme`
												AND valeurCategorie LIKE '".$chaineSearchCat."%'
												AND valeurAcronime LIKE '".$chaineSearchAcr."%'
												AND equipement.idEquipement LIKE '". $chaineSearchId."%'
												ORDER BY `equipement`.`idEquipement` DESC LIMIT $premiereEntree, $messagesParPage";

									$retour_requete = $pdo->query($requete2); //Nous récupérons le contenu de la requête dans $retour_total

									while($donnees = $retour_requete->fetch(PDO::FETCH_ASSOC)) { // On lit les entrées une à une grâce à une boucle
									?>

										<tr>
											<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['valeurCategorie'],'-',$donnees['valeurAcronime'],'-',$donnees['idEquipement'];?></td>
											<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['nomEquipement']; ?></td>
											<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['marque']; ?></td>
											<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['plateforme']; ?></td>
											<td><?php echo $donnees['responsable']; ?></td>

											<?php
												if ($_SESSION['role']=='Administrateur') { //Si l'utilisateur est un Administrateur, on affiche le bouton supprimer
											?>
													<td width=20px>
														<a href="index.php?delete=<?= htmlentities($donnees['idEquipement']) ?>"><img class="poubelle" border="0" alt="Image" src='./image/poubelle1.png'
														onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $donnees['nomEquipement'] ?> ?'));"/></a>
													</td>
											<?php
												}
									}

									?>	</tr> </table>
									<?php

										echo '<p align="center">Page : '; //Pour l'affichage, on centre la liste des pages

											for ($i = 1; $i <= $nombreDePages; $i++) {//On fait notre boucle

												 //On va faire notre condition
												 if ($i == $pageActuelle) {//Si il s'agit de la page actuelle...
													 echo ' [ '.$i.' ] ';
												 }
												 else { //Sinon...
													  echo ' <a href="index.php?page='.$i.'">'.$i.'</a> ';
												 }
											}

										echo '<br>';
										echo '<br>';

						}


				/* ------------------------------------------------------------------------
				Si le la recherche est par le nom
				------------------------------------------------------------------------ */
						else if (isset($_GET['searchNom'])) {

							$chaineSearchNom = addslashes($_GET['searchNom']);

								$requete = "SELECT COUNT(`equipement`.`idEquipement`) as total
											FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`,`plateforme`
											WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
											AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
											AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
											AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
											AND `equipement`.`idPlateforme` = `plateforme`.`idPlateforme`
											AND nomEquipement LIKE '".$chaineSearchNom."%'
											ORDER BY `equipement`.`idEquipement` DESC";

								$retour_total = $pdo->query($requete); //Nous récupérons le contenu de la requête dans $retour_total
								$donnees_total = $retour_total->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.

									$total = $donnees_total['total']; //On récupère le total pour le placer dans la variable $total.

									//Nous allons maintenant compter le nombre de pages.
									$nombreDePages = ceil($total / $messagesParPage);


									if (isset($_GET['page'])) { // Si la variable $_GET['page'] existe...
										 $pageActuelle = intval($_GET['page']);

										if ($pageActuelle > $nombreDePages) { // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
											$pageActuelle = $nombreDePages;
										}
									}
									else {// Sinon
										$pageActuelle = 1; // La page actuelle est la n°1
									}


									$premiereEntree = ($pageActuelle - 1) * $messagesParPage; // On calcul la première entrée à lire

									$requete2 = "SELECT `equipement`.`idEquipement`, `valeurCategorie`,`valeurAcronime`, `nomEquipement`,`marque`,`responsable`,`plateforme`
												FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`,`plateforme`
												WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
												AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
												AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
												AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
												AND `equipement`.`idPlateforme` = `plateforme`.`idPlateforme`
												AND nomEquipement LIKE '".$chaineSearchNom."%'
												ORDER BY `equipement`.`idEquipement` DESC LIMIT $premiereEntree, $messagesParPage";

									$retour_requete = $pdo->query($requete2); //Nous récupérons le contenu de la requête dans $retour_total

									while($donnees = $retour_requete->fetch(PDO::FETCH_ASSOC)) { // On lit les entrées une à une grâce à une boucle
									?>

										 <tr>
											<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['valeurCategorie'],'-',$donnees['valeurAcronime'],'-',$donnees['idEquipement'];?></td>
											<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['nomEquipement']; ?></td>
											<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['marque']; ?></td>
											<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['plateforme']; ?></td>
											<td><?php echo $donnees['responsable']; ?></td>

											<?php
												if($_SESSION['role']=='Administrateur'){
											?>
													<td width=20px>
														<a href="index.php?delete=<?= htmlentities($donnees['idEquipement']) ?>"><img class="poubelle" border="0" alt="Image" src='./image/poubelle1.png'
														onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $donnees['nomEquipement'] ?> ?'));"/></a>
													</td>
											<?php
												}
									}

									?>	</tr> </table>
									<?php

									echo '<p align="center">Page : '; //Pour l'affichage, on centre la liste des pages

										for ($i = 1; $i <= $nombreDePages; $i++) { //On fait notre boucle

											 //On va faire notre condition
											 if ($i == $pageActuelle) { //Si il s'agit de la page actuelle...
												 echo ' [ '.$i.' ] ';
											 }
											 else {//Sinon...
												  echo ' <a href="index.php?page='.$i.'">'.$i.'</a> ';
											 }
										}

									echo '<br>';
									echo '<br>';
								?>

								</tr>
						<?php
						}


				/* ------------------------------------------------------------------------
				Si le la recherche est par la date d'ajout
				------------------------------------------------------------------------ */
						else if (isset($_GET['searchDateAjout'])) {
							//Si les champs sont remplis, on affiche les équittes correspondantes au champ

							$chaineSearchDateAjout = addslashes($_GET['searchDateAjout']);

								$requete = "SELECT COUNT(`equipement`.`idEquipement`) as total
											FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`, `plateforme`
											WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
											AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
											AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
											AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
											AND `equipement`.`idPlateforme` = `plateforme`.`idPlateforme`
											AND dateAjout LIKE '".$chaineSearchDateAjout."%'
											ORDER BY `equipement`.`idEquipement` DESC";

								$retour_total = $pdo->query($requete); //Nous récupérons le contenu de la requête dans $retour_total
								$donnees_total = $retour_total->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.

									$total = $donnees_total['total']; //On récupère le total pour le placer dans la variable $total.

									//Nous allons maintenant compter le nombre de pages.
									$nombreDePages = ceil($total/$messagesParPage);


									if (isset($_GET['page'])) { // Si la variable $_GET['page'] existe...
										 $pageActuelle = intval($_GET['page']);

										if ($pageActuelle > $nombreDePages) { // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
											$pageActuelle = $nombreDePages;
										}
									}
									else {// Sinon
										$pageActuelle = 1; // La page actuelle est la n°1
									}


									$premiereEntree = ($pageActuelle - 1) * $messagesParPage; // On calcul la première entrée à lire

									$requete2 = "SELECT `equipement`.`idEquipement`, `valeurCategorie`,`valeurAcronime`, `nomEquipement`,`marque`,`responsable`,`plateforme`
											FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`, `plateforme`
											WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
											AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
											AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
											AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
											AND `equipement`.`idPlateforme` = `plateforme`.`idPlateforme`
											AND dateAjout LIKE '".$chaineSearchDateAjout."%'
											ORDER BY `equipement`.`idEquipement` DESC LIMIT $premiereEntree, $messagesParPage";

									$retour_requete = $pdo->query($requete2); //Nous récupérons le contenu de la requête dans $retour_total

									while($donnees = $retour_requete->fetch(PDO::FETCH_ASSOC)){ // On lit les entrées une à une grâce à une boucle

										?>

										 <tr>
											<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['valeurCategorie'],'-',$donnees['valeurAcronime'],'-',$donnees['idEquipement'];?></td>
											<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['nomEquipement']; ?></td>
											<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['marque']; ?></td>
											<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['plateforme']; ?></td>
											<td><?php echo $donnees['responsable']; ?></td>

											<?php
												if($_SESSION['role']=='Administrateur'){
											?>
													<td width=20px>
														<a href="index.php?delete=<?= htmlentities($donnees['idEquipement']) ?>"><img class="poubelle" border="0" alt="Image" src='./image/poubelle1.png'
														onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $donnees['nomEquipement'] ?> ?'));"/></a>
													</td>
											<?php
												}
									}

									?>	</tr> </table>
									<?php

									echo '<p align="center">Page : '; //Pour l'affichage, on centre la liste des pages

										for ($i = 1; $i <= $nombreDePages; $i++) { //On fait notre boucle
											 //On va faire notre condition
											 if ($i == $pageActuelle) { //Si il s'agit de la page actuelle...
												 echo ' [ '.$i.' ] ';
											 }
											 else { //Sinon...
												 echo ' <a href="index.php?page='.$i.'">'.$i.'</a> ';
											 }
										}

									echo '<br>';
									echo '<br>';

						}


				/* ------------------------------------------------------------------------
				Si le la recherche est par la marque
				------------------------------------------------------------------------ */
						else if (isset($_GET['searchMarque'])) {
							//Si les champs sont remplis, on affiche les équittes correspondantes au champ

							$chaineSearchMarque = addslashes($_GET['searchMarque']);

								$requete = "SELECT COUNT(`equipement`.`idEquipement`) as total
											FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`, `plateforme`
											WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
											AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
											AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
											AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
											AND `equipement`.`idPlateforme` = `plateforme`.`idPlateforme`
											AND marque LIKE '".$chaineSearchMarque."%'
											ORDER BY `equipement`.`idEquipement` DESC";

								$retour_total = $pdo->query($requete); //Nous récupérons le contenu de la requête dans $retour_total
								$donnees_total = $retour_total->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.

									$total = $donnees_total['total']; //On récupère le total pour le placer dans la variable $total.

									//Nous allons maintenant compter le nombre de pages.
									$nombreDePages = ceil($total/$messagesParPage);


									if (isset($_GET['page'])) { // Si la variable $_GET['page'] existe...
										 $pageActuelle = intval($_GET['page']);

										if ($pageActuelle > $nombreDePages) { // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
											$pageActuelle = $nombreDePages;
										}
									}
									else {// Sinon
										$pageActuelle = 1; // La page actuelle est la n°1
									}


									$premiereEntree = ($pageActuelle - 1) * $messagesParPage; // On calcul la première entrée à lire

									$requete2 = "SELECT `equipement`.`idEquipement`, `valeurCategorie`,`valeurAcronime`, `nomEquipement`,`marque`,`responsable`, `plateforme`
											FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`, `plateforme`
											WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
											AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
											AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
											AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
											AND `equipement`.`idPlateforme` = `plateforme`.`idPlateforme`
											AND marque LIKE '".$chaineSearchMarque."%'
											ORDER BY `equipement`.`idEquipement` DESC LIMIT $premiereEntree, $messagesParPage";

									$retour_requete = $pdo->query($requete2); //Nous récupérons le contenu de la requête dans $retour_total

									while($donnees = $retour_requete->fetch(PDO::FETCH_ASSOC)){ // On lit les entrées une à une grâce à une boucle

										?>

										 <tr>
											<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['valeurCategorie'],'-',$donnees['valeurAcronime'],'-',$donnees['idEquipement'];?></td>
											<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['nomEquipement']; ?></td>
											<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['marque']; ?></td>
											<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['plateforme']; ?></td>
											<td><?php echo $donnees['responsable']; ?></td>

											<?php
												if($_SESSION['role']=='Administrateur'){
											?>
													<td width=20px>
														<a href="index.php?delete=<?= htmlentities($donnees['idEquipement']) ?>"><img class="poubelle" border="0" alt="Image" src='./image/poubelle1.png'
														onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $donnees['nomEquipement'] ?> ?'));"/></a>
													</td>
											<?php
												}
									}
											?>

										<?php

									?> 	</tr> </table>
									<?php

									echo '<p align="center">Page : '; //Pour l'affichage, on centre la liste des pages

										for ($i = 1; $i <= $nombreDePages; $i++) {//On fait notre boucle
											 //On va faire notre condition
											 if ($i == $pageActuelle) {//Si il s'agit de la page actuelle...
												 echo ' [ '.$i.' ] ';
											 }
											 else {//Sinon...
												  echo ' <a href="index.php?page='.$i.'">'.$i.'</a> ';
											 }
										}

									echo '<br>';
									echo '<br>';

						}


				/* ------------------------------------------------------------------------
				Si aucun recherche n'est effectué
				------------------------------------------------------------------------ */
						else{

								$requete = "SELECT COUNT(*) AS total FROM equipement";
								$retour_total = $pdo->query($requete); //Nous récupérons le contenu de la requête dans $retour_total
								$donnees_total = $retour_total->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.

									$total = $donnees_total['total']; //On récupère le total pour le placer dans la variable $total.

									//Nous allons maintenant compter le nombre de pages.
									$nombreDePages = ceil($total/$messagesParPage);


									if (isset($_GET['page'])) { // Si la variable $_GET['page'] existe...
										 $pageActuelle = intval($_GET['page']);

										if($pageActuelle>$nombreDePages){ // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
											$pageActuelle = $nombreDePages;
										}
									}
									else {// Sinon
										$pageActuelle = 1; // La page actuelle est la n°1
									}


									$premiereEntree = ($pageActuelle - 1) * $messagesParPage; // On calcul la première entrée à lire

									$requete2 = "SELECT `equipement`.`idEquipement`, `valeurCategorie`,`valeurAcronime`, `nomEquipement`,`marque`,`responsable`, `plateforme`
													FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`, `plateforme`
													WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
													AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
													AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
													AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
													AND `equipement`.`idPlateforme` = `plateforme`.`idPlateforme`
													ORDER BY `equipement`.`idEquipement` DESC LIMIT $premiereEntree, $messagesParPage";

									$retour_requete = $pdo->query($requete2); //Nous récupérons le contenu de la requête dans $retour_total

									while($donnees = $retour_requete->fetch(PDO::FETCH_ASSOC)){ // On lit les entrées une à une grâce à une boucle
									?>
										 <tr>
											<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['valeurCategorie'],'-',$donnees['valeurAcronime'],'-',$donnees['idEquipement'];?></td>
											<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['nomEquipement']; ?></td>
											<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['marque']; ?></td>
											<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['plateforme']; ?></td>
											<td><?php echo $donnees['responsable']; ?></td>

											<?php
												if ($_SESSION['role']=='Administrateur') {
											?>
													<td width=20px>
														<a href="index.php?delete=<?= htmlentities($donnees['idEquipement']) ?>"><img class="poubelle" border="0" alt="Image" src='./image/poubelle1.png'
														onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $donnees['nomEquipement'] ?> ?'));"/></a>
													</td>
											<?php
												}
									}

									?></tr></table>
									<?php

									echo '<p align="center">Page : '; //Pour l'affichage, on centre la liste des pages

										for ($i = 1; $i <= $nombreDePages; $i++) { //On fait notre boucle
											 //On va faire notre condition
											 if( $i == $pageActuelle) { //Si il s'agit de la page actuelle...
												 echo ' [ '.$i.' ] ';
											 }
											 else { //Sinon...
												 echo ' <a href="index.php?page='.$i.'">'.$i.'</a> ';
											 }
										}

									echo '<br>';
									echo '<br>';
						}
				?>
   </body>
</html>
