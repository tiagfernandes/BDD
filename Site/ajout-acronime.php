<?php
    require_once('fonctions.php');

	if(isset($_GET['delete'])){ //Supprime categorie
        $id = $_GET['delete'];
        deleteAcronime($id);
    }

	$acronime = getAcronime($pdo);
?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

    <head>
    	<title>Ajout</title>
    		<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="stylesheet" type="text/css" href="style.css">
    </head>


    <body>
		<?php require_once('entete.php'); ?>
			<?php if ($_SESSION['role']== "Administrateur") {?>
				<div id="contenu">
					<div id="banniere">Ajout d'acronime pour équipement</div>

						<fieldset class="Etiquette_Equipement"><legend>Acronime d'équipement</legend>
							<!-- Formulaire d'acronime d'étiquette -->
								<form method="post" action="ajout_acronime.php">
									<div id="acro_seul">
										<!-- Ajout d'un acronime -->
										<label id="acro_seul">Ajouter un acronime d'équipement : </label><input class="Cat-Eti" type="text" name="acronime" placeholder="Ex : Refrigerateur"></p>

										<!-- Ajout de la valeur de l'acronime -->
										<label id="acro_seul">Valeur de l'acronime d'équipement : </label><input class="Cat-Eti2" type="text" name="valAcronime" placeholder="Ex : REF"></p>

										<!-- Bouton envoie acronime -->
										<input class="submitB" type="submit" value="Ajouter"><br/></p>
									</div>

									<div class="text">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
<<<<<<< HEAD
											if ($monUrl == "http://localhost/BDD/Site/ajout-acronime.php?succes_acr"){
=======
											if ($monUrl == "http://localhost/BDD/Site/ajout-acronime.php?succes"){
>>>>>>> origin/master
												echo ("Acronime ajouté avec succès !");
											}
										?>
									</div>

									<div id ="erreur">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
<<<<<<< HEAD
											if ($monUrl == "http://localhost/BDD/Site/ajout-acronime.php?erreur_acr"){
=======
											if ($monUrl == "http://localhost/BDD/Site/ajout-acronime.php?erreur"){
>>>>>>> origin/master
												echo ("Veuilliez saisir tous les champs !");
											}
										?>
									</div>
								</form>
						</fieldset>

						<table border="1">
								<th>id</th>
								<th>Categorie</th>
								<th>Valeur</th>
								<th>Supprimer</th>
								<th>Modifer</th>

									<?php foreach ($acronime as $cle=>$valeur): ?>
										<tr>
											<?php foreach ($valeur as $val): ?>
												<td><?= htmlentities($val) ?></td>
											<?php endforeach; ?>

									<!-- Bouton supprimer acronime -->
											<td><a href=ajout-acronime.php?delete=<?= htmlentities($valeur['idAcronimeEtiquette']) ?>
								onClick="return(confirm('Supprimer <?= $valeur['acronimeEtiquette']  ?> ?'));">Supprimer</a></td>

									<!-- Bouton modifier acronime -->
											<td><a href=ajout-acronime.php?update=<?= htmlentities($valeur['idAcronimeEtiquette']) ?>
								onClick="return(confirm('Modifier <?= $valeur['acronimeEtiquette']  ?> ?'));">Modifier</a></td>
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
