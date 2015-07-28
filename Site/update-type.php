<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'update-type.php', formulaire de modification d'un type.
---------------------------------------------------------------------------
L'utilisateur :
N'est pas autorisé.
---------------------------------------------------------------------------
Le développeur :
N'est pas autorisé.
---------------------------------------------------------------------------
L'administrateur :
Autorisé.
------------------------------------------------------------------------ */

    require_once('fonctions.php');

	$idType = $_GET['update'];

?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

    <head>
    	<title>Modification Emplacement</title>
    		<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="stylesheet" type="text/css" href="style.css">
    </head>


    <body>
		<?php require_once('entete.php'); ?>
			<?php if ($_SESSION['role']== "Administrateur") {?><!-- Si l'utilisateur est Administrateur -->
				<div id="contenu">

					<div id="banniere">Modification type n°<?= $idType?></div>

						<?php	//fonction pour afficher le nom de l'équipement
							$resultats=$pdo->query("SELECT * FROM type_document WHERE idType_Document = '$idType'");
							$resultats->setFetchMode(PDO::FETCH_OBJ);
							while( $resultat = $resultats->fetch() )
							{
								$valeurType = $resultat->valeurTypeDoc;
								$type = $resultat->typeDocument;
							}
							$resultats->closeCursor();
						?>

						<fieldset class="Etiquette_Equipement"><legend>Emplacement d'archivage</legend>

							<!-- Formulaire d'ajout de catégorie d'étiquette équipement -->
								<form method="post" action="update_type.php?idType=<?= $idType; ?>">

									<div id="Categorie_Etiquette">
										<!-- Modification de la plateforme -->
										<label id="Categorie-Etiquette">Modifier le type : </label><input type="text" name="type" value="<?= $type; ?>"></p>

										<!-- Ajout de la valeur de la plateforme -->
										<label id="Categorie-Etiquette">Modifier la valeur du type : </label><input type="text" name="valeurType" value="<?= $valeurType; ?>"></p>

										<!-- Bouton envoie catégorie -->
										<input class="submitenvoie" type="submit" value="Modifier"><br/></p>
									</div>

								</form>
						</fieldset>

							<br>
				</div>
				<?php
				}

				else{
					$message="Vous devez être Administrateur pour acceder à cette page !";
						echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
					header('refresh:0.01;url=index.php');
				}
			?>
    </body>
</html>
