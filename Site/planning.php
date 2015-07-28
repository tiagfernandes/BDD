<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'planning.php', formulaire de modification d'une anomalie ou d'une
calibration ou d'un entretien.
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
	$id = $_GET['id'];
	$createur = $_GET['createur'];

	if ($_GET['nom'] == "Anomalie") {
		$nom = $_GET['nom'];
	}
	else if ($_GET['nom'] == "Calibration") {
		$nom = $_GET['nom'];
	}
	else if ($_GET['nom'] == "Entretien") {
		$nom = $_GET['nom'];
	}


?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

    <head>
    	<title>Modification <?= $nom?></title>
    		<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="stylesheet" type="text/css" href="style.css">
    </head>


    <body>
		<?php require_once('entete.php'); ?>
			<?php if (($_SESSION['role'] == "Administrateur") or ($_SESSION['role'] == "Développeur")) {?><!-- Si l'utilisateur est Administrateur -->
				<div id="contenu">
					<div id="banniere">Modification <?= $nom ?> n°<?= $id ?></div>

						<?php

							if ($_SESSION['nom'] == $createur) {
							$nom2 = strtolower($nom);

							//fonction pour afficher le nom de l'équipement
							$resultats=$pdo->query("SELECT `nom$nom` as 'nom', `date$nom` as 'dateNom', `fin$nom` as 'fin', `description$nom` as 'description' FROM $nom2 ");
							$resultats->setFetchMode(PDO::FETCH_OBJ);
							while( $resultat = $resultats->fetch() ) {
								$nom = $resultat->nom;
								$dateNom = $resultat->dateNom;
								$fin = $resultat->fin;
								$description = $resultat->description;
							}
							$resultats->closeCursor();

						?>

						<fieldset class="Etiquette_Equipement"><legend>Modification <?= $nom ?></legend>

							<!-- Formulaire d'ajout de catégorie d'étiquette équipement -->
								<form method="post" action="update_planning.php?idEquipement=<?= $idEquipement ?>&nom=<?= $nom; ?>&id=<?= $id; ?>">

									<div id="Categorie_Etiquette">
										<!-- Modification de la plateforme -->
										<label id="Categorie-Etiquette">Modifier le nom : </label><input type="text" name="nom" value="<?= $nom; ?>"></p>

									<!-- Ajout de la valeur de la plateforme -->
										<label id="Categorie-Etiquette">Modifier la date : </label><input type="date" name="date" value="<?= $dateNom; ?>"></p>
										<label id="Categorie-Etiquette">Modifier la date de fin : </label><input type="date" name="dateFin" value="<?= $fin; ?>"></p>
										<label id="Categorie-Etiquette">Modifier la description : </label><input type="text" name="description" value="<?= $description; ?>"></p>

										<!-- Bouton envoie catégorie -->
										<input class="submitenvoie" type="submit" value="Modifier"><br/></p>
									</div>

								</form>
						</fieldset>

							<br>
				</div>

				<?php 		}

							else {
								$message="Vous devez le créateur pour acceder à cette page !";
									echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
								header('refresh:0.01;url=fiche-vie.php?idEquipement'.$idEquipement.'');
							}
				}
				else{
					$message="Vous devez être Administrateur pour acceder à cette page !";
						echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
					header('refresh:0.01;url=index.php');
				}
			?>
    </body>
</html>
