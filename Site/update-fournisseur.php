<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'update-fournisseur.php', formulaire de modification d'un fournisseur.
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

	$idFournisseur = $_GET['idFournisseur'];

?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

    <head>
    	<title>Modification fournisseur</title>
    		<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="stylesheet" type="text/css" href="style.css">
    </head>


    <body>
		<?php require_once('entete.php'); ?>

			<?php if ($_SESSION['role'] == "Administrateur") { ?><!-- Si l'utilisateur est Administrateur -->

				<div id="contenu">

					<div id="banniere">Modification catégorie n°<?= $idFournisseur; ?></div>

						<?php	//fonction pour afficher le nom de l'équipement
							$resultats=$pdo->query("SELECT * FROM fournisseur WHERE idFournisseur = '$idFournisseur'");
							$resultats->setFetchMode(PDO::FETCH_OBJ);

							while ($resultat = $resultats->fetch()) {
								$nom = $resultat->nomFournisseur;
								$pays = $resultat->pays;
								$cp = $resultat->cp;
								$ville = $resultat->ville;
								$adresse = $resultat->adresse;
								$tel = $resultat->telephone;
								$email = $resultat->email;
							}

							$resultats->closeCursor();
						?>

						<fieldset class="Etiquette_Equipement"><legend>Fournisseur</legend>

							<!-- Formulaire d'ajout de catégorie d'étiquette équipement -->
								<form method="post" action="update_fournisseur.php?idFournisseur=<?= $idFournisseur; ?>">

									<div id="Categorie_Etiquette">
										<!-- Ajout d'une catégorie -->
										<label id="Categorie-Etiquette">Modifier le nom du fournisseur : </label><input type="text" name="nomFournisseur" value="<?= $nom; ?>"></p>

										<!-- Ajout de la valeur de la catégorie -->
										<label id="Categorie-Etiquette">Modifier l'adresse : </label><input type="text" name="adresse" value="<?= $adresse; ?>"></p>
										<label id="Categorie-Etiquette">Modifier le code postal : </label><input type="int" name="cp" value="<?= $cp; ?>"></p>
										<label id="Categorie-Etiquette">Modifier le nom de ville : </label><input type="text" name="ville" value="<?= $ville; ?>"></p>
										<label id="Categorie-Etiquette">Modifier le pays : </label><input type="text" name="pays" value="<?= $pays; ?>"></p>
										<label id="Categorie-Etiquette">Modifier le numéro de téléphone : </label><input type="text" name="tel" value="<?= $tel; ?>"></p>
										<label id="Categorie-Etiquette">Modifier l'adresse mail : </label><input type="text" name="email" value="<?= $email; ?>"></p>

										<!-- Bouton envoie catégorie -->
										<input class="submitenvoie" type="submit" value="Modifier"><br/></p>
									</div>

									<div class="text">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
											if ($monUrl == "http://localhost/BDD/Site/update-categorie.php?succes"){
						                          echo ("Catégorie ajouté avec succès !");
											}
										?>
									</div>

									<div id ="erreur">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
											if ($monUrl == "http://localhost/BDD/Site/update-categorie.php?erreur"){
												echo ("Veuilliez saisir tous les champs !");
											}
										?>
									</div>

								</form>

						</fieldset><br>

				</div>

			<?php }
				else {
					$message = "Vous devez être Administrateur pour acceder à cette page !";
						echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
					header('refresh:0.01;url=index.php');
				}
			?>
    </body>
</html>
