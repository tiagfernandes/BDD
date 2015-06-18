<?php
    require_once('fonctions.php');
	$idEquipement=$_GET['idEquipement'];
	$listeDocument = getAllDocument();
?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

   <head>
    <title>Document lié</title>
    <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>


   <body>

    <?php require_once('entete.php'); ?>
       <?php if (($_SESSION['role']== "Administrateur") xor ($_SESSION['role']== "Développeur")) {?>
        <div id="contenu">
            <div id="banniere">Ajout d'un document à l'équipement n°<?= $idEquipement ?></div>
            	<fieldset class="Etiquette_Equipement"><legend>Document lié</legend>

                        <form method="post" action="ajout_doc_equi.php?idEquipement=<?= $idEquipement ?>">
							<table border="1px">
								<td>id</td>
								<td>Nom</td>
								<td>Etiquette Document</td>
								<td>Lieu d'archive</td>

									<?php foreach ($listeDocument as $cle=>$valeur): ?> <!--Affichage en tableau des documents-->
										<tr>
											<form method="get" action="document.php?idDocument">
												<?php foreach ($valeur as $val): ?>
													<?php $idDocument=$valeur['idDocument']; ?>
														<td style="cursor: pointer;" onClick="window.open('document.php?idDocument=<?= $idDocument;?>')"><?= htmlentities($val) ?></td>
												<?php endforeach; ?>
											</form>
											<!-- Checkbox choix des documents à lier -->
												<td><input type="checkbox" name="choixDoc[]" value="<?= $idDocument ?>"></td>
										</tr>
									 <?php endforeach; ?>
							</table>
                       		<input type="submit" value="envoyer">
                        </form>

                        			<div class="text">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
											if ($monUrl == "http://localhost/BDD/Site/doc-equi.php?succes"){
												echo ("Acronime ajouté avec succès !");
											}
										?>
									</div>

									<div id ="erreur">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
											if ($monUrl == "http://localhost/BDD/Site/doc-equi.php?idEquipement=".$idEquipement."&?erreur"){
												echo ("Veuilliez selectionner au mininum une valeur !");
											}
										?>
									</div>
                    </fieldset>
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
