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
    	<title>Ajout archivage</title>
    		<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="stylesheet" type="text/css" href="style.css">
    </head>


    <body>
		<?php require_once('entete.php'); ?>
			<?php if ($_SESSION['role']== "Administrateur") {?>
				<div id="contenu">
					<div id="banniere">Ajout d'archivage de document</div>

						<fieldset class="Etiquette_Equipement"><legend>Archivage</legend>
							<!-- Formulaire d'acronime d'étiquette -->
								<div id="">
									<form method="post" action="ajout_archivage.php">
										<!-- Ajout d'un acronime -->
										<label id="">Ajouter une plateforme : </label><input class="" type="text" name="plateforme" placeholder="Plateforme">
										<input class="" type="submit" value="Ajouter"></p>
									</form>

									<form method="post" action="ajout_archivage.php">
										<!-- Ajout de la valeur de l'acronime -->
										<label id="">Ajouter une pièce : </label><input class="" type="text" name="piece" placeholder="Pièce">
										<input class="" type="submit" value="Ajouter"></p>
									</form>

									<form method="post" action="ajout_archivage.php">
										<label id="">Ajouter un emplacement : </label><input class="" type="text" name="emplacement" placeholder="Emplacement">
										<input class="" type="submit" value="Ajouter"></p>
									</form>

									<form method="post" action="ajout_archivage.php"
										<label id="">Ajouter un sous emplacement : </label><input class="" type="text" name="s_emplacement" placeholder="Sous emplacement">
										<input class="" type="submit" value="Ajouter"></p>
									</form>


									</div>

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
								</form>
						</fieldset>



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
