<?php
    require_once('fonctions.php');


    $listeEquipement = getAllEquipement($pdo);
    $listeUtilisateur = getAllUtilisateur($pdo);
    $listeEtiquetteEquipement = getEtiquetteEquipement($pdo);
	//$listeEquipementEtiquette = getEquipementEtiquette($pdo);
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
       				<fieldset><legend>Fiche réservation</legend>
						<form method="post" action="ajout_reservation.php?idEquipement=<?= $idEquipement?>">
							<label id="">Date de début :*</label><input type="date" name="dateDebut" placeholder=""></p>
							<label id="">Date de fin : </label><input type="date" name="dateFin" value=""></p>
							<label id="">Plateforme :*</label>
										<select name="plateforme">
											<option value=NULL>-- Plateforme --</option>
												<?php
													$reponse = $pdo->query('SELECT * FROM plateforme ORDER BY plateforme');
													while ($donnees = $reponse->fetch()){
												?>
														<option value="<?php echo $donnees['idPlateforme']; ?>"><?php echo $donnees['plateforme'];?></option>
												<?php
													}
												?>
										</select></p>

							<label id="">Lieu d'utilisation :</label>
										<select name="lieu">
											<option value=NULL>-- Lieu --</option>
												<?php
													$reponse = $pdo->query('SELECT * FROM lieu_utilisation ORDER BY lieuUtilisation');
													while ($donnees = $reponse->fetch()){
												?>
														<option value="<?php echo $donnees['idLieu_Utilisation']; ?>"><?php echo $donnees['lieuUtilisation'];?></option>
												<?php
													}
												?>
										</select></p>

							<label id="">Pièce :</label>
										<select name="piece">
											<option value=NULL>-- Pièce --</option>
												<?php
													$reponse = $pdo->query('SELECT * FROM piece_equipement ORDER BY piece');
													while ($donnees = $reponse->fetch()){
												?>
														<option value="<?php echo $donnees['idPiece']; ?>"><?php echo $donnees['valeur'];?> - <?php echo $donnees['piece'] ;?></option>
												<?php
													}
												?>
										</select></p>
							<label id="">Fonction principal :</label><input type="text" name="fonctionP" value=""></p>
							<label id="">Fonction secondaire :</label><input type="text" name="fonctionS" value=""></p>

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
        	</div>
   </body>
</html>
