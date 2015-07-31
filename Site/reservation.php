<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'reservation.php', formulaire pour réserver un équipement.
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


    $listeEquipement = getAllEquipement($pdo);
    $listeUtilisateur = getAllUtilisateur($pdo);
    $listeEtiquetteEquipement = getEtiquetteEquipement($pdo);
	$idEquipement = $_GET['idEquipement'];

?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

	<head>
    	<title>Planning</title>
			<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
			<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
			<link rel="stylesheet" type="text/css" href="style.css">
   	</head>


	<body>
		<?php require_once('entete.php'); ?>

			<div id ="contenu">

				<div id="banniere">Réservation d'équipement n°<?= $idEquipement;?></div>

      				<div id="form-ajout">

						<fieldset><legend>Fiche réservation</legend>

							<form method="post" action="ajout_reservation.php?idEquipement=<?= $idEquipement?>">

								<label id="ajout_element">Date de début :*</label><input type="date" name="dateDebut" placeholder=""></p>
								<label id="ajout_element">Date de fin : </label><input type="date" name="dateFin" value=""></p>

								<label id="ajout_element">Plateforme :*</label>
											<select name="plateforme">
													<?php
														$reponse = $pdo->query('SELECT * FROM plateforme ORDER BY plateforme');

														while ($donnees = $reponse->fetch()) {
													?>
															<option value="<?php echo $donnees['idPlateforme']; ?>"><?php echo $donnees['plateforme'];?></option>
													<?php
														}
													?>
											</select></p>

								<label id="ajout_element">Lieu d'utilisation :*</label>
											<select name="lieu">
												<option value=NULL>-- Lieu --</option>
													<?php
														$reponse = $pdo->query('SELECT * FROM lieu_utilisation WHERE idLieu_Utilisation BETWEEN 1 and 200 ORDER BY lieuUtilisation');

														while ($donnees = $reponse->fetch()){
													?>
															<option value="<?php echo $donnees['idLieu_Utilisation']; ?>"><?php echo $donnees['lieuUtilisation'];?></option>
													<?php
														}
													?>
											</select></p>

								<label id="ajout_element">Pièce :*</label>
											<select name="piece">
												<option value=NULL>-- Pièce --</option>
													<?php
														$reponse = $pdo->query('SELECT * FROM piece_equipement WHERE idPiece BETWEEN 1 and 200 ORDER BY piece ');

														while ($donnees = $reponse->fetch()){
													?>
															<option value="<?php echo $donnees['idPiece']; ?>"><?php echo $donnees['piece'] ;?></option>
													<?php
														}
													?>
											</select></p>

								<label id="ajout_element">Fonction principal :</label><input type="text" name="fonctionP" placeholder="Fonction principal"></p>
								<label id="ajout_element">Fonction secondaire :</label><input type="text" name="fonctionS" placeholder="Fonction secondaire"></p>

								<input class="bouton" type="submit" value="Ajouter">

							</form>

							<div class="text">
								<?php
									$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
									if ($monUrl == "http://localhost/BDD/Site/reservation.php?idEquipement='.$idEquipement.'&?succes"){
										echo ("Acronime ajouté avec succès !");
									}
								?>
							</div>

							<div id ="erreur">
								<?php
									$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
									if ($monUrl == "http://localhost/BDD/Site/reservation.php?idEquipement='.$idEquipement.'&?erreur"){
										echo ("Veuilliez saisir tous les champs !");
									}
								?>
							</div>

						</fieldset>
        			</div>
        	</div>
   </body>
</html>
