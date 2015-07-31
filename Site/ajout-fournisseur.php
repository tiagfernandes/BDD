<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'ajout-fournisseur.php', formulaire d'insersion d'un nouveau
fournisseur.
---------------------------------------------------------------------------
L'utilisateur :
Ne peut rien faire.
---------------------------------------------------------------------------
Le développeur :
Ne peut rien faire.
---------------------------------------------------------------------------
L'administrateur :
Autorisé.
------------------------------------------------------------------------ */

    require_once('fonctions.php');

	$listeFournisseur = getAllFournisseur();

	if(isset($_GET['delete'])){ //Supprime fournisseur
        $idFournisseur = $_GET['delete'];
        deleteFournisseur($idFournisseur);
    }
?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

	<head>
    	<title>Ajout fournisseur</title>
			<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
			<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
			<link rel="stylesheet" type="text/css" href="style.css">
    </head>


	<body>
    	<?php require_once('entete.php'); ?>

       		<?php if ($_SESSION['role'] == "Administrateur") { ?><!-- Si l'utilisateur est Administrateur -->

       			<div id="contenu">

            		<div id="banniere">Ajout d'un fournisseur</div>

                		<div id="form-ajout">

                    		<fieldset><legend>Fournisseur</legend>

                        		<form method="post" action="ajout_fournisseur.php">

                            		<label id="ajout_element">Nom fournisseur : *</label><input type="text" name="nomFournisseur" placeholder="Nom"></p>
                      			    <label id="ajout_element">Adresse : </label><input type="text" name="adresse" placeholder="Adresse"></p>


									<label id="ajout_element">Code Postal : </label><input type="int" name="codePostal" placeholder="Code postal"></p>
									<label id="ajout_element">Ville </label><input type="text" name="ville" placeholder="Ville"></p>
									<label id="ajout_element">Pays : </label><input type="text" name="pays" placeholder="Pays"></p>
									<label id="ajout_element">Téléphone : </label><input type="int" name="tel" placeholder="Téléphone"></p>
									<label id="ajout_element">E-mail : </label><input type="text" name="email" placeholder="E-mail"></p>

										<div id ="succes">
											<?php
												$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
													if ($monUrl == "http://localhost/BDD/Site/ajout-element.php?succes") {
														echo ("Elément ajouté avec succès");
													}
											?>
										</div>

                            			<div id ="erreur">
                            				<?php
												$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
													if ($monUrl == "http://localhost/BDD/Site/ajout-element.php?erreur") {
														echo ("Veuilliez saisir tous les champs ");
													}
											?>
                           				</div></p>

                            			<input class="bouton" type="submit" value="Ajouter">
                         		</form>

                    		</fieldset><br>


							<table class="tabCatAcr" border="0.5">

								<th>id</th>
								<th>Fournisseur</th>
								<th>Adresse</th>
								<th>Code postal</th>
								<th>Ville</th>
								<th>Pays</th>
								<th>Téléphone</th>
								<th>E-mail</th>

									<?php foreach ($listeFournisseur as $cle=>$valeur): ?>
										<tr>
											<?php foreach ($valeur as $val): ?>
												<td><?= htmlentities($val) ?></td>
											<?php endforeach; ?>

									<!-- Bouton modifier fournisseur -->
											<td width=20px>
												<a href="update-fournisseur.php?idFournisseur=<?= htmlentities($valeur['idFournisseur']) ?>"><img class="modifier" border="0" alt="Image" src='./image/modifier.png'
												onClick="return(confirm('Modifier <?= $valeur['nomFournisseur']  ?> ?'));"/></a>
											</td>

									<!-- Bouton supprimer fournisseur -->
											<td width=20px>
												<a href="ajout-fournisseur.php?delete=<?= htmlentities($valeur['idFournisseur']) ?>"><img class="poubelle" border="0" alt="Image" src='./image/poubelle1.png'
												onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $valeur['nomFournisseur'] ?> ?'));"/></a>
											</td>
										</tr>
									<?php endforeach; ?>

							</table>
          					<p>Si vous supprimez un fournisseur, actualisez la page pour voir que le fournisseur à bien été supprimer.</p><br>

            			</div>

				</div>
			<?php }
				else {
					$message = "Vous devez être Administrateur ou Développeur pour acceder à cette page !";
						echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
					header('refresh:0.01;url=index.php');
				}
			?>
    </body>
</html>
