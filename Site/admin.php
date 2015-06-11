<?php
    require_once('fonctions.php');

    if(isset($_GET['delete'])){ //Supprime utilisateur
        $id = $_GET['delete'];
        deleteUtilisateur($id);
    }
    $listeUtilisateur = getAllUtilisateur($pdo);
?>

<!doctype html>
<html lang="fr">

    <head>
    <title>Administration</title>
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

				<!-- Affichage des utilisateur -->
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
            <!-- Bouton pour ajouter un utilisateur -->
            <input onclick="window.location='add_user.php';"  class="button1" type="submit" value="Ajouter un utilisateur"></p>


			<!-- Formulaire d'ajout de catégorie d'étiquette équipement -->
				<fieldset class="Etiquette_Equipement"><legend>Etiquette équipement</legend>
					<form method="post" action="ajout_categorie.php">
					  <div id="Cat_Etiquette">
						<!-- Ajout d'une catégorie -->
						<label id="Cat-Etiquette">Ajouter une catégorie d'équipement : </label><input class="Cat-Eti" type="text" name="categorie" placeholder="Ex : Sensor"></p>
						<!-- Ajout de la valeur de la catégorie -->
						<label id="Cat-Etiquette">Valeur de la catégorie d'équipement : </label><input class="Cat-Eti2" type="text" name="valCategorie" placeholder="Ex : SE"></p>
						<!-- Bouton envoie catégorie -->
						<input class="submitA" type="submit" value="Envoyer"><br/></p>
					  </div>
					  <div class="text">
					  		<?php
                                $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                                if ($monUrl == "http://localhost/BDD/Site/admin.php?succes_cat"){
                                    echo ("Catégorie ajouté avec succès !");
                                }
                                ?>
                            </div>
                            <div id ="erreur">
                               <?php
                                $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                                if ($monUrl == "http://localhost/BDD/Site/admin.php?erreur_cat"){
                                    echo ("Veuilliez saisir tous les champs !");
                                }
                         	?>
     				  </div>
				</form>


			 <!-- Formulaire d'acronime d'étiquette -->
				  <form method="post" action="ajout_acronime.php">
					  <div id="acro_seul"><hr class="trait"><br/> <!-- Trait d'élimitant -->
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
        	</div>

        <?php }
            else{	//Condition si l'utilisateur n'est pas Administrateur
                $message="Vous devez être Administrateur pour acceder à cette page !";
                echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
                header('refresh:0.01;url=index.php');
            }
        ?>
    </body>
</html>
