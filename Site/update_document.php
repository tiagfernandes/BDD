<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'update_document.php', formulaire de modification du document chosisi.
---------------------------------------------------------------------------
L'utilisateur :
N'est pas autorisé.
---------------------------------------------------------------------------
Le développeur :
Autorisé.
---------------------------------------------------------------------------
L'administrateur :
Autorisé.
------------------------------------------------------------------------ */

    require_once('fonctions.php');

	$idDocument = $_GET['idDocument'];

?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

   	<head>
		<title>Modifier l'équipement n°<?= $idDocument; ?></title>
			<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
			<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
			<link rel="stylesheet" type="text/css" href="style.css">
    </head>



   	<body>

    <?php require_once('entete.php'); ?>

    	<div id="contenu">

       		<div id="banniere">Modification du document n°<?= $idDocument; ?></div>

          		<div id="form-ajout">

              		<fieldset><legend>Modifier</legend>

						<form method="post" action="modification_document.php?idDocument=<?= $idDocument ?>" enctype="multipart/form-data">

							<?php	//fonction pour afficher le nom de l'équipement
								$resultats=$pdo->query("SELECT * FROM document, lieux_document, plateforme_archive, piece_document, emplacement_archive, sous_emplacement, etiquette_equipement, categorie_etiquette, acronime_etiquette, etiquette_document
								WHERE document.idLieux_Document = lieux_document.idLieux_Document
								AND lieux_document.idPlateforme_Archive = plateforme_archive.idPlateforme_Archive
								AND lieux_document.idPiece_Document = piece_document.idPiece_Document
								AND lieux_document.idEmplacement_Archive = emplacement_archive.idEmplacement_Archive
								AND lieux_document.idSous_Emplacement = sous_emplacement.idSous_Emplacement
								AND document.idEtiquette_Document = etiquette_document.idEtiquette_Document
								AND etiquette_document.idEtiquette_Equipement = etiquette_equipement.idEtiquette_Equipement
								AND etiquette_equipement.idCategorieEtiquette = categorie_etiquette.idCategorieEtiquette
								AND etiquette_equipement.idAcronimeEtiquette = acronime_etiquette.idAcronimeEtiquette
								AND idDocument='$idDocument'");
								$resultats->setFetchMode(PDO::FETCH_OBJ);

								while ($resultat = $resultats->fetch()) {
									$nomDocument = $resultat->nomDocument;

									$plateforme = $resultat->plateformeArchive;
									$idPlateforme = $resultat->idPlateforme_Archive;
									$valPlateforme = $resultat->valeurPlateforme;

									$idPiece = $resultat->idPiece_Document;
									$piece = $resultat->pieceDocument;
									$valPiece = $resultat->valeurPiece;

									$idEmplacement = $resultat->idEmplacement_Archive;
									$emplacement = $resultat->emplacementArchive;
									$valEmplacement = $resultat->valeurEmplacement;

									$idSousEmplacement = $resultat->idSous_Emplacement;
									$sousEmplacement = $resultat->sousEmplacement;
									$valSousEmplacement = $resultat->valeurSousEmplacement;

									$valCategorie = $resultat->valeurCategorie;
									$valAcronime = $resultat->valeurAcronime;
									$idEtiquetteEquipement = $resultat->idEtiquette_Equipement;
									$idEquipement = $resultat->idEquipement;

									$nomFichier = $resultat->nomFichier;
									$cheminFichier = $resultat->cheminFichier;


									$nomFichier = substr($nomFichier, 0,-13);
								}

								$resultats->closeCursor();
							?>

							<!-- Affichage du nom du document -->
							<label id="ajout_element">Nom : </label><input type="text" name="newNom" value="<?= $nomDocument; ?>"></p>

							<label id="ajout_element">Etiquette équipement lier au document : </label>
                               	<select name="idEtiquetteEquipement">
                                    <option value="<?= $idEtiquetteEquipement; ?>"><?= $valCategorie; ?> - <?= $valAcronime; ?> - <?= $idEquipement; ?></option>
                                        <?php

                                        $reponse = $pdo->query('SELECT *
																FROM `categorie_etiquette`, `acronime_etiquette`, `etiquette_equipement`
																WHERE `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
																AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
																ORDER BY `valeurCategorie` ASC');

                                        while ($donnees = $reponse->fetch()) {
                                        ?>
                                            <option value="<?php echo $donnees['idEtiquette_Equipement']; ?>"><?php echo $donnees['valeurCategorie']; ?> - <?php echo $donnees['valeurAcronime']?> - <?php echo $donnees['idEquipement']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </option>
	   							</select><img src="image/point-interrogation.png" width="17" height="17" title="Sélectionner l'étiquette de l'équipement correspondant au document."></p><br/>


							<!-- Affichage de la plateforme du document -->
							<label id="ajout_element">Plateforme : </label>
                            	<select name="newPlateforme">
                                    <option value="<?= $idPlateforme; ?>"><?= $valPlateforme; ?></option>
                                        <?php

                                        $reponse = $pdo->query('SELECT *
																FROM `plateforme_archive`
																WHERE `idPlateforme_Archive` BETWEEN 1 and 200
																ORDER BY `plateformeArchive` ASC');

                                        while ($donnees = $reponse->fetch()) {
                                        ?>
                                            <option value="<?php echo $donnees['idPlateforme_Archive']; ?>"><?php echo $donnees['valeurPlateforme'],' - ', $donnees['plateformeArchive']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </option>
								</select></p>

							<!-- Affcihage de la piece du document -->
							<label id="ajout_element">Piece : </label>
                      			<select name="newPiece">
                                    <option value="<?= $idPiece; ?>"><?= $valPiece?></option>
                                        <?php

                                        $reponse = $pdo->query('SELECT *
																FROM `piece_document`
																WHERE `idPiece_Document` BETWEEN 1 and 200
																ORDER BY `pieceDocument` ASC');

                                        while ($donnees = $reponse->fetch()) {
                                        ?>
                                            <option value="<?php echo $donnees['idPiece_Document']; ?>"><?php echo $donnees['valeurPiece'],' -',$donnees['pieceDocument']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </option>
								</select></p>
							<!-- Affichage de l'emplacement du document -->
							<label id="ajout_element">Emplacement : </label>
								<select name="newEmplacement">
                                    <option value="<?= $idEmplacement; ?>"><?= $valEmplacement; ?></option>
                                        <?php

                                        $reponse = $pdo->query('SELECT *
																FROM `emplacement_archive`
																WHERE `idEmplacement_Archive` BETWEEN 1 and 200
																ORDER BY `emplacementArchive` ASC');

                                        while ($donnees = $reponse->fetch()) {
                                        ?>
                                            <option value="<?php echo $donnees['idEmplacement_Archive']; ?>"><?php echo $donnees['valeurEmplacement'],' - ', $donnees['emplacementArchive']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </option>
								</select></p>
							<!-- Affichage du sous emplacement -->
							<label id="ajout_element">Sous emplacement : </label>
								<select name="newSousEmplacement">
                                    <option value="<?= $idSousEmplacement; ?>"><?= $valSousEmplacement; ?></option>
                                        <?php

                                        $reponse = $pdo->query('SELECT *
																FROM `sous_emplacement`
																WHERE `idSous_Emplacement` BETWEEN 1 and 200
																ORDER BY `sousEmplacement` ASC');

                                        while ($donnees = $reponse->fetch()) {
                                        ?>
                                            <option value="<?php echo $donnees['idSous_Emplacement']; ?>"><?php echo $donnees['valeurSousEmplacement'],' - ',$donnees['sousEmplacement']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </option>
								</select></p>

							<label for="mon_fichier" id="ajout_element"id="ajout_element">Ajout / Modifier le fichier : </label>
							<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
							<input type="file" name="mon_fichier" id="mon_fichier"/><br>

							<label for="nom" id="ajout_element">Renommer le fichier (max. 50 caractères) :</label>
							<input type="text" name="newNomDoc" placeholder="Nom du fichier" id="nom" value="<?= $nomFichier; ?>"/><br/>
							<label><i>La date sera ajouter automatiquement au nom du fichier.</i>

							</br></br>

								<input class="bouton" onclick="return(confirm('Etes-vous sur de vouloir modifier l&#180&#233quipement ? '));" type="submit" value="Modifier">

						 </form>

          			</fieldset>

        		</div>
        </div>
    </body>
</html>
