<?php
    require_once('fonctions.php');
	$idDocument=$_GET['idDocument'];
	$listeEquipement = getEquipementToDoc();
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
       <?php if ($_SESSION['role']== "Administrateur") {?>
        <div id="contenu">
            <div id="banniere">Ajout d'un équipement au document n°<?= $idDocument ?></div>
            	<fieldset class="Etiquette_Equipement"><legend>Document lié</legend>

                        <form method="post" action="ajout_equi_doc.php?idDocument=<?= $idDocument ?>">

							<table border="1px">

								<td>id</td>
								<td>Nom</td>
								<td>Etiquette Document</td>


									<?php foreach ($listeEquipement as $cle=>$valeur): ?> <!--Affichage en tableau des documents-->
										<tr>
											<form method="get" action="equipement.php?idEquipement">
												<?php foreach ($valeur as $val): ?>
													<?php $idEquipement = $valeur['idEquipement']; ?>
														<td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $idEquipement;?>')"><?= htmlentities($val) ?></td>
												<?php endforeach; ?>
											</form>
												<!-- Checkbox choix des équipements à liés -->
													<td><input type="checkbox" name="choixEqui[]" value="<?= $idEquipement ?>"></td>
										</tr>
									<?php endforeach; ?>

							</table>

                            <input type="submit" value="envoyer">

                        </form>

                        			<div class="text">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
											if ($monUrl == "http://localhost/BDD/Site/equi-doc.php?idDocument=".$idDocument."&?succes"){
												echo ("Acronime ajouté avec succès !");
											}
										?>
									</div>

									<div id ="erreur">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
											if ($monUrl == "http://localhost/BDD/Site/doc-equi.php?idDocument=".$idDocument."&?erreur"){
												echo ("Veuilliez selectionner au mininum une valeur !");
											}
										?>
									</div>

                    </fieldset><br/>

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
