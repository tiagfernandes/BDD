<?php
    require_once('fonctions.php');
    $idEquipement=$_GET['idEquipement'];
	$listeDocumentEquipement = getDocumentEquipement($idEquipement);
?>
<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

  	<head>
		<title>Fiche Equipement</title>
			<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
			<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
			<link rel="stylesheet" type="text/css" href="style.css">

				<script language="Javascript">
					function imprimer(){window.print();}
				</script>
    </head>


    <body>
        <?php require_once('entete.php'); ?>
            <div id ="contenu">
                <div id="banniere">Fiche équipement</div>
                    <?php	//fonction pour afficher le nom de l'équipement
                        $resultats=$pdo->query("SELECT nomEquipement FROM equipement WHERE idEquipement='$idEquipement'");
                        $resultats->setFetchMode(PDO::FETCH_OBJ);
                        while( $resultat = $resultats->fetch() )
                        {
                            echo 'Nom : '.$resultat->nomEquipement.'<br>';
                        }
                        $resultats->closeCursor();
                    ?><br/>

                    <?php	//Fonction pour afficher la marque
                        $resultats=$pdo->query("SELECT marque FROM equipement WHERE idEquipement='$idEquipement'");
                        $resultats->setFetchMode(PDO::FETCH_OBJ);
                        while( $resultat = $resultats->fetch() )
                        {
                            echo 'Marque : '.$resultat->marque.'<br>';
                        }
                        $resultats->closeCursor();
                    ?><br/>

                    <?php	//Fonciton pour afficher la date d'ajout
                        $resultats=$pdo->query("SELECT dateAjout FROM equipement WHERE idEquipement='$idEquipement'");
                        $resultats->setFetchMode(PDO::FETCH_OBJ);
                        while( $resultat = $resultats->fetch() )
                        {
                            echo "Date d'ajout : ".$resultat->dateAjout."<br>";
                        }
                        $resultats->closeCursor();
                    ?><br/>

                    <?php	//Fonction pour afficher le prix
                        $resultats=$pdo->query("SELECT prix FROM equipement WHERE idEquipement='$idEquipement'");
                        $resultats->setFetchMode(PDO::FETCH_OBJ);
                        while( $resultat = $resultats->fetch() )
                        {
                            echo ("Prix d'achat : $resultat->prix €<br>");
                        }
                        $resultats->closeCursor();
                    ?><br/>

                    <?php	//Fonction pour afficher la date de fabrication
                        $resultats=$pdo->query("SELECT dateFabrication FROM equipement WHERE idEquipement='$idEquipement'");
                        $resultats->setFetchMode(PDO::FETCH_OBJ);
                        while( $resultat = $resultats->fetch() )
                        {
                            echo 'Date de fabrication : '.$resultat->dateFabrication.'<br>';
                        }
                        $resultats->closeCursor();
                    ?><br/>

                    <?php	//Fonction pour afficher la date de reception
                        $resultats=$pdo->query("SELECT dateReception FROM equipement WHERE idEquipement='$idEquipement'");
                        $resultats->setFetchMode(PDO::FETCH_OBJ);
                        while( $resultat = $resultats->fetch() )
                        {
                            echo 'Date de réception : '.$resultat->dateReception.'<br>';
                        }
                        $resultats->closeCursor();
                    ?><br/>

                    <?php	//Fonction pour afficher la date de mise en service
                        $resultats=$pdo->query("SELECT dateMiseService FROM equipement WHERE idEquipement='$idEquipement'");
                        $resultats->setFetchMode(PDO::FETCH_OBJ);
                        while( $resultat = $resultats->fetch() )
                        {
                            echo 'Date de mise en service : '.$resultat->dateMiseService.'<br>';
                        }
                        $resultats->closeCursor();
                    ?><br/>

                    <?php	//Fonction pour afficher la garantie
                        $resultats=$pdo->query("SELECT garantie FROM equipement WHERE idEquipement='$idEquipement'");
                        $resultats->setFetchMode(PDO::FETCH_OBJ);
                        while( $resultat = $resultats->fetch() )
                        {
                            echo 'Fin de garantie : '.$resultat->garantie.'<br>';
                        }
                        $resultats->closeCursor();
                    ?>

                    <?php	//Fonction pour afficher le nom du fournisseur
                        $resultats=$pdo->query("SELECT `nomFournisseur` FROM `equipement`, `fournisseur` WHERE `equipement`.`idFournisseur`=`fournisseur`.`idFournisseur` AND `idEquipement`='$idEquipement'");
                        $resultats->setFetchMode(PDO::FETCH_OBJ);
                        while( $resultat = $resultats->fetch() )
                        {
                            echo 'Founisseur : '.$resultat->nomFournisseur.'<br>';
                        }
                        $resultats->closeCursor();
                    ?><br/>

                    <?php	//Fonction pour afficher l'etiquette de l'équipement
                        $resultats=$pdo->query("SELECT `valeurCategorie`,`valeurAcronime`,`equipement`.`idEquipement` FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`
                    WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
                    AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
                    AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
                    AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette` AND `equipement`.`idEquipement`='$idEquipement'");

                        $resultats->setFetchMode(PDO::FETCH_OBJ);
                        while( $resultat = $resultats->fetch() )
                        {
                            echo 'Etiquette : '.$resultat->valeurCategorie.'-';
							echo ''.$resultat->valeurAcronime.'-';
							echo ''.$resultat->idEquipement.'<br/>';
                        }
                        $resultats->closeCursor();
                    ?><br/>

			<!-- Générateur de QR code -->
				<a class="QRCODE" href="http://chart.apis.google.com/chart?cht=qr&chs=100x100&chl=http://10.118.40.20/qualite/BDD/Site/equipement.php?idEquipement=<?= $idEquipement ?>">
           		<img src="http://chart.apis.google.com/chart?cht=qr&chs=100x100&chl=http://10.118.40.20/qualite/BDD/Site/equipement.php?idEquipement=<?= $idEquipement ?>" id="QRCode" title="QR Code"></a>

            <a class="doc" href="doc-equi.php?idEquipement=<?= $idEquipement; ?>">Ajout document liés</a>
            <a class="fiche-vie" href="fiche-vie.php?idEquipement=<?= $idEquipement; ?>">Fiche de vie</a>
			  <!-- Création du tableau-->
				<table border=2>
					<th>Id</th>
					<th>Nom Document</th>
					<th>Etiquette document</th>

						<?php foreach ($listeDocumentEquipement as $cle=>$valeur): ?> <!--Affichage en tableau des documents -->
							<tr>
								<?php foreach ($valeur as $val): ?>
									<?php $idDocument=$valeur['idDocument']; ?>
										<td style="cursor: pointer;" onClick="window.open('document.php?idDocument=<?= $idDocument;?>')"><?= htmlentities($val) ?></td>
								<?php endforeach; ?>

							</tr>
						<?php endforeach; ?>
				</table>

                <div class="text">
					<?php
						$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
						if ($monUrl == "http://localhost/BDD/Site/equipement.php?idEquipement=".$idEquipement."&?succes"){
							echo ("Document ajouter avec succes !");
						}
					?>
				</div>
            </div>
    </body>
</html>
