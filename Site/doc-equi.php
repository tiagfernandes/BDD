<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'doc-equi.php', formulaire de liaison de l'équipement avec les
documents.
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
	$idEquipement=$_GET['idEquipement'];
	$listeDocument = getDocumentToEquipement($idEquipement);

	if(isset($_GET['add'])){ //Ajoute le document
		$idDocument = $_GET['add'];
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
			<link rel="stylesheet" type="text/css" href="style.css"/>
	</head>


   <body>

    <?php require_once('entete.php'); ?>

      	<?php if ( ($_SESSION['role'] == "Administrateur") or ($_SESSION['role'] == "Développeur") ) { ?>

       		<div id="contenu">

           		<div id="banniere">Ajout d'un document à l'équipement n°<?= $idEquipement ?></div>

            		<fieldset class="Etiquette_Equipement"><legend>Document lié</legend>

							<!-- Barre de recherche nom -->
						<form action ="doc-equi.php" method="get">
							<span>Recherche par nom de document :</span>
								<input type="hidden" id="idEquipement" name="idEquipement" value="<?= $idEquipement ?>">
								<input type="text" id="search" name="searchNom" placeholder="Nom"/>
									<input type="submit" value="Envoyer">
						</form></p>

						<!-- Barre de recherche etiquette -->
						<form action ="doc-equi.php?idEquipement=<?= $idEquipement?>" method="get">
							<span>Recherche document par étiquette :</span>
								<input type="hidden" id="idEquipement" name="idEquipement" value="<?= $idEquipement ?>">
								<input type="text" id="search" name="searchType" placeholder="Type"/> -
								<input type="text" id="searcha" name="searchProcessus" placeholder="Processus"/> -
								<input type="text" id="searcha" name="searchSousProcessus" placeholder="Sous-processus"/> -
								<input type="text" id="searcha" name="searchCategorie" placeholder="Catégorie équipement"/> -
								<input type="text" id="searcha" name="searchAcronime" placeholder="Acronime équipement"/> -
								<input type="int" id="searcha" name="searchNumDoc" placeholder="Numéro document"/>
									<input type="submit" value="Envoyer">
						</form></p>

						<!-- Barre de recherche archivage -->
						<form action ="doc-equi.php?idEquipement=<?= $idEquipement?>" method="get">
							<span>Recherche document par archive :</span>
								<input type="hidden" id="idEquipement" name="idEquipement" value="<?= $idEquipement ?>">
								<input type="text" id="search" name="searchPlateforme" placeholder="Plateforme"/> -
								<input type="text" id="searcha" name="searchPiece" placeholder="Pièce"/> -
								<input type="text" id="searcha" name="searchEmplacement" placeholder="Emplacement"/> -
								<input type="text" id="searcha" name="searchSousEmplacement" placeholder="Sous emplacement"/>
									<input type="submit" value="Envoyer">
						</form></p>

							<hr><!-- Trait de séparation -->

					<!-- Création du tableau-->
								<table class="tableau" border="0.5">
									<th width=200px>Nom document</th>
									<th width=200px>Etiquette</th>
									<th width=200px>Lieu d'archive</th>
									<th width=200px>Nom PDF</th>


									<?php

										$messagesParPage = 20; //Nous allons afficher 20


									/* ------------------------------------------------------------------------
									Si le la recherche est par le lieux d'archivage
									------------------------------------------------------------------------ */
											if ((isset ($_GET['searchPlateforme']) ) or (isset ($_GET['searchPiece']) ) or (isset ($_GET['searchEmplacement']) ) or (isset ($_GET['searchSousEmplacement']) ) ) {

												$chaineSearchPlateforme = addslashes($_GET['searchPlateforme']);
												$chaineSearchPiece = addslashes($_GET['searchPiece']);
												$chaineSearchEmplacement = addslashes($_GET['searchEmplacement']);
												$chaineSearchSousEmplacement = addslashes($_GET['searchSousEmplacement']);


														$requete = "SELECT COUNT(`document`.`idDocument`) as total
																	FROM `document`, `etiquette_document`,`type_document`,`processus`, `sous_processus`, `etiquette_equipement`, `categorie_etiquette`, `acronime_etiquette`,`lieux_document`,`plateforme_archive`, `piece_document`, `emplacement_archive`, `sous_emplacement`
																	WHERE `document`.`idEtiquette_Document` = `etiquette_document`.`idEtiquette_Document`
																	AND `etiquette_document`.`idType_Document` = `type_document`.`idType_Document`
																	AND `etiquette_document`.`idProcessus` = `processus`.`idProcessus`
																	AND `etiquette_document`.`idSous_Processus` = `sous_processus`.`idSous_Processus`
																	AND `etiquette_document`.`idEtiquette_Equipement` = `etiquette_equipement`.`idEtiquette_Equipement`
																	AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
																	AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
																	AND `document`.`idLieux_Document` = `lieux_document`.`idLieux_Document`
																	AND `lieux_document`.`idPlateforme_Archive` = `plateforme_archive`.`idPlateforme_Archive`
																	AND `lieux_document`.`idPiece_Document` = `piece_document`.`idPiece_Document`
																	AND `lieux_document`.`idEmplacement_Archive` = `emplacement_archive`.`idEmplacement_Archive`
																	AND `lieux_document`.`idSous_Emplacement` = `sous_emplacement`.`idSous_Emplacement`
																	AND `valeurPlateforme` LIKE '".$chaineSearchPlateforme."%'
																	AND `valeurPiece` LIKE '".$chaineSearchPiece."%'
																	AND `valeurEmplacement` LIKE '". $chaineSearchEmplacement."%'
																	AND `valeurSousEmplacement` LIKE '". $chaineSearchSousEmplacement."%'
																	AND `idDocument` NOT IN (
																							SELECT `document`.`idDocument`
																							FROM `document`, `equipement_has_document`
																							WHERE `document`.`idDocument` = `equipement_has_document`.`idDocument`
																							AND`idEquipement`= ".$idEquipement.")
																	ORDER BY `document`.`idDocument` DESC";

														$retour_total = $pdo->query($requete); //Nous récupérons le contenu de la requête dans $retour_total
														$donnees_total = $retour_total->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.

															$total = $donnees_total['total']; //On récupère le total pour le placer dans la variable $total.

															//Nous allons maintenant compter le nombre de pages.
															$nombreDePages = ceil($total / $messagesParPage);


															if (isset ($_GET['page']) ){ // Si la variable $_GET['page'] existe...
																 $pageActuelle = intval($_GET['page']);

																if ($pageActuelle > $nombreDePages){ // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
																	$pageActuelle = $nombreDePages;
																}
															}
															else {// Sinon
																$pageActuelle = 1; // La page actuelle est la n°1
															}


															$premiereEntree = ($pageActuelle - 1) * $messagesParPage; // On calcul la première entrée à lire

															$requete2 = "SELECT `document`.`idDocument`,`nomDocument`, `valeurTypeDoc`,`valeurProcessus`,`valeurSousProcessus`,`valeurCategorie`,`valeurAcronime`,`document`.`idDocument`, `valeurPlateforme`, `valeurPiece`,`valeurEmplacement`, `valeurSousEmplacement`, `nomFichier`
																		FROM `document`, `etiquette_document`,`type_document`,`processus`, `sous_processus`, `etiquette_equipement`, `categorie_etiquette`, `acronime_etiquette`,`lieux_document`,`plateforme_archive`, `piece_document`, `emplacement_archive`, `sous_emplacement`
																		WHERE `document`.`idEtiquette_Document` = `etiquette_document`.`idEtiquette_Document`
																		AND `etiquette_document`.`idType_Document` = `type_document`.`idType_Document`
																		AND `etiquette_document`.`idProcessus` = `processus`.`idProcessus`
																		AND `etiquette_document`.`idSous_Processus` = `sous_processus`.`idSous_Processus`
																		AND `etiquette_document`.`idEtiquette_Equipement` = `etiquette_equipement`.`idEtiquette_Equipement`
																		AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
																		AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
																		AND `document`.`idLieux_Document` = `lieux_document`.`idLieux_Document`
																		AND `lieux_document`.`idPlateforme_Archive` = `plateforme_archive`.`idPlateforme_Archive`
																		AND `lieux_document`.`idPiece_Document` = `piece_document`.`idPiece_Document`
																		AND `lieux_document`.`idEmplacement_Archive` = `emplacement_archive`.`idEmplacement_Archive`
																		AND `lieux_document`.`idSous_Emplacement` = `sous_emplacement`.`idSous_Emplacement`
																		AND `valeurPlateforme` LIKE '".$chaineSearchPlateforme."%'
																		AND `valeurPiece` LIKE '".$chaineSearchPiece."%'
																		AND `valeurEmplacement` LIKE '". $chaineSearchEmplacement."%'
																		AND `valeurSousEmplacement` LIKE '". $chaineSearchSousEmplacement."%'
																		AND `idDocument` NOT IN (
																							SELECT `document`.`idDocument`
																							FROM `document`, `equipement_has_document`
																							WHERE `document`.`idDocument` = `equipement_has_document`.`idDocument`
																							AND`idEquipement`= 18)
																		ORDER BY `document`.`idDocument` DESC LIMIT $premiereEntree, $messagesParPage";

															$retour_requete = $pdo->query($requete2); //Nous récupérons le contenu de la requête dans $retour_total

															while ($donnees = $retour_requete->fetch(PDO::FETCH_ASSOC)) { // On lit les entrées une à une grâce à une boucle
															?>
																<tr>
																	<td style="cursor: pointer;" onClick="window.open('document.php?idDocument=<?= $donnees['idDocument'];?>')"><?php echo $donnees['nomDocument']; ?></td>
																	<td style="cursor: pointer;" onClick="window.open('document.php?idDocument=<?= $donnees['idDocument'];?>')"><?php echo $donnees['valeurTypeDoc'],'-',$donnees['valeurProcessus'],'-',$donnees['valeurSousProcessus'],'-',$donnees['valeurCategorie'],'-',$donnees['valeurAcronime'],'-',$donnees['idDocument'];?></td>
																	<td style="cursor: pointer;" onClick="window.open('document.php?idDocument=<?= $donnees['idDocument'];?>')"><?php echo $donnees['valeurPlateforme'],'-',$donnees['valeurPiece'],'-',$donnees['valeurEmplacement'],'-',$donnees['valeurSousEmplacement'];?></td>
																	<td style="cursor: pointer;" onClick="window.open('document.php?idDocument=<?= $donnees['nomFichier'];?>')"></td>


																		<td width=20px>
																				<a href="doc-equi.php?idEquipement=<?= $idEquipement?>&searchPlateforme=<?= $chaineSearchPlateforme?>&searchPiece=<?= $chaineSearchPiece?>&searchEmplacement<?= $chaineSearchEmplacement?>&searchEmplacement=<?= $chaineSearchSousEmplacement?>&add=<?= htmlentities($donnees['idDocument']) ?>"><img class="add" border="0" alt="Image" src='./image/add.png'
																				onClick="return(confirm('Etes-vous sûr de vouloir ajouter <?= $donnees['nomDocument'] ?> ?'));"/></a>
																		</td>
																<?php

															}
																?>
																</tr></table>

															<?php
															//Affichage de la pagination
															echo '<p align="center">Page : '; //Pour l'affichage, on centre la liste des pages

																for ($i  =1; $i <= $nombreDePages; $i++) { //On fait notre boucle

																	 //On va faire notre condition
																	if ($i == $pageActuelle) { //Si il s'agit de la page actuelle...
																		echo ' [ '.$i.' ] ';
																	}
																	else { //Sinon...
																		echo ' <a href="doc-equi.php?idEquipement='.$idEquipement.'&searchPlateforme='.$chaineSearchPlateforme.'&searchPiece='.$chaineSearchPiece.'&searchEmplacement='.$chaineSearchEmplacement.'&searchEmplacement='.$chaineSearchSousEmplacement.'&page='.$i.'">'.$i.'</a> ';
																	}
																}

															echo '<br>';
															echo '<br>';

											}


									/* ------------------------------------------------------------------------
									Si le la recherche est par l'étiquette
									------------------------------------------------------------------------ */
											else if ( (isset($_GET['searchType'])) or (isset ($_GET['searchProcessus']) ) or (isset ($_GET['searchSousProcessus']) ) or (isset ($_GET['searchCategorie']) ) or (isset ($_GET['searchAcronime']) ) or (isset ($_GET['searchNumDoc']) ) ) {


												$chaineSearchType = addslashes($_GET['searchType']);
												$chaineSearchProcessus = addslashes($_GET['searchProcessus']);
												$chaineSearchSousProcessus = addslashes($_GET['searchSousProcessus']);
												$chaineSearchCategorie = addslashes($_GET['searchCategorie']);
												$chaineSearchAcronime = addslashes($_GET['searchAcronime']);
												$chaineSearchNumDoc = addslashes($_GET['searchNumDoc']);

													$requete = "SELECT COUNT(`document`.`idDocument`) as total
																FROM `document`, `etiquette_document`,`type_document`,`processus`, `sous_processus`, `etiquette_equipement`, `categorie_etiquette`, `acronime_etiquette`,`lieux_document`,`plateforme_archive`, `piece_document`, `emplacement_archive`, `sous_emplacement`
																WHERE `document`.`idEtiquette_Document` = `etiquette_document`.`idEtiquette_Document`
																AND `etiquette_document`.`idType_Document` = `type_document`.`idType_Document`
																AND `etiquette_document`.`idProcessus` = `processus`.`idProcessus`
																AND `etiquette_document`.`idSous_Processus` = `sous_processus`.`idSous_Processus`
																AND `etiquette_document`.`idEtiquette_Equipement` = `etiquette_equipement`.`idEtiquette_Equipement`
																AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
																AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
																AND `document`.`idLieux_Document` = `lieux_document`.`idLieux_Document`
																AND `lieux_document`.`idPlateforme_Archive` = `plateforme_archive`.`idPlateforme_Archive`
																AND `lieux_document`.`idPiece_Document` = `piece_document`.`idPiece_Document`
																AND `lieux_document`.`idEmplacement_Archive` = `emplacement_archive`.`idEmplacement_Archive`
																AND `lieux_document`.`idSous_Emplacement` = `sous_emplacement`.`idSous_Emplacement`
																AND `valeurTypeDoc` LIKE '".$chaineSearchType."%'
																AND `valeurProcessus` LIKE '".$chaineSearchProcessus."%'
																AND `valeurSousProcessus` LIKE '".$chaineSearchSousProcessus."%'
																AND `valeurCategorie` LIKE '".$chaineSearchCategorie."%'
																AND `valeurAcronime` LIKE '".$chaineSearchAcronime."%'
																AND `idDocument` LIKE '".$chaineSearchNumDoc."%'
																AND `idDocument` NOT IN (
																							SELECT `document`.`idDocument`
																							FROM `document`, `equipement_has_document`
																							WHERE `document`.`idDocument` = `equipement_has_document`.`idDocument`
																							AND`idEquipement`= 18)
																ORDER BY `document`.`idDocument` DESC";

														$retour_total = $pdo->query($requete); //Nous récupérons le contenu de la requête dans $retour_total
														$donnees_total = $retour_total->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.

															$total = $donnees_total['total']; //On récupère le total pour le placer dans la variable $total.

															//Nous allons maintenant compter le nombre de pages.
															$nombreDePages = ceil($total/$messagesParPage);


															if (isset ($_GET['page']) ) { // Si la variable $_GET['page'] existe...
																 $pageActuelle = intval($_GET['page']);

																if ($pageActuelle > $nombreDePages){ // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
																	$pageActuelle = $nombreDePages;
																}
															}
															else {// Sinon
																$pageActuelle = 1; // La page actuelle est la n°1
															}


															$premiereEntree = ($pageActuelle - 1) * $messagesParPage; // On calcul la première entrée à lire

															$requete2 = "SELECT `document`.`idDocument`,`nomDocument`, `valeurTypeDoc`,`valeurProcessus`,`valeurSousProcessus`,`valeurCategorie`,`valeurAcronime`,`document`.`idDocument`, `valeurPlateforme`, `valeurPiece`,`valeurEmplacement`, `valeurSousEmplacement`, `nomFichier`
																		FROM `document`, `etiquette_document`,`type_document`,`processus`, `sous_processus`, `etiquette_equipement`, `categorie_etiquette`, `acronime_etiquette`,`lieux_document`,`plateforme_archive`, `piece_document`, `emplacement_archive`, `sous_emplacement`
																		WHERE `document`.`idEtiquette_Document` = `etiquette_document`.`idEtiquette_Document`
																		AND `etiquette_document`.`idType_Document` = `type_document`.`idType_Document`
																		AND `etiquette_document`.`idProcessus` = `processus`.`idProcessus`
																		AND `etiquette_document`.`idSous_Processus` = `sous_processus`.`idSous_Processus`
																		AND `etiquette_document`.`idEtiquette_Equipement` = `etiquette_equipement`.`idEtiquette_Equipement`
																		AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
																		AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
																		AND `document`.`idLieux_Document` = `lieux_document`.`idLieux_Document`
																		AND `lieux_document`.`idPlateforme_Archive` = `plateforme_archive`.`idPlateforme_Archive`
																		AND `lieux_document`.`idPiece_Document` = `piece_document`.`idPiece_Document`
																		AND `lieux_document`.`idEmplacement_Archive` = `emplacement_archive`.`idEmplacement_Archive`
																		AND `lieux_document`.`idSous_Emplacement` = `sous_emplacement`.`idSous_Emplacement`
																		AND `valeurTypeDoc` LIKE '".$chaineSearchType."%'
																		AND `valeurProcessus` LIKE '".$chaineSearchProcessus."%'
																		AND `valeurSousProcessus` LIKE '".$chaineSearchSousProcessus."%'
																		AND `valeurCategorie` LIKE '".$chaineSearchCategorie."%'
																		AND `valeurAcronime` LIKE '".$chaineSearchAcronime."%'
																		AND `idDocument` LIKE '".$chaineSearchNumDoc."%'
																		AND `idDocument` NOT IN (
																							SELECT `document`.`idDocument`
																							FROM `document`, `equipement_has_document`
																							WHERE `document`.`idDocument` = `equipement_has_document`.`idDocument`
																							AND`idEquipement`= 18)
																		ORDER BY `document`.`idDocument` DESC LIMIT $premiereEntree, $messagesParPage";

															$retour_requete = $pdo->query($requete2); //Nous récupérons le contenu de la requête dans $retour_total

															while ($donnees = $retour_requete->fetch(PDO::FETCH_ASSOC)) { // On lit les entrées une à une grâce à une boucle	?>
																 <tr>
																	<td style="cursor: pointer;" onClick="window.open('document.php?idDocument=<?= $donnees['idDocument'];?>')"><?php echo $donnees['nomDocument']; ?></td>
																	<td style="cursor: pointer;" onClick="window.open('document.php?idDocument=<?= $donnees['idDocument'];?>')"><?php echo $donnees['valeurTypeDoc'],'-',$donnees['valeurProcessus'],'-',$donnees['valeurSousProcessus'],'-',$donnees['valeurCategorie'],'-',$donnees['valeurAcronime'],'-',$donnees['idDocument'];?></td>
																	<td style="cursor: pointer;" onClick="window.open('document.php?idDocument=<?= $donnees['idDocument'];?>')"><?php echo $donnees['valeurPlateforme'],'-',$donnees['valeurPiece'],'-',$donnees['valeurEmplacement'],'-',$donnees['valeurSousEmplacement'];?></td>
																	<td style="cursor: pointer;" onClick="window.open('document.php?idDocument=<?= $donnees['nomFichier'];?>')"></td>


																		<td width=20px>
																				<a href="doc-equi.php?idEquipement=<?= $idEquipement?>&searchType=<?= $chaineSearchType?>&searchProcessus=<?= $chaineSearchProcessus?>&searchSousProcessus=<?= $chaineSearchSousProcessus?>&searchCategorie=<?= $chaineSearchCategorie?>&searchAcronime=<?= $chaineSearchAcronime?>&searchNumDoc=<?= $chaineSearchNumDoc?>&add=<?= htmlentities($donnees['idDocument']) ?>"><img class="add" border="0" alt="Image" src='./image/add.png'
																				onClick="return(confirm('Etes-vous sûr de vouloir ajouter <?= $donnees['nomDocument'] ?> ?'));"/></a>
																		</td>
																<?php

															}
																?>	</tr> </table><?php

																echo '<p align="center">Page : '; //Pour l'affichage, on centre la liste des pages

																	for ($i = 1; $i <= $nombreDePages; $i++) { //On fait notre boucle
																		//On va faire notre condition
																		if ($i == $pageActuelle) {//Si il s'agit de la page actuelle...
																			echo ' [ '.$i.' ] ';
																		}
																		else { //Sinon...
																			echo ' <a href="doc-equi.php?idEquipement='.$idEquipement.'&searchType='.$chaineSearchType.'&searchProcessus='.$chaineSearchProcessus.'&searchSousProcessus='.$chaineSearchSousProcessus.'&searchCategorie='.$chaineSearchCategorie.'&searchAcronime='.$chaineSearchAcronime.'&searchNumDoc='.$chaineSearchNumDoc.'&page='.$i.'">'.$i.'</a> ';
																		}
																	}

																echo '<br>';
																echo '<br>';

											}


									/* ------------------------------------------------------------------------
									Si le la recherche est par nom
									------------------------------------------------------------------------ */
											else if((isset($_GET['searchNom']))) {


												$chaineSearchNom = addslashes($_GET['searchNom']);

													$requete = "SELECT COUNT(`document`.`idDocument`) as total
																FROM `document`, `etiquette_document`,`type_document`,`processus`, `sous_processus`, `etiquette_equipement`, `categorie_etiquette`, `acronime_etiquette`,`lieux_document`,`plateforme_archive`, `piece_document`, `emplacement_archive`, `sous_emplacement`
																WHERE `document`.`idEtiquette_Document` = `etiquette_document`.`idEtiquette_Document`
																AND `etiquette_document`.`idType_Document` = `type_document`.`idType_Document`
																AND `etiquette_document`.`idProcessus` = `processus`.`idProcessus`
																AND `etiquette_document`.`idSous_Processus` = `sous_processus`.`idSous_Processus`
																AND `etiquette_document`.`idEtiquette_Equipement` = `etiquette_equipement`.`idEtiquette_Equipement`
																AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
																AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
																AND `document`.`idLieux_Document` = `lieux_document`.`idLieux_Document`
																AND `lieux_document`.`idPlateforme_Archive` = `plateforme_archive`.`idPlateforme_Archive`
																AND `lieux_document`.`idPiece_Document` = `piece_document`.`idPiece_Document`
																AND `lieux_document`.`idEmplacement_Archive` = `emplacement_archive`.`idEmplacement_Archive`
																AND `lieux_document`.`idSous_Emplacement` = `sous_emplacement`.`idSous_Emplacement`
																AND `nomDocument` LIKE '".$chaineSearchNom."%'
																AND `idDocument` NOT IN (
																							SELECT `document`.`idDocument`
																							FROM `document`, `equipement_has_document`
																							WHERE `document`.`idDocument` = `equipement_has_document`.`idDocument`
																							AND`idEquipement`= 18)
																ORDER BY `document`.`idDocument` DESC";

														$retour_total = $pdo->query($requete); //Nous récupérons le contenu de la requête dans $retour_total
														$donnees_total = $retour_total->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.

															$total = $donnees_total['total']; //On récupère le total pour le placer dans la variable $total.

															//Nous allons maintenant compter le nombre de pages.
															$nombreDePages = ceil($total/$messagesParPage);


															if (isset ($_GET['page']) ){ // Si la variable $_GET['page'] existe...
																 $pageActuelle = intval($_GET['page']);

																if ($pageActuelle > $nombreDePages){ // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
																	$pageActuelle = $nombreDePages;
																}
															}
															else {// Sinon
																$pageActuelle = 1; // La page actuelle est la n°1
															}


															$premiereEntree = ($pageActuelle - 1) * $messagesParPage; // On calcul la première entrée à lire

															$requete2 = "SELECT `document`.`idDocument`,`nomDocument`, `valeurTypeDoc`,`valeurProcessus`,`valeurSousProcessus`,`valeurCategorie`,`valeurAcronime`,`document`.`idDocument`, `valeurPlateforme`, `valeurPiece`,`valeurEmplacement`, `valeurSousEmplacement`, `nomFichier`
																		FROM `document`, `etiquette_document`,`type_document`,`processus`, `sous_processus`, `etiquette_equipement`, `categorie_etiquette`, `acronime_etiquette`,`lieux_document`,`plateforme_archive`, `piece_document`, `emplacement_archive`, `sous_emplacement`
																		WHERE `document`.`idEtiquette_Document` = `etiquette_document`.`idEtiquette_Document`
																		AND `etiquette_document`.`idType_Document` = `type_document`.`idType_Document`
																		AND `etiquette_document`.`idProcessus` = `processus`.`idProcessus`
																		AND `etiquette_document`.`idSous_Processus` = `sous_processus`.`idSous_Processus`
																		AND `etiquette_document`.`idEtiquette_Equipement` = `etiquette_equipement`.`idEtiquette_Equipement`
																		AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
																		AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
																		AND `document`.`idLieux_Document` = `lieux_document`.`idLieux_Document`
																		AND `lieux_document`.`idPlateforme_Archive` = `plateforme_archive`.`idPlateforme_Archive`
																		AND `lieux_document`.`idPiece_Document` = `piece_document`.`idPiece_Document`
																		AND `lieux_document`.`idEmplacement_Archive` = `emplacement_archive`.`idEmplacement_Archive`
																		AND `lieux_document`.`idSous_Emplacement` = `sous_emplacement`.`idSous_Emplacement`
																		AND `nomDocument` LIKE '".$chaineSearchNom."%'
																		AND `idDocument` NOT IN (
																							SELECT `document`.`idDocument`
																							FROM `document`, `equipement_has_document`
																							WHERE `document`.`idDocument` = `equipement_has_document`.`idDocument`
																							AND`idEquipement`= 18)
																		ORDER BY `document`.`idDocument` DESC LIMIT $premiereEntree, $messagesParPage";

															$retour_requete = $pdo->query($requete2); //Nous récupérons le contenu de la requête dans $retour_total



															while ($donnees = $retour_requete->fetch(PDO::FETCH_ASSOC)) { // On lit les entrées une à une grâce à une boucle	?>
																 <tr>
																	<td style="cursor: pointer;" onClick="window.open('document.php?idDocument=<?= $donnees['idDocument'];?>')"><?php echo $donnees['nomDocument']; ?></td>
																	<td style="cursor: pointer;" onClick="window.open('document.php?idDocument=<?= $donnees['idDocument'];?>')"><?php echo $donnees['valeurTypeDoc'],'-',$donnees['valeurProcessus'],'-',$donnees['valeurSousProcessus'],'-',$donnees['valeurCategorie'],'-',$donnees['valeurAcronime'],'-',$donnees['idDocument'];?></td>
																	<td style="cursor: pointer;" onClick="window.open('document.php?idDocument=<?= $donnees['idDocument'];?>')"><?php echo $donnees['valeurPlateforme'],'-',$donnees['valeurPiece'],'-',$donnees['valeurEmplacement'],'-',$donnees['valeurSousEmplacement'];?></td>
																	<td style="cursor: pointer;" onClick="window.open('document.php?idDocument=<?= $donnees['nomFichier'];?>')"></td>

																<?php
																	if ($_SESSION['role'] == 'Administrateur') {	?>
																		<td width=20px>
																				<a href="doc-equi.php?idEquipement=<?= $idEquipement?>&searchNom=<?= $chaineSearchNom?>&add=<?= htmlentities($donnees['idDocument']) ?>"><img class="add" border="0" alt="Image" src='./image/add.png'
																				onClick="return(confirm('Etes-vous sûr de vouloir ajouter <?= $donnees['nomDocument'] ?> ?'));"/></a>
																		</td>
																<?php
																	}
															}
															?>	</tr> </table><?php

																echo '<p align="center">Page : '; //Pour l'affichage, on centre la liste des pages

																	for ($i = 1; $i <= $nombreDePages; $i++) { //On fait notre boucle
																		//On va faire notre condition
																		if ($i == $pageActuelle) { //Si il s'agit de la page actuelle...
																			echo ' [ '.$i.' ] ';
																		}
																		else { //Sinon...
																			echo ' <a href="doc-equi.php?idEquipement='.$idEquipement.'&searchNom='.$chaineSearchNom.'&page='.$i.'">'.$i.'</a> ';
																		}
																	}

																echo '<br>';
																echo '<br>';

											}


									/* ------------------------------------------------------------------------
									Si le la recherche n'est pas effectué
									------------------------------------------------------------------------ */
											else {

												$requete = "SELECT COUNT(`document`.`idDocument`) as total
															FROM `document`, `etiquette_document`,`type_document`,`processus`, `sous_processus`, `etiquette_equipement`, `categorie_etiquette`, `acronime_etiquette`,`lieux_document`,`plateforme_archive`, `piece_document`, `emplacement_archive`, `sous_emplacement`
															WHERE `document`.`idEtiquette_Document` = `etiquette_document`.`idEtiquette_Document`
															AND `etiquette_document`.`idType_Document` = `type_document`.`idType_Document`
															AND `etiquette_document`.`idProcessus` = `processus`.`idProcessus`
															AND `etiquette_document`.`idSous_Processus` = `sous_processus`.`idSous_Processus`
															AND `etiquette_document`.`idEtiquette_Equipement` = `etiquette_equipement`.`idEtiquette_Equipement`
															AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
															AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
															AND `document`.`idLieux_Document` = `lieux_document`.`idLieux_Document`
															AND `lieux_document`.`idPlateforme_Archive` = `plateforme_archive`.`idPlateforme_Archive`
															AND `lieux_document`.`idPiece_Document` = `piece_document`.`idPiece_Document`
															AND `lieux_document`.`idEmplacement_Archive` = `emplacement_archive`.`idEmplacement_Archive`
															AND `lieux_document`.`idSous_Emplacement` = `sous_emplacement`.`idSous_Emplacement`
															AND `idDocument` NOT IN (
																							SELECT `document`.`idDocument`
																							FROM `document`, `equipement_has_document`
																							WHERE `document`.`idDocument` = `equipement_has_document`.`idDocument`
																							AND`idEquipement`= 18)";

														$retour_total = $pdo->query($requete); //Nous récupérons le contenu de la requête dans $retour_total
														$donnees_total = $retour_total->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.

															$total = $donnees_total['total']; //On récupère le total pour le placer dans la variable $total.

															//Nous allons maintenant compter le nombre de pages.
															$nombreDePages = ceil($total/$messagesParPage);


															if (isset($_GET['page'])) { // Si la variable $_GET['page'] existe...
																 $pageActuelle = intval($_GET['page']);

																if($pageActuelle > $nombreDePages){ // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
																	$pageActuelle = $nombreDePages;
																}
															}
															else {// Sinon
																$pageActuelle = 1; // La page actuelle est la n°1
															}

															$premiereEntree=($pageActuelle-1)*$messagesParPage	; // On calcul la première entrée à lire

															$requete2 = "SELECT `document`.`idDocument`, `nomDocument`, `valeurTypeDoc`, `valeurProcessus`, `valeurSousProcessus`, `valeurCategorie`, `valeurAcronime`, `valeurPlateforme`, `valeurPiece`, `valeurEmplacement`, `valeurSousEmplacement`, `nomFichier`
																		FROM `document`, `etiquette_document`,`type_document`,`processus`, `sous_processus`, `etiquette_equipement`, `categorie_etiquette`, `acronime_etiquette`,`lieux_document`,`plateforme_archive`, `piece_document`, `emplacement_archive`, `sous_emplacement`
																		WHERE `document`.`idEtiquette_Document` = `etiquette_document`.`idEtiquette_Document`
																		AND `etiquette_document`.`idType_Document` = `type_document`.`idType_Document`
																		AND `etiquette_document`.`idProcessus` = `processus`.`idProcessus`
																		AND `etiquette_document`.`idSous_Processus` = `sous_processus`.`idSous_Processus`
																		AND `etiquette_document`.`idEtiquette_Equipement` = `etiquette_equipement`.`idEtiquette_Equipement`
																		AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
																		AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
																		AND `document`.`idLieux_Document` = `lieux_document`.`idLieux_Document`
																		AND `lieux_document`.`idPlateforme_Archive` = `plateforme_archive`.`idPlateforme_Archive`
																		AND `lieux_document`.`idPiece_Document` = `piece_document`.`idPiece_Document`
																		AND `lieux_document`.`idEmplacement_Archive` = `emplacement_archive`.`idEmplacement_Archive`
																		AND `lieux_document`.`idSous_Emplacement` = `sous_emplacement`.`idSous_Emplacement`
																		AND `idDocument` NOT IN (
																							SELECT `document`.`idDocument`
																							FROM `document`, `equipement_has_document`
																							WHERE `document`.`idDocument` = `equipement_has_document`.`idDocument`
																							AND`idEquipement`= 18)
																		ORDER BY `document`.`idDocument` DESC LIMIT $premiereEntree, $messagesParPage";

															$retour_requete = $pdo->query($requete2); //Nous récupérons le contenu de la requête dans $retour_total



															while ($donnees = $retour_requete->fetch(PDO::FETCH_ASSOC)) { // On lit les entrées une à une grâce à une boucle	?>

																 <tr>

																	<td style="cursor: pointer;" onClick="window.open('document.php?idDocument=<?= $donnees['idDocument'];?>')"><?php echo $donnees['nomDocument']; ?></td>
																	<td style="cursor: pointer;" onClick="window.open('document.php?idDocument=<?= $donnees['idDocument'];?>')"><?php echo $donnees['valeurTypeDoc'],'-',$donnees['valeurProcessus'],'-',$donnees['valeurSousProcessus'],'-',$donnees['valeurCategorie'],'-',$donnees['valeurAcronime'],'-',$donnees['idDocument'];?></td>
																	<td style="cursor: pointer;" onClick="window.open('document.php?idDocument=<?= $donnees['idDocument'];?>')"><?php echo $donnees['valeurPlateforme'],'-',$donnees['valeurPiece'],'-',$donnees['valeurEmplacement'],'-',$donnees['valeurSousEmplacement'];?></td>
																	<td style="cursor: pointer;" onClick="window.open('document.php?idDocument=<?= $donnees['nomFichier'];?>')"></td>



																	<?php
																		if ($_SESSION['role'] == 'Administrateur') {
																	?>
																			<td width=20px>
																				<a href="doc-equi.php?idEquipement=<?= $idEquipement?>&add=<?= htmlentities($donnees['idDocument']) ?>"><img class="add" border="0" alt="Image" src='./image/add.png'
																				onClick="return(confirm('Etes-vous sûr de vouloir ajouter <?= $donnees['nomDocument'] ?> ?'));"/></a>
																		</td>
																	<?php
																		}
															}
															?>

															</tr></table>

															<?php

															echo '<p align="center">Page : '; //Pour l'affichage, on centre la liste des pages

																for ($i = 1; $i <= $nombreDePages; $i++) { //On fait notre boucle
																	 //On va faire notre condition
																	 if ($i == $pageActuelle) { //Si il s'agit de la page actuelle...
																		 echo ' [ '.$i.' ] ';
																	 }
																	 else { //Sinon...
																		 echo ' <a href="doc-equi.php?idEquipement='.$idEquipement.'&page='.$i.'">'.$i.'</a> ';
																	 }
																}

															echo '<br>';
															echo '<br>';
											}
							?>

                    </fieldset>
        </div>

        <?php }
            else {
                $message = "Vous devez être Administrateur pour acceder à cette page !";
                	echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
                header('refresh:0.01;url=index.php');
            }
        ?>
    </body>
</html>
