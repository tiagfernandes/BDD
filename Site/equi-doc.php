<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'ajout-anomalie.php', formulaire pour lier un document à des
équipements.
---------------------------------------------------------------------------
L'utilisateur :
Ne peut rien faire.
---------------------------------------------------------------------------
Le développeur :
Autorisé.
---------------------------------------------------------------------------
L'administrateur :
Autorisé.
------------------------------------------------------------------------ */

    require_once('fonctions.php');

	$idDocument = $_GET['idDocument'];
	$listeEquipement = getEquipementToDoc($idDocument);

	if (isset($_GET['add'])) { //Ajoute le document
		$idEquipement = $_GET['add'];
		addDocToEqui($idDocument, $idEquipement);
	}

?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

   <head>
   		<title>Document lié</title>
   		<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
   		<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
   		<link rel="stylesheet" type="text/css" href="style.css">
   	</head>


   	<body>

   		<?php require_once('entete.php'); ?>

			<?php if ($_SESSION['role'] == "Administrateur") { ?>

				<div id="contenu">

					<div id="banniere">Ajout d'un équipement au document n°<?= $idDocument ?></div>

						<fieldset class="Etiquette_Equipement"><legend>Lier un équipement</legend>

								<!-- Barre de recherche étiquette -->
							<form action ="equi-doc.php" method="get">

								<span>Recherche équipement avec étiquette :</span>
									<input type="hidden" id="idDocument" name="idDocument" value="<?= $idDocument ?>">
									<input type="text" id="search" name="searchCat" placeholder="Catégorie"/> -
									<input type="text" id="searcha" name="searchAcr" placeholder="Acronime"/> -
									<input type="text" id="searcha" name="searchId" placeholder="Numéro"/>

										<input type="submit" value="Envoyer">
										<input type="reset" value="Annuler">

							</form></p>

							<!-- Barre de recherche nom -->
							<form action ="equi-doc.php" method="get">

								<span>Recherche par nom d'équipement :</span>
									<input type="hidden" id="idDocument" name="idDocument" value="<?= $idDocument ?>">
									<input type="text" id="search" name="searchNom" placeholder="Nom"/>

										<input type="submit" value="Envoyer">

							</form></p>

							<!-- Barre de recherche marque -->
							<form action ="equi-doc.php" method="get">

								<span>Recherche par marque d'équipement :</span>
									<input type="hidden" id="idDocument" name="idDocument" value="<?= $idDocument ?>">
									<input type="text" id="search" name="searchMarque" placeholder="Marque"/>

										<input type="submit" value="Envoyer">

							</form></p>


						<hr><!-- Trait de séparation -->

						<!-- Création du tableau -->
							<table class="tableau" border=0.5>

									<th width=150px>Etiquette</th>
									<th width=50%>Nom équipement</th>
									<th width=250px>Marque</th>


							<?php

								$messagesParPage = 20; //Nous allons afficher 20 équipement par page.


							/* ------------------------------------------------------------------------
							Si le la recherche est par le lieux d'archivage
							------------------------------------------------------------------------ */
									if ((isset($_GET['searchCat'])) or (isset($_GET['searchAcr'])) or (isset($_GET['searchId'])) ) {
										//Si les champs sont remplis, on affiche les équittes correspondantes au champ

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
														AND `equipement`.`idEquipement` NOT IN (
																				SELECT `equipement`.`idEquipement`
																				FROM `equipement`, `equipement_has_document`
																				WHERE `equipement`.`idEquipement` = `equipement_has_document`.`idEquipement`
																				AND`idDocument`= ".$idDocument.")
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
															AND valeurCategorie LIKE '".$chaineSearchCat."%'
															AND valeurAcronime LIKE '".$chaineSearchAcr."%'
															AND equipement.idEquipement LIKE '". $chaineSearchId."%'
															AND `equipement`.`idEquipement` NOT IN (
																					SELECT `equipement`.`idEquipement`
																					FROM `equipement`, `equipement_has_document`
																					WHERE `equipement`.`idEquipement` = `equipement_has_document`.`idEquipement`
																					AND`idDocument`= ".$idDocument.")
															ORDER BY `equipement`.`idEquipement` DESC LIMIT $premiereEntree, $messagesParPage";

												$retour_requete = $pdo->query($requete2); //Nous récupérons le contenu de la requête dans $retour_total

												while ($donnees = $retour_requete->fetch(PDO::FETCH_ASSOC)) { // On lit les entrées une à une grâce à une boucle

													?>

													 <tr>
														<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['valeurCategorie'],'-',$donnees['valeurAcronime'],'-',$donnees['idEquipement'];?></td>
														<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['nomEquipement']; ?></td>
														<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['marque']; ?></td>
														<td width=20px>
															<a href="equi-doc.php?idDocument=<?= $idDocument?>&searchCat=<?= $chaineSearchCat?>&searchAcr=<?= $chaineSearchAcr?>&searchId=<?= $chaineSearchId?>&add=<?= htmlentities($donnees['idEquipement']) ?>"><img class="add" border="0" alt="Image" src='./image/add.png'
															onClick="return(confirm('Etes-vous sûr de vouloir ajouter <?= $donnees['nomEquipement'] ?> ?'));"/></a>
														</td>
											<?php
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
															  echo ' <a href="equi-doc.php?idDocument='.$idDocument.'&searchCat='.$chaineSearchCat.'&searchAcr='.$chaineSearchAcr.'&searchId='.$chaineSearchId.'&page='.$i.'">'.$i.'</a> ';
														 }
													}

												echo '<br>';
												echo '<br>';
											?>

											</tr>
											<?php
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
														AND `equipement`.`idEquipement` NOT IN (
																				SELECT `equipement`.`idEquipement`
																				FROM `equipement`, `equipement_has_document`
																				WHERE `equipement`.`idEquipement` = `equipement_has_document`.`idEquipement`
																				AND`idDocument`= ".$idDocument.")
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


												$premiereEntree = ($pageActuelle - 1) * s$messagesParPage; // On calcul la première entrée à lire

												$requete2 = "SELECT `equipement`.`idEquipement`, `valeurCategorie`,`valeurAcronime`, `nomEquipement`,`marque`,`responsable`,`plateforme`
														FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`,`plateforme`
														WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
														AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
														AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
														AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
														AND `equipement`.`idPlateforme` = `plateforme`.`idPlateforme`
														AND nomEquipement LIKE '".$chaineSearchNom."%'
														AND `equipement`.`idEquipement` NOT IN (
																				SELECT `equipement`.`idEquipement`
																				FROM `equipement`, `equipement_has_document`
																				WHERE `equipement`.`idEquipement` = `equipement_has_document`.`idEquipement`
																				AND`idDocument`= ".$idDocument.")
														ORDER BY `equipement`.`idEquipement` DESC LIMIT $premiereEntree, $messagesParPage";

												$retour_requete = $pdo->query($requete2); //Nous récupérons le contenu de la requête dans $retour_total

												while ($donnees = $retour_requete->fetch(PDO::FETCH_ASSOC)) { // On lit les entrées une à une grâce à une boucle

													?>

													 <tr>
														<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['valeurCategorie'],'-',$donnees['valeurAcronime'],'-',$donnees['idEquipement'];?></td>
														<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['nomEquipement']; ?></td>
														<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['marque']; ?></td>
														<td width=20px>
															<a href="equi-doc.php?idDocument=<?= $idDocument?>&searchNom=<?= $chaineSearchNom?>&add=<?= htmlentities($donnees['idEquipement']) ?>"><img class="add" border="0" alt="Image" src='./image/add.png'
															onClick="return(confirm('Etes-vous sûr de vouloir ajouter <?= $donnees['nomEquipement'] ?> ?'));"/></a>
														</td>
											<?php
												}
											?>		</tr> </table>
												<?php

												echo '<p align="center">Page : '; //Pour l'affichage, on centre la liste des pages

													for ($i = 1; $i <= $nombreDePages; $i++) { //On fait notre boucle
														 //On va faire notre condition
														 if ($i == $pageActuelle) { //Si il s'agit de la page actuelle...
															 echo ' [ '.$i.' ] ';
														 }
														 else { //Sinon...
															 echo ' <a href="equi-doc.php?idDocument='.$idDocument.'&searchNom='.$chaineSearchNom.'&page='.$i.'">'.$i.'</a> ';
														 }
													}

												echo '<br>';
												echo '<br>';
											?>

											</tr>
											<?php
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
														AND `equipement`.`idEquipement` NOT IN (
																				SELECT `equipement`.`idEquipement`
																				FROM `equipement`, `equipement_has_document`
																				WHERE `equipement`.`idEquipement` = `equipement_has_document`.`idEquipement`
																				AND`idDocument`= ".$idDocument.")
														ORDER BY `equipement`.`idEquipement` DESC";

											$retour_total = $pdo->query($requete); //Nous récupérons le contenu de la requête dans $retour_total
											$donnees_total = $retour_total->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.

												$total = $donnees_total['total']; //On récupère le total pour le placer dans la variable $total.

												//Nous allons maintenant compter le nombre de pages.
												$nombreDePages = ceil($total/$messagesParPage);


												if(isset($_GET['page'])){ // Si la variable $_GET['page'] existe...
													 $pageActuelle = intval($_GET['page']);

													if($pageActuelle>$nombreDePages){ // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
														$pageActuelle = $nombreDePages;
													}
												}
												else {// Sinon
													$pageActuelle=1; // La page actuelle est la n°1
												}


												$premiereEntree=($pageActuelle-1)*$messagesParPage; // On calcul la première entrée à lire

												$requete2 = "SELECT `equipement`.`idEquipement`, `valeurCategorie`,`valeurAcronime`, `nomEquipement`,`marque`,`responsable`, `plateforme`
														FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`, `plateforme`
														WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
														AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
														AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
														AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
														AND `equipement`.`idPlateforme` = `plateforme`.`idPlateforme`
														AND marque LIKE '".$chaineSearchMarque."%'
														AND `equipement`.`idEquipement` NOT IN (
																				SELECT `equipement`.`idEquipement`
																				FROM `equipement`, `equipement_has_document`
																				WHERE `equipement`.`idEquipement` = `equipement_has_document`.`idEquipement`
																				AND`idDocument`= ".$idDocument.")
														ORDER BY `equipement`.`idEquipement` DESC LIMIT $premiereEntree, $messagesParPage";

												$retour_requete = $pdo->query($requete2); //Nous récupérons le contenu de la requête dans $retour_total

												while ($donnees = $retour_requete->fetch(PDO::FETCH_ASSOC)) { // On lit les entrées une à une grâce à une boucle

													?>

													 <tr>
														<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['valeurCategorie'],'-',$donnees['valeurAcronime'],'-',$donnees['idEquipement'];?></td>
														<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['nomEquipement']; ?></td>
														<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['marque']; ?></td>
														<td width=20px>
															<a href="equi-doc.php?idDocument=<?= $idDocument?>&searchMarque=<?= $chaineSearchMarque?>add=<?= htmlentities($donnees['idEquipement']) ?>"><img class="add" border="0" alt="Image" src='./image/add.png'
															onClick="return(confirm('Etes-vous sûr de vouloir ajouter <?= $donnees['nomEquipement'] ?> ?'));"/></a>
														</td>
														<?php

												}
														?>

													<?php

												?> 	</tr> </table>
												<?php

												echo '<p align="center">Page : '; //Pour l'affichage, on centre la liste des pages
													for ($i = 1; $i <= $nombreDePages; $i++) { //On fait notre boucle
														 //On va faire notre condition
														 if ($i == $pageActuelle) { //Si il s'agit de la page actuelle...
															 echo ' [ '.$i.' ] ';
														 }
														 else {//Sinon...
															 echo ' <a href="equi-doc.php?idDocument='.$idDocument.'&searchMarque='.$chaineSearchMarque.'&page='.$i.'">'.$i.'</a> ';
														 }
													}
												echo '<br>';
												echo '<br>';
											?>

											</tr>
								<?php
}


							/* ------------------------------------------------------------------------
							Si le la recherche n'est pas effectuer
							------------------------------------------------------------------------ */
									else{

										$requete = "SELECT COUNT(`equipement`.`idEquipement`) as total
													FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`, `plateforme`
													WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
													AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
													AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
													AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
													AND `equipement`.`idPlateforme` = `plateforme`.`idPlateforme`
													AND `equipement`.`idEquipement` NOT IN (
																	SELECT `equipement`.`idEquipement`
																	FROM `equipement`, `equipement_has_document`
																	WHERE `equipement`.`idEquipement` = `equipement_has_document`.`idEquipement`
																	AND`idDocument`= ".$idDocument.")
													ORDER BY `equipement`.`idEquipement` ";
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

											$requete2 = "SELECT `equipement`.`idEquipement`, `valeurCategorie`,`valeurAcronime`, `nomEquipement`,`marque`,`responsable`, `plateforme`
															FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`, `plateforme`
															WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
															AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
															AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
															AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
															AND `equipement`.`idPlateforme` = `plateforme`.`idPlateforme`
															AND `equipement`.`idEquipement` NOT IN (
																			SELECT `equipement`.`idEquipement`
																			FROM `equipement`, `equipement_has_document`
																			WHERE `equipement`.`idEquipement` = `equipement_has_document`.`idEquipement`
																			AND`idDocument`= ".$idDocument.")
															ORDER BY `equipement`.`idEquipement` DESC LIMIT $premiereEntree, $messagesParPage";

											$retour_requete = $pdo->query($requete2); //Nous récupérons le contenu de la requête dans $retour_total

											while ($donnees = $retour_requete->fetch(PDO::FETCH_ASSOC)) { // On lit les entrées une à une grâce à une boucle

												?>

												 <tr>
													<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['valeurCategorie'],'-',$donnees['valeurAcronime'],'-',$donnees['idEquipement'];?></td>
													<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['nomEquipement']; ?></td>
													<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')"><?php echo $donnees['marque']; ?></td>
													<td width=20px>
														<a href="equi-doc.php?idDocument=<?= $idDocument?>&add=<?= htmlentities($donnees['idEquipement']) ?>"><img class="add" border="0" alt="Image" src='./image/add.png'
														onClick="return(confirm('Etes-vous sûr de vouloir ajouter <?= $donnees['nomEquipement'] ?> ?'));"/></a>
													</td>

												<?php
											}
											?></tr></table>
											<?php

											echo '<p align="center">Page : '; //Pour l'affichage, on centre la liste des pages

												for ($i = 1; $i <= $nombreDePages; $i++) { //On fait notre boucle
													 //On va faire notre condition
													 if ($i == $pageActuelle) { //Si il s'agit de la page actuelle...
														 echo ' [ '.$i.' ] ';
													 }
													 else { //Sinon...
														 echo ' <a href="equi-doc.php?idDocument='.$idDocument.'&page='.$i.'">'.$i.'</a> ';
													 }
												}

											echo '<br>';
											echo '<br>';
										?>

								<?php
									}
							?>

						</fieldset><br/>

				</div>

        <?php }

            else {
                $message="Vous devez être Administrateur pour acceder à cette page !";
                	echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
                header('refresh:0.01;url=index.php');
            }
        ?>
    </body>
</html>
