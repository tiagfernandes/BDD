<?php
    require_once('fonctions.php');

	$idEquipement = $_GET['idEquipement'];
?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

    <head>
    	<title>Ajout Anomalie</title>
    		<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="stylesheet" type="text/css" href="style.css">
    </head>


    <body>	<!-- Formulaire d'ajout d'aomalie-->
		<?php require_once('entete.php'); ?>
			<?php if (($_SESSION['role']== "Administrateur") xor ($_SESSION['role']== "Développeur")){?> <!-- Si l'utilisateur est Administrateur ou Développeur -->
				<div id="contenu">
					<div id="banniere">Ajout anomalie</div>

						<fieldset class="Etiquette_Equipement"><legend>Anomalie</legend>
                        		<form method="post" action="a-anomalie.php?idEquipement=<?= $idEquipement?>">

								    <label id="ajout_element">Date début anomalie : </label><input type="date" name="datedano" placeholder="YYYY/MM/DD"></p>
								    <label id="ajout_element">Date fin anomalie : </label><input type="date" name="datefano" placeholder="YYYY/MM/DD"></p>
                                    <label id="ajout_element">Description : <textarea name="description" rows="10" cols="120"></textarea></p>

                            		<input class="bouton-ano" type="submit" value="Ajouter">
                         		</form>

								<div id ="erreur">
									<?php
									$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
									if ($monUrl == "http://localhost/BDD/Site/ajout-anomalie.php?idEquipement='.$idEquipement.'&?anomalie=erreur"){
										print ("Erreur lors de l'ajout de l'anomalie ");
									}
									?>
								</div>
						</fieldset>


			<?php }
				else{
					$message="Vous devez être Administrateur ou Développeur pour acceder à cette page !";
						echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
					header('refresh:0.01;url=index.php');
				}
			?>
    </body>
</html>
