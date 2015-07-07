<?php
    require_once('fonctions.php');

	$idEquipement = $_GET['idEquipement'];
?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

    <head>
    	<title>Ajout Calibration</title>
    		<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="stylesheet" type="text/css" href="style.css">
    </head>


    <body>
		<?php require_once('entete.php'); ?>
			<?php if (($_SESSION['role']== "Administrateur") xor ($_SESSION['role']== "Développeur")) {?><!-- Si l'utilisateur est Administrateur ou Développeur -->
				<div id="contenu">
					<div id="banniere">Ajout calibration</div>

						<fieldset class="Etiquette_Equipement"><legend>Calibration</legend>
                        		<form method="post" action="a-calibration.php?idEquipement=<?= $idEquipement?>	">

								    <label id="ajout_element">Date calibration : </label><input type="date" name="datecalibration" placeholder="YYYY/MM/DD"></p>
                                    <label id="ajout_element">Description : <textarea name="description" rows="10" cols="120"></textarea></p>
                            			<input class="bouton-ano" type="submit" value="Ajouter">
                         		</form>
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
