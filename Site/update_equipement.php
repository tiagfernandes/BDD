<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'update_equipement.php', formulaire de modification de l'équipement.
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

	$idEquipement = $_GET['idEquipement'];

?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

   <head>
    <title>Modifier l'équipement n°<?= $idEquipement; ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>



   <body>

    <?php require_once('entete.php'); ?>
        <div id="contenu">
        	<div id="banniere">Modification de l'équipement n°<?= $idEquipement; ?></div>
          		<div id="form-ajout">
					<fieldset><legend>Modifier</legend>

						<form method="post" action="modification_equipement.php?idEquipement=<?= $idEquipement ?>">
							<?php	//fonction pour afficher l'équipement
								$resultats=$pdo->query("SELECT *
														FROM equipement,  fournisseur
														WHERE `equipement`.`idFournisseur` = `fournisseur`.`idFournisseur`
														AND idEquipement='$idEquipement'");
								$resultats->setFetchMode(PDO::FETCH_OBJ);
								while( $resultat = $resultats->fetch() )
								{
									$nomEquipement = $resultat->nomEquipement;
									$prixEquipement = $resultat->prix;
									$marqueEquipement = $resultat->marque;
									$fabricationEquipement = $resultat->dateFabrication;
									$receptionEquipement = $resultat->dateReception;
									$miseServiceEquipement = $resultat->dateMiseService;
									$garantieEquipement = $resultat->garantie;
									$responsable = $resultat->responsable;
									$nomVariableAutomate = $resultat->nomVariableAutomate;
									$adresseAutomate = $resultat->adresseAutomate;
									$idStoc = $resultat->idStoc;
									$nFabrication = $resultat->nFabrication;
									$attestationExamen = $resultat->attestationExamen;
									$contratEntretien = $resultat->contratEntretien;
									$suppleant = $resultat->suppleant;
									$observation = $resultat->observation;

									$fournisseur = $resultat->nomFournisseur;
									$idFounisseur = $resultat->idFournisseur;

								}
								$resultats->closeCursor();
							?>

							<label id="ajout_element">Nom : </label><input type="text" name="newNom" value="<?= $nomEquipement; ?>"></p>
							<label id="ajout_element">Prix : </label><input type="double" name="newPrix" value="<?= $prixEquipement; ?>"></p>
							<label id="ajout_element">Marque : </label><input type="text" name="newMarque" value="<?= $marqueEquipement; ?>"></p>
							<label id="ajout_element">Date de fabrication : </label><input type="date" name="newDateFabrication" value="<?= $fabricationEquipement; ?>" ></p>
							<label id="ajout_element">Date de réception : </label><input type="date" name="newDateReception" value="<?= $receptionEquipement; ?>"></p>
							<label id="ajout_element">Date de mise en service : </label><input type="date" name="newDateMiseService" value="<?= $miseServiceEquipement; ?>"></p>
							<label id="ajout_element">Fin de garantie : </label><input type="date" name="newGarantie" value="<?= $garantieEquipement; ?>"></p>
							<label id="ajout_element">Responsable : </label><input type="text" name="newResponsable" value="<?= $responsable; ?>"></p>
							<label id="ajout_element">Variable automate : </label><input type="text" name="newVariableAutomate" value="<?= $nomVariableAutomate; ?>"></p>
							<label id="ajout_element">Adresse automate : </label><input type="text" name="newAdresseAutomate" value="<?= $adresseAutomate; ?>"></p>
							<label id="ajout_element">Id-Stoc : </label><input type="int" name="newIdStoc" value="<?= $idStoc; ?>"></p>
							<label id="ajout_element">Numéro fabrication : </label><input type="text" name="newFabrication" value="<?= $nFabrication; ?>"></p>
							<label id="ajout_element">Attestation examen : </label><input type="text" name="newAttestationExamen" value="<?= $attestationExamen; ?>"></p>
							<label id="ajout_element">Contrat entretien : </label><input type="text" name="newContratEntretien" value="<?= $contratEntretien; ?>"></p>
							<label id="ajout_element">Suppleant : </label><input type="text" name="newSuppleant" value="<?= $suppleant; ?>"></p>
							<label id="ajout_element">Observation : </label><input type="text" name="newObservation" value="<?= $observation; ?>"></p>
							<label id="ajout_element">Fournisseur : </label></p>
								<select name="newFournisseur">
									<option value=<?= $idFounisseur ?>><?= $fournisseur ?></option>
										<?php
											$reponse = $pdo->query('SELECT * FROM fournisseur ORDER BY nomFournisseur LIMIT 1, 1000');
											while ( $donnees = $reponse->fetch() ) {
										?>
												<option value="<?php echo $donnees['idFournisseur']; ?>"><?php echo $donnees['nomFournisseur']; ?></option>
										<?php
											}
										?>
								</select>
							<br><br>

							<input class="bouton" onclick="return(confirm('Etes-vous sur de vouloir modifier l&#180&#233quipement ? '));" type="submit" value="Modifier">
						 </form>
          			</fieldset><br><br>
        		</div>
        </div>
    </body>
</html>
