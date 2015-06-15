<?php
    require_once('fonctions.php');

	$Equipement = getEquipementDoc($pdo);
?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

   <head>
    <title>Ajout document</title>
    <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>


   <body>

    <?php require_once('entete.php'); ?>
       <?php if ($_SESSION['role']== "Administrateur") {?>
        <div id="contenu">
            <div id="banniere">Ajout d'un document</div>
                <div id="form-ajout">
                    <fieldset><legend>Fiche document</legend>

                        <form method="post" action="ajout_doc.php">
                            <label id="ajout_element">Nom document : *</label><input type="text" name="nom_document" placeholder="Nom"></p>
                        	<label id="ajout_element">Etiquette document : *</label></p>
                               <!-- 1ere listview -->
                            	<select name="type">
                                    <option value=NULL>-- Type --</option>
                                    <?php

                                    $reponse = $pdo->query('SELECT * FROM type_document');
                                    while ($donnees = $reponse->fetch()){
                                    ?>
                                        <option value="<?php echo $donnees['idType_Document']; ?>"><?php echo $donnees['valeurTypeDoc']; ?> - <?php echo $donnees['typeDocument']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select> -

                                <select name="processus">
                                    <option value=NULL>-- Processus --</option>
                                        <?php

                                        $reponse = $pdo->query('SELECT * FROM processus');
                                        while ($donnees = $reponse->fetch()){
                                        ?>
                                            <option value="<?php echo $donnees['idProcessus']; ?>"><?php echo $donnees['valeurProcessus']; ?> - <?php echo $donnees['Processus']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </option>
                                </select> -

                                <select name="s_processus">
                                    <option value=NULL>-- Sous-Processus --</option>
                                        <?php

                                        $reponse = $pdo->query('SELECT * FROM sous_processus');
                                        while ($donnees = $reponse->fetch()){
                                        ?>
                                            <option value="<?php echo $donnees['idSous_Processus']; ?>"><?php echo $donnees['valeurSousProcessus']; ?> - <?php echo $donnees['sousProcessus']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </option>
								</select></p>

							<label id="ajout_element">Etiquette équipement lier au document :*</label>
                               	<select name="categorie">
                                    <option value=NULL>-- Etiquette équipement --</option>
                                        <?php

                                        $reponse = $pdo->query('SELECT *
																FROM `categorie_etiquette`, `acronime_etiquette`, `etiquette_equipement`
																WHERE `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
																AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
																ORDER BY `valeurCategorie` ASC');
                                        while ($donnees = $reponse->fetch()){
                                        ?>
                                            <option value="<?php echo $donnees['idCategorieEtiquette']; ?>"><?php echo $donnees['valeurCategorie']; ?> - <?php echo $donnees['valeurAcronime']?> - <?php echo $donnees['idEquipement']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </option>
	   							</select><img src="image/point-interrogation.png" width="17" height="17" title="Sélectionner l'étiquette de l'équipement correspondant au document.">
                           	<br/>


                       		<input class="bouton" type="submit" value="Ajouter">
                        </form>
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
