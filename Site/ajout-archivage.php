<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'ajout-archivage.php', formulaire d'insersion d'une nouvelle
plateforme, d'une nouvelle pièce, d'un nouveau emplacement, d'un nouveau
sous-emplacement.
---------------------------------------------------------------------------
L'utilisateur :
Ne peut rien faire.
---------------------------------------------------------------------------
Le développeur :
Autorisé.
---------------------------------------------------------------------------
L'administrateur :
Autorisé, peut supprimer.
------------------------------------------------------------------------ */

    require_once('fonctions.php');

	if(isset($_GET['delete_plateforme'])){ //Supprime la plateforme choisis
        $id = $_GET['delete_plateforme'];
        deletePlateforme($id);
    }

	if(isset($_GET['delete_piece'])){ //Supprime la pièce choisis
        $id = $_GET['delete_piece'];
        deletePiece($id);
    }

	if(isset($_GET['delete_emplacement'])){ //Supprime l'emplacement choisis
        $id = $_GET['delete_emplacemement'];
        deleteEmplacement($id);
    }

	if(isset($_GET['delete_sous-emplacement'])){ //Supprime le sous-emplacement choisis
        $id = $_GET['delete_sous-emplacement'];
        deleteSousEmplacement($id);
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
    		<link rel="stylesheet" type="text/css" href="style.css"/>
    </head>


    <body>
		<?php require_once('entete.php'); ?>

			<?php if ($_SESSION['role'] == "Administrateur") { ?><!-- Si l'utilisateur est Administrateur -->

				<div id="contenu">

					<div id="banniere">Ajout d'archivage de document</div>

						<fieldset class="Etiquette_Equipement"><legend>Archivage</legend>

							<!-- Formulaire d'ajout de lieu d'archive -->
								<div id="form-ajout">

									<form method="get" action="ajout_plateforme.php">
										<!-- Ajout d'une plateforme -->
										<label id="ajout_element">Ajouter une plateforme : </label><input class="" type="text" name="val_plateforme" placeholder="Valeur plateforme"> - <input class="" type="text" name="plateforme" placeholder="Plateforme">
										<input class="" type="submit" value="Ajouter"></p>
									</form>

								<hr><!-- Trait de séparation --></hr>

									<form method="get" action="ajout_piece.php">
										<!-- Ajout d'une piece -->
										<label id="ajout_element">Ajouter une pièce : </label><input class="" type="text" name="val_piece" placeholder="Valeur pièce"> - <input class="" type="text" name="piece" placeholder="Pièce">
										<input class="" type="submit" value="Ajouter"></p>
									</form>

								<hr><!-- Trait de séparation --></hr>

									<form method="get" action="ajout_emplacement.php">
										<label id="ajout_element">Ajouter un emplacement : </label><input class="" type="text" name="val_emplacement" placeholder="Valeur emplacement"> - <input class="" type="text" name="emplacement" placeholder="Emplacement">
										<input class="" type="submit" value="Ajouter"></p>
									</form>

								<hr><!-- Trait de séparation --></hr>

									<form method="get" action="ajout_sous_emplacement.php">
										<label id="ajout_element">Ajouter un sous emplacement : </label><input class="" type="text" name="val_s_emplacement" placeholder="Valeur sous emplacement"> - <input class="" type="text" name="s_emplacement" placeholder="Sous emplacement">
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
						</fieldset><br>


								<table class="tabCatAcr" style="border: 2px solid #4f426c">

									<th>id</th>
									<th width=200px>Valeur plateforme</th>
									<th width=200px>Plateforme</th>

										<?php foreach ($listePlateforme as $cle=>$valeur): ?>
											<tr>
												<?php foreach ($valeur as $val): ?>
													<td><?= htmlentities($val) ?></td>
												<?php endforeach; ?>

											<!-- Bouton modifier plateforme -->
												<td width=20px>
													<a href="update-plateforme.php?update=<?= htmlentities($valeur['idPlateforme_Archive']) ?>"><img class="modifier" border="0" alt="Image" src='./image/modifier.png'
													onClick="return(confirm('Modifier <?= $valeur['plateformeArchive']  ?> ?'));"/></a>
												</td>

											<!-- Bouton supprimer plateforme -->
												<td width=20px>
													<a href="ajout-archivage.php?delete_plateforme=<?= htmlentities($valeur['idPlateforme_Archive']) ?>"><img class="poubelle" border="0" alt="Image" src='./image/poubelle1.png'
													onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $valeur['plateformeArchive'] ?> ?'));"/></a>
												</td>
											</tr>
										<?php endforeach; ?>

								</table><br>


								<table class="tabCatAcr" style="border: 2px solid #4f426c">

									<th>id</th>
									<th width=200px>Valeur piece</th>
									<th width=200px>Piece</th>

										<?php foreach ($listePiece as $cle=>$valeur): ?>
											<tr>
												<?php foreach ($valeur as $val): ?>
													<td><?= htmlentities($val) ?></td>
												<?php endforeach; ?>

											<!-- Bouton modifier pièce -->
												<td width=20px>
													<a href="update-piece.php?update=<?= htmlentities($valeur['idPiece_Document']) ?>"><img class="modifier" border="0" alt="Image" src='./image/modifier.png'
													onClick="return(confirm('Modifier <?= $valeur['pieceDocument']  ?> ?'));"/></a>
												</td>

											<!-- Bouton supprimer pièce -->
												<td width=20px>
													<a href="ajout-archivage.php?delete_piece=<?= htmlentities($valeur['idPiece_Document']) ?>"><img class="poubelle" border="0" alt="Image" src='./image/poubelle1.png'
													onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $valeur['pieceDocument'] ?> ?'));"/></a>
												</td>

											</tr>
										<?php endforeach; ?>

								</table><br>


								<table class="tabCatAcr" style="border: 2px solid #4f426c">

									<th>id</th>
									<th width=200px>Valeur emplacement</th>
									<th width=200px>Emplacement</th>

										<?php foreach ($listeEmplacement as $cle=>$valeur): ?>
											<tr>
												<?php foreach ($valeur as $val): ?>
													<td><?= htmlentities($val) ?></td>
												<?php endforeach; ?>

											<!-- Bouton modifier emplacement -->
												<td width=20px>
													<a href="update-emplacement.php?update=<?= htmlentities($valeur['idEmplacement_Archive']) ?>"><img class="modifier" border="0" alt="Image" src='./image/modifier.png'
													onClick="return(confirm('Modifier <?= $valeur['emplacementArchive']  ?> ?'));"/></a>
												</td>

											<!-- Bouton supprimer emplacement -->
												<td width=20px>
													<a href="ajout-archivage?delete_emplacement=<?= htmlentities($valeur['idEmplacement_Archive']) ?>"><img class="poubelle" border="0" alt="Image" src='./image/poubelle1.png'
													onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $valeur['emplacementArchive'] ?> ?'));"/></a>
												</td>
											</tr>
										<?php endforeach; ?>

								</table><br>


								<table class="tabCatAcr" style="border: 2px solid #4f426c">
									<th>id</th>
									<th width=200px>Valeur sous emplacement</th>
									<th width=200px>Sous emplacement</th>

										<?php foreach ($listeSousEmplacement as $cle=>$valeur): ?>
											<tr>
												<?php foreach ($valeur as $val): ?>
													<td><?= htmlentities($val) ?></td>
												<?php endforeach; ?>

											<!-- Bouton modifier sous emplacement -->
											<td width=20px>
												<a href="update-sous-emplacement.php?update=<?= htmlentities($valeur['idSous_Emplacement']) ?>"><img class="modifier" border="0" alt="Image" src='./image/modifier.png'
												onClick="return(confirm('Modifier <?= $valeur['sousEmplacement']  ?> ?'));"/></a>
											</td>

											<!-- Bouton supprimer sous emplacement -->
												<td width=20px>
													<a href="ajout-archivage.php?delete_sous-emplacement=<?= htmlentities($valeur['idSous_Emplacement']) ?>"><img class="poubelle" border="0" alt="Image" src='./image/poubelle1.png'
													onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $valeur['sousEmplacement'] ?> ?'));"/></a>
												</td>
										<?php endforeach; ?>
								</table><br>

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
