<?php
    require_once('fonctions.php');

	if(isset($_GET['delete_plateforme'])){ //Supprime acronime
        $id = $_GET['delete_plateforme'];
        deletePlateforme($id);
    }

	$acronime = getAcronime($pdo);
	$listePlateforme = getAllPlateforme($pdo);
	$listePiece = getAllPiece($pdo);
	$listeEmplacement = getAllEmplacement($pdo);
	$listeSousEmplacement = getAllSousEmplacement($pdo);
?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

    <head>
    	<title>Ajout archivage</title>
    		<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="stylesheet" type="text/css" href="style.css">
    </head>


    <body>
		<?php require_once('entete.php'); ?>
			<?php if ($_SESSION['role']== "Administrateur"){?><!-- Si l'utilisateur est Administrateur -->
				<div id="contenu">
					<div id="banniere">Ajout d'archivage de document</div>

						<fieldset class="Etiquette_Equipement"><legend>Archivage</legend>
							<!-- Formulaire d'ajout de lieu d'archive -->
								<div id="">
									<form method="get" action="ajout_plateforme.php">
										<!-- Ajout d'une plateforme -->
										<label id="">Ajouter une plateforme : </label><input class="" type="text" name="plateforme" placeholder="Plateforme">-<input class="" type="text" name="val_plateforme" placeholder="Valeur plateforme">
										<input class="" type="submit" value="Ajouter"></p>
									</form>

									<form method="get" action="ajout_piece.php">
										<!-- Ajout d'une piece -->
										<label id="">Ajouter une pièce : </label><input class="" type="text" name="piece" placeholder="Pièce">- <input class="" type="text" name="val_piece" placeholder="Valeur pièce">
										<input class="" type="submit" value="Ajouter"></p>
									</form>

									<form method="get" action="ajout_emplacement.php">
										<label id="">Ajouter un emplacement : </label><input class="" type="text" name="emplacement" placeholder="Emplacement">-<input class="" type="text" name="val_emplacement" placeholder="Valeur emplacement">
										<input class="" type="submit" value="Ajouter"></p>
									</form>

									<form method="get" action="ajout_sous_emplacement.php">
										<label id="">Ajouter un sous emplacement : </label><input class="" type="text" name="s_emplacement" placeholder="Sous emplacement">-<input class="" type="text" name="val_s_emplacement" placeholder="Valeur sous emplacement">
										<input class="" type="submit" value="Ajouter"></p>
									</form>

									<div class="text">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
											if ($monUrl == "http://localhost/BDD/Site/ajout-archivage.php?succes_plateforme"){
												echo ("Plateforme ajouté avec succès !");
											}
										?>
									</div>

									<div class="text">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
											if ($monUrl == "http://localhost/BDD/Site/ajout-archivage.php?succes_piece"){
												echo ("Pièce ajouté avec succès !");
											}
										?>
									</div>

									<div class="text">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
											if ($monUrl == "http://localhost/BDD/Site/ajout-archivage.php?succes_emplacement"){
												echo ("Emplacement ajouté avec succès !");
											}
										?>
									</div>

									<div class="text">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
											if ($monUrl == "http://localhost/BDD/Site/ajout-archivage.php?succes_s_emplacement"){
												echo ("Sous emplacement ajouté avec succès !");
											}
										?>
									</div>

									<div id ="erreur">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
											if ($monUrl == "http://localhost/BDD/Site/ajout-archivage.php?erreur"){
												echo ("Veuilliez saisir un champ !");
											}
										?>
									</div>
								</div>
						</fieldset>


								<table class="tabCatAcr" border="1">
									<th>id</th>
									<th>Valeur plateforme</th>
									<th>Plateforme</th>
									<th>Supprimer</th>
									<th>Modifer</th>

										<?php foreach ($listePlateforme as $cle=>$valeur): ?>
											<tr>
												<?php foreach ($valeur as $val): ?>
													<td><?= htmlentities($val) ?></td>
												<?php endforeach; ?>

										<!-- Bouton supprimer catégorie -->
												<td><a href=ajout-archivage.php?delete_plateforme=<?= htmlentities($valeur['idPlateforme_Archive']) ?>
									onClick="return(confirm('Supprimer <?= $valeur['plateformeArchive']  ?> ?'));">Supprimer</a></td>

										<!-- Bouton modifier catégorie -->
												<td><a href=ajout-archivage.php?update_plateforme=<?= htmlentities($valeur['idPlateforme_Archive']) ?>
									onClick="return(confirm('Modifier <?= $valeur['plateformeArchive']  ?> ?'));">Modifier</a></td>
											</tr>
										<?php endforeach; ?>
								</table>

								<table class="tabCatAcr" border="1">
									<th>id</th>
									<th>Valeur piece</th>
									<th>Piece</th>
									<th>Supprimer</th>
									<th>Modifer</th>

										<?php foreach ($listePiece as $cle=>$valeur): ?>
											<tr>
												<?php foreach ($valeur as $val): ?>
													<td><?= htmlentities($val) ?></td>
												<?php endforeach; ?>

										<!-- Bouton supprimer catégorie -->
												<td><a href=ajout-archivage.php?delete_piece=<?= htmlentities($valeur['idPiece_Document']) ?>
									onClick="return(confirm('Supprimer <?= $valeur['pieceDocument']  ?> ?'));">Supprimer</a></td>

										<!-- Bouton modifier catégorie -->
												<td><a href=ajout-archivage.php?update_piece=<?= htmlentities($valeur['idPiece_Document']) ?>
									onClick="return(confirm('Modifier <?= $valeur['pieceDocument']  ?> ?'));">Modifier</a></td>
											</tr>
										<?php endforeach; ?>
								</table>

								<table class="tabCatAcr" border="1">
									<th>id</th>
									<th>Valeur emplacement</th>
									<th>Emplacement</th>
									<th>Supprimer</th>
									<th>Modifer</th>

										<?php foreach ($listeEmplacement as $cle=>$valeur): ?>
											<tr>
												<?php foreach ($valeur as $val): ?>
													<td><?= htmlentities($val) ?></td>
												<?php endforeach; ?>

										<!-- Bouton supprimer catégorie -->
												<td><a href=ajout-archivage.php?delete_emplacement=<?= htmlentities($valeur['idEmplacement_Archive']) ?>
									onClick="return(confirm('Supprimer <?= $valeur['emplacementArchive']  ?> ?'));">Supprimer</a></td>

										<!-- Bouton modifier catégorie -->
												<td><a href=ajout-archivage.php?update_emplacement=<?= htmlentities($valeur['idEmplacement_Archive']) ?>
									onClick="return(confirm('Modifier <?= $valeur['emplacementArchive']  ?> ?'));">Modifier</a></td>
											</tr>
										<?php endforeach; ?>
								</table>

								<table class="tabCatAcr" border="1">
									<th>id</th>
									<th>Valeur sous emplacement</th>
									<th>Sous emplacement</th>
									<th>Supprimer</th>
									<th>Modifer</th>

										<?php foreach ($listeSousEmplacement as $cle=>$valeur): ?>
											<tr>
												<?php foreach ($valeur as $val): ?>
													<td><?= htmlentities($val) ?></td>
												<?php endforeach; ?>

										<!-- Bouton supprimer catégorie -->
												<td><a href=ajout-archivage.php?delete_sous_emplacement=<?= htmlentities($valeur['idSous_Emplacement']) ?>
									onClick="return(confirm('Supprimer <?= $valeur['sousEmplacement']  ?> ?'));">Supprimer</a></td>

										<!-- Bouton modifier catégorie -->
												<td><a href=ajout-archivage.php?update_sous_emplacement=<?= htmlentities($valeur['idSous_Emplacement']) ?>
									onClick="return(confirm('Modifier <?= $valeur['sousEmplacement']  ?> ?'));">Modifier</a></td>
											</tr>
										<?php endforeach; ?>
								</table>

				</div>
			<?php }
				else{
					$message="Vous devez être Administrateur pour acceder à cette page !";
						echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
					header('refresh:0.01;url=index.php');
				}
			?>
    </body>
</html>
