<?php
    require_once('fonctions.php');
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
					<div id="banniere">Ajout catégorie pour équipement</div>

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
											if ($monUrl == "http://localhost/BDD/Site/admin.php?succes_acr"){
												echo ("Acronime ajouté avec succès !");
											}
										?>
									</div>

									<div id ="erreur">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
											if ($monUrl == "http://localhost/BDD/Site/admin.php?erreur_acr"){
												echo ("Veuilliez saisir tous les champs !");
											}
										?>
									</div>
								</form>
						</fieldset>

			<?php }
				else{
					$message="Vous devez être Administrateur pour acceder à cette page !";
						echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
					header('refresh:0.01;url=index.php');
				}
			?>
    </body>
</html>
