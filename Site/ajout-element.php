<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'ajout-element.php', formulaire d'insersion d'un équipement.
---------------------------------------------------------------------------
L'utilisateur :
Ne peut rien faire.
---------------------------------------------------------------------------
Le développeur :
Autorisé.
---------------------------------------------------------------------------
L'administrateur :
Autorisé.
------------------------------------------------------------------------ */

    require_once('fonctions.php');

?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

	<head>
    	<title>Ajout équipement</title>
			<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
			<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
			<link rel="stylesheet" type="text/css" href="style.css">
    </head>


	<body>
    	<?php require_once('entete.php'); ?>
       		<?php if ( ($_SESSION['role'] == "Administrateur") xor ($_SESSION['role'] == "Développeur") ){?><!-- Si l'utilisateur est Administrateur ou Développeur -->
       			<div id="contenu">
            		<div id="banniere">Ajout d'un équipement</div>
                		<div id="form-ajout">

                    		<fieldset><legend>Fiche équipement</legend>
                        		<form method="post" action="ajout.php">

                            		<label id="ajout_element">Nom équipement : *</label><input type="text" name="nom_equipement" placeholder="Nom"></p>
                      			    <label id="ajout_element">Etiquette : *</label></p>
										<!-- Liste déroulante -->
										<select name="categorie">
											<option value=NULL>-- Catégorie --</option>
												<?php
													$reponse = $pdo->query('SELECT * FROM categorie_etiquette ORDER BY categorieEtiquette LIMIT 1, 1000');
													while ( $donnees = $reponse->fetch() ) {
												?>
														<option value="<?php echo $donnees['idCategorieEtiquette']; ?>"><?php echo $donnees['valeurCategorie']; ?> - <?php echo $donnees['categorieEtiquette']; ?></option>
												<?php
													}
												?>
										</select> -


										<!-- 2eme Liste déroulante -->
										<select id="" name="acronime">
											<option value=NULL>-- Acronime --</option>
												<?php
													$reponse = $pdo->query('SELECT * FROM acronime_etiquette ORDER BY acronimeEtiquette LIMIT 1, 1000');
													while ( $donnees = $reponse->fetch() ) {
												?>
														<option value="<?php echo $donnees['idAcronimeEtiquette']; ?>"><?php echo $donnees['valeurAcronime']; ?> - <?php echo $donnees['acronimeEtiquette']; ?></option>
												<?php
													}
												?>
										</select><br/><i>Le numéro d'étiquette sera générer automatiquement.</i></p>

										<label id="ajout_element">Prix (€) : </label><input type="text" name="prix" placeholder="Prix"></p>
										<label id="ajout_element">Marque : </label><input type="text" name="marque" placeholder="Marque"></p>
										<label id="ajout_element">Date de fabrication : </label><input type="date" name="anneefb" placeholder="YYYY/MM/DD"></p>
										<label id="ajout_element">Date mise en service : </label><input type="date" name="datemes" placeholder="YYYY/MM/DD"></p>
										<label id="ajout_element">Date de réception : </label><input type="date" name="dater" placeholder="YYYY/MM/DD"></p>
										<label id="ajout_element">Fin garantie : </label><input type="date" name="garantie" placeholder="Durée garantie"></p>
										<label id="ajout_element">Lieu d'affectation : *</label>
											<select name="plateforme">
												<?php

												$reponse = $pdo->query('SELECT *
																		FROM `plateforme`
																		ORDER BY `plateforme` ASC');
												while ( $donnees = $reponse->fetch() ){
												?>
													<option value="<?php echo $donnees['idPlateforme']; ?>"><?php echo $donnees['plateforme'] ?></option>
												<?php
												}
												?>
											</option>
											</select></p>
										<label id="ajout_element">Responsable : </label><input type="text" name="responsable" placeholder="Nom responsable"></p>
										<label id="ajout_element">Variable automate : </label><input type="text" name="variableAutomate" placeholder="Variable automate"></p>
										<label id="ajout_element">Adresse automate : </label><input type="text" name="adresseAutomate" placeholder="Adresse automate"></p>
										<label id="ajout_element">id Stoc : </label><input type="text" name="idStoc" placeholder="Id Stoc"></p>
										<label id="ajout_element">Numéro de fabrication : </label><input type="text" name="nFabrication" placeholder="Numéro de fabrication"></p>
										<label id="ajout_element">Attestation d'examen : </label><input type="text" name="attestationExamen" placeholder="Attestation examen"></p>
										<label id="ajout_element">Contrat entretien : </label><input type="text" name="contratEntretien" placeholder="Contrat entretien"></p>
										<label id="ajout_element">Suppleant : </label><input type="text" name="suppleant" placeholder="Suppleant"></p>
										<label id="ajout_element">Observation : </label><input type="text" name="observation" placeholder="Observation"></p>
										<label id="ajout_element">Fournisseur : </label></p>

										<select name="fournisseur">
											<option value=NULL>-- Fournissseur --</option>
												<?php
													$reponse = $pdo->query('SELECT * FROM fournisseur ORDER BY nomFournisseur LIMIT 1, 1000');
													while ( $donnees = $reponse->fetch() ) {
												?>
														<option value="<?php echo $donnees['idFournisseur']; ?>"><?php echo $donnees['nomFournisseur']; ?></option>
												<?php
													}
												?>
										</select>

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
                    		</fieldset><br><br>
            			</div>
				</div>
			<?php }
				else{
					$message = "Vous devez être Administrateur ou Développeur pour acceder à cette page !";
					echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
					header('refresh:0.01;url=index.php');
				}
			?>
    </body>
</html>
