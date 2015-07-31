<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'update_reservation.php', formulaire de modication de la réservation.
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

	$idEquipement = $_GET['idEquipement'];
	$id = $_GET['id'];
	$createur = $_GET['createur'];

?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

    <head>
    	<title>Modification Planning</title>
    		<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="stylesheet" type="text/css" href="style.css">
    </head>


    <body>
		<?php require_once('entete.php'); ?>

				<div id="contenu">

					<div id="banniere">Modification planning n°<?= $id ?></div>

						<?php

							if ($_SESSION['nom'] == $createur) {

							//fonction pour afficher le nom de l'équipement
							$resultats=$pdo->query("SELECT *
													FROM `planning_occupation`, `plateforme`, `lieu_utilisation`, `piece_equipement`
													WHERE `planning_occupation`.`idLieu_Utilisation` = `lieu_utilisation`.`idLieu_Utilisation`
													AND `planning_occupation`.`idPiece` = `piece_equipement`.`idPiece`
													AND `planning_occupation`.`idPlateforme` = `plateforme`.`idPlateforme`
													AND `idPlanning_Occupation` = $id");
							$resultats->setFetchMode(PDO::FETCH_OBJ);

							while ($resultat = $resultats->fetch()) {
								$dateDebut = $resultat->dateDebut;
								$dateFin = $resultat->dateFin;
								$plateforme = $resultat->plateforme;
								$plateforme = $resultat->plateforme;
								$idPlateforme = $resultat->idPlateforme;
								$lieu = $resultat->lieuUtilisation;
								$idLieu = $resultat->idLieu_Utilisation;
								$piece = $resultat->piece;
								$idPiece = $resultat->idPiece;
								$fonctionPrincipal = $resultat->fonctionPrincipal;
								$fonctionSecondaire = $resultat->fonctionSecondaire;
							}

							$resultats->closeCursor();

						?>

						<fieldset class="Etiquette_Equipement"><legend>Modification planning</legend>

							<!-- Formulaire d'ajout de catégorie d'étiquette équipement -->
								<form method="post" action="update-reservation.php?idEquipement=<?= $idEquipement ?>&id=<?= $id; ?>">

									<div id="Categorie_Etiquette">
										<!-- Modification de la plateforme -->
										<label id="Categorie-Etiquette">Modifier la date de début : </label><input type="date" name="dateDebut" value="<?= $dateDebut; ?>"></p>

									<!-- Ajout de la valeur de la plateforme -->
										<label id="Categorie-Etiquette">Modifier la date de fin: </label><input type="date" name="dateFin" value="<?= $dateFin; ?>"></p>
										<label id="Categorie-Etiquette">Modifier la plateforme : </label>
											<select name="plateforme">
												<option value="<?= $idPlateforme; ?>"><?= $plateforme; ?></option>
													<?php

													$reponse = $pdo->query('SELECT *
																			FROM `plateforme`
																			WHERE `idPlateforme` BETWEEN 1 and 200');

													while ($donnees = $reponse->fetch()) {
													?>
														<option value="<?php echo $donnees['idPlateforme']; ?>"><?php echo $donnees['plateforme']; ?></option>
													<?php
													}
													?>
												</option>
											</select></p>

										<label id="Categorie-Etiquette">Modifier le lieu : </label>
											<select name="lieu">
												<option value="<?= $idLieu; ?>"><?= $lieu; ?></option>
													<?php

													$reponse = $pdo->query('SELECT *
																			FROM `lieu_utilisation`
																			WHERE `idLieu_Utilisation` BETWEEN 1 and 200');

													while ($donnees = $reponse->fetch()) {
													?>
														<option value="<?php echo $donnees['idLieu_Utilisation']; ?>"><?php echo $donnees['lieuUtilisation']; ?></option>
													<?php
													}
													?>
												</option>
											</select></p>

										<label id="Categorie-Etiquette">Modifier le piece : </label>
											<select name="piece">
												<option value="<?= $idPiece; ?>"><?= $piece; ?></option>
													<?php

													$reponse = $pdo->query('SELECT *
																			FROM `piece_equipement`
																			WHERE `idPiece` BETWEEN 1 and 200');

													while ($donnees = $reponse->fetch()) {
													?>
														<option value="<?php echo $donnees['idPiece']; ?>"><?php echo $donnees['piece']; ?></option>
													<?php
													}
													?>
												</option>
											</select></p>

										<label id="Categorie-Etiquette">Modifier la fonction principal : </label><input type="text" name="fonctionPrincipal" value="<?= $fonctionPrincipal; ?>"></p>
										<label id="Categorie-Etiquette">Modifier la fonction secondaire : </label><input type="text" name="fonctionSecondaire" value="<?= $fonctionSecondaire; ?>"></p>

										<!-- Bouton envoie catégorie -->
										<input class="submitenvoie" type="submit" value="Modifier"><br/></p>
									</div>

								</form>

						</fieldset><br>
				</div>

				<?php 		}

							else {
								$message="Vous devez être l'utilisateur de cette réservation pour acceder à cette page !";
									echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
								header('refresh:0.01;url=fiche-vie.php?idEquipement='.$idEquipement.'');
							}

			?>
    </body>
</html>
