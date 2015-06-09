<?php
    require_once('fonctions.php');
    session_start ();

    if(isset($_GET['delete'])){ //Supprime utilisateur
        $id = $_GET['delete'];
        deleteUtilisateur($id);
    }
    $listeUtilisateur = getAllUtilisateur($pdo);
?>

<!doctype html>
<html lang="fr">

    <head>
    <title>Page Admin</title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
        <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <?php require_once('entete.php'); ?>
        <?php if ($_SESSION['role']== "Administrateur") {?>
            <div id="contenu">
                <div id="banniere">Administration</div>


                <div id ="user"><table border=2>
                    <th>id</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Identifiant</th>
                    <th>Mot de passe</th>
                    <th>Rôle</th>
                    <th>Supprimer</th>

                    <?php foreach ($listeUtilisateur as $cle=>$valeur): ?> <!--Affichage des utilisateur-->
                        <tr>
                            <?php foreach ($valeur as $val): ?>
                                <td><?= htmlentities($val) ?></td>
                            <?php endforeach; ?>

                            <td><a href=admin.php?delete=<?= htmlentities($valeur['idUtilisateur']) ?>
                                onClick="return(confirm('Supprimer <?= $valeur['prenomUtilisateur']  ?> ?'));">Supprimer</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                </div>
            <input onclick="window.location='add_user.php';"  class="button1" type="submit" value="Ajouter un utilisateur"></p>


			<!-- Ajout de catégorie d'étiquette équipement -->
				<form method="post" action="ajout_etiquette.php">
					<fieldset class="Etiquette_Equipement"><legend>Etiquette équipement</legend>
					  <div id="Cat_Etiquette">

						<label id="Cat-Etiquette">Ajouter une catégorie d'équipement : </label><input class="Cat-Eti" type="text" name="categorie" placeholder="Ex : Sensor"></p>

						<label id="Cat-Etiquette">Valeur de la catégorie d'équipement : </label><input class="Cat-Eti2" type="text" name="valCategorie" placeholder="Ex : SE"></p>

						<input class="submitA" type="submit" value="Envoyer"><br/></p>
					  </div>
					  <div class="text">
						  <?php
								$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
								if ($monUrl == "http://localhost/BDD/Site/admin.php?succes"){
									echo ("Catégorie enregistré !");
								}

								else if ($monUrl == "http://localhost/BDD/Site/admin.php?erreur"){
									echo ("Entrez tout les champs !");
								}
							?>
     				  </div>
				</form>

			  <!-- Ajout d'acronime d'étiquette -->
				  <form method="post" action="ajout_etiquette.php">
					  <div id="acro_seul"><hr class="trait"><br/>
						<label id="acro_seul">Ajouter un acronime à une catégorie existante : </label>
							<select class="categorie" name="categorie">
								<option value=NULL>-- Catégorie --</option>
								<?php

								$reponse = $pdo->query('SELECT * FROM categorie_etiquette');
								while ($donnees = $reponse->fetch()){
								?>
									<option value="<?php echo $donnees['idCategorieEtiquette']; ?>"><?php echo $donnees['valeurCategorie']; ?> - <?php echo $donnees['categorieEtiquette']; ?></option>
								<?php
								}
								?>
							</select> -
							<input type="text" name="acronime_cat" placeholder="Ex : Refrigerateur">
							<input type="text" name="val_acr_cat" placeholder="Ex : REF"></p>
							<input class="submit" type="submit" value="Ajouter">
					  </div>
					</fieldset>
				</form>
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
