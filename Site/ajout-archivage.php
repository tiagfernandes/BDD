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
									<th width=100px>Valeur plateforme</th>
									<th width=200px>Plateforme</th>
									<th>Modifer</th>

										<?php foreach ($listePlateforme as $cle=>$valeur): ?>
											<tr>
												<?php foreach ($valeur as $val): ?>
													<td><?= htmlentities($val) ?></td>
												<?php endforeach; ?>

										<!-- Bouton modifier catégorie -->
												<td><a href=ajout-archivage.php?update_plateforme=<?= htmlentities($valeur['idPlateforme_Archive']) ?>
									onClick="return(confirm('Modifier <?= $valeur['plateformeArchive']  ?> ?'));">Modifier</a></td>

										<!-- Bouton supprimer catégorie -->
												<td><img src="./image/poubelle1.png" alt="Image" onmouseover="javascript:this.src='./image/poubelle2.png';" onmouseout="javascript:this.src='./image/poubelle1.png';"  href=index.php?delete=<?= htmlentities($valeur['idPlateforme_Archive']) ?>
											onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $valeur['plateformeArchive'] ?> ?'));"/></td>
											</tr>
										<?php endforeach; ?>
								</table><br>


								<table class="tabCatAcr" style="border: 2px solid #4f426c">
									<th>id</th>
									<th width=100px>Valeur piece</th>
									<th width=200px>Piece</th>
									<th>Modifer</th>

										<?php foreach ($listePiece as $cle=>$valeur): ?>
											<tr>
												<?php foreach ($valeur as $val): ?>
													<td><?= htmlentities($val) ?></td>
												<?php endforeach; ?>

										<!-- Bouton modifier catégorie -->
											<td><a href=ajout-archivage.php?update_piece=<?= htmlentities($valeur['idPiece_Document']) ?>
									onClick="return(confirm('Modifier <?= $valeur['pieceDocument']  ?> ?'));">Modifier</a></td>

										<!-- Bouton supprimer catégorie -->
												<?php
										if($_SESSION['role']=='Administrateur'){
										?>
											<td><img src="./image/poubelle1.png" alt="Image" onmouseover="javascript:this.src='./image/poubelle2.png';" onmouseout="javascript:this.src='./image/poubelle1.png';"  href=index.php?delete=<?= htmlentities($valeur['idPiece_Document']) ?>
											onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $valeur['pieceDocument'] ?> ?'));"/></td>
									<?php
										}
									?>
											</tr>
										<?php endforeach; ?>
								</table><br>


								<table class="tabCatAcr" style="border: 2px solid #4f426c">
									<th>id</th>
									<th width=100px>Valeur emplacement</th>
									<th width=200px>Emplacement</th>
									<th>Modifer</th>

										<?php foreach ($listeEmplacement as $cle=>$valeur): ?>
											<tr>
												<?php foreach ($valeur as $val): ?>
													<td><?= htmlentities($val) ?></td>
												<?php endforeach; ?>

										<!-- Bouton modifier emplacement -->
												<td><a href=ajout-archivage.php?update_emplacement=<?= htmlentities($valeur['idEmplacement_Archive']) ?>
									onClick="return(confirm('Modifier <?= $valeur['emplacementArchive']  ?> ?'));">Modifier</a></td>

										<!-- Bouton supprimer emplacement -->
												<td><img src="./image/poubelle1.png" alt="Image" onmouseover="javascript:this.src='./image/poubelle2.png';" onmouseout="javascript:this.src='./image/poubelle1.png';"  href=index.php?delete=<?= htmlentities($valeur['idEmplacement_Archive']) ?>
											onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $valeur['emplacementArchive'] ?> ?'));"/></td>
											</tr>
										<?php endforeach; ?>
								</table><br>


								<table class="tabCatAcr" style="border: 2px solid #4f426c">
									<th>id</th>
									<th width=100px>Valeur sous emplacement</th>
									<th width=200px>Sous emplacement</th>
									<th>Modifer</th>

										<?php foreach ($listeSousEmplacement as $cle=>$valeur): ?>
											<tr>
												<?php foreach ($valeur as $val): ?>
													<td><?= htmlentities($val) ?></td>
												<?php endforeach; ?>

										<!-- Bouton modifier catégorie -->
												<td><a href=ajout-archivage.php?update_sous_emplacement=<?= htmlentities($valeur['idSous_Emplacement']) ?>
									onClick="return(confirm('Modifier <?= $valeur['sousEmplacement']  ?> ?'));">Modifier</a></td>

										<!-- Bouton supprimer emplacement -->
												<td><img src="./image/poubelle1.png" alt="Image" onmouseover="javascript:this.src='./image/poubelle2.png';" onmouseout="javascript:this.src='./image/poubelle1.png';"  href=index.php?delete=<?= htmlentities($valeur['idSous_Emplacement']) ?>
											onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $valeur['sousEmplacement'] ?> ?'));"/></td>
											</tr>
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
