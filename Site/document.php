<?php
    require_once('fonctions.php');

    $idDocument=$_GET['idDocument'];

	$listeEquipementDocument = getEquipementDocument($idDocument);
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
                <div id="banniere">Fiche document</div>
                	<fieldset class="info_equipement"><legend>Information document</legend>

						<?php	//fonction pour afficher le nom du document
							$resultats=$pdo->query("SELECT nomDocument FROM document WHERE idDocument='$idDocument'");
							$resultats->setFetchMode(PDO::FETCH_OBJ);
							while( $resultat = $resultats->fetch() )
							{
								echo 'Nom : '.$resultat->nomDocument.'<br><br>';
							}
							$resultats->closeCursor();
						?>
						<?php	//fonction pour afficher l'etiquette du document
							$resultats=$pdo->query("SELECT `valeurTypeDoc`,`valeurProcessus`,`valeurSousProcessus`,`valeurCategorie`,`valeurAcronime`,`document`.`idDocument`
									FROM `document`, `etiquette_document`, `type_document`, `processus`, `sous_processus`, `etiquette_equipement`, `categorie_etiquette`, `acronime_etiquette`
									WHERE `document`.`idEtiquette_Document` = `etiquette_document`.`idEtiquette_Document`
									AND `etiquette_document`.`idType_Document` = `type_document`.`idType_Document`
									AND `etiquette_document`.`idProcessus` = `processus`.`idProcessus`
									AND `etiquette_document`.`idSous_Processus` = `sous_processus`.`idSous_Processus`
									AND `etiquette_document`.`idEtiquette_Equipement` = `etiquette_equipement`.`idEtiquette_Equipement`
									AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
									AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
									AND `document`.`idDocument`=$idDocument");
							$resultats->setFetchMode(PDO::FETCH_OBJ);
							while($resultat = $resultats->fetch())
							{
								echo 'Etiquette : '.$resultat->valeurTypeDoc.'';
								echo '-'.$resultat->valeurProcessus.'';
								echo '-'.$resultat->valeurSousProcessus.'';
								echo '-'.$resultat->valeurCategorie.'';
								echo '-'.$resultat->valeurAcronime.'';
								echo '-'.$resultat->idDocument.'<br><br>';
							}
							$resultats->closeCursor();
						?>
						<?php	//fonction pour afficher le lieu d'archivage
							$resultats=$pdo->query("SELECT `plateformeArchive`, `pieceDocument`, `emplacementArchive`, `sousEmplacement`
													FROM `document`, `lieux_document`,`plateforme_archive`, `piece_document`, `emplacement_archive`, `sous_emplacement`
													WHERE `document`.`idLieux_Document` = `lieux_document`.`idLieux_Document`
													AND `lieux_document`.`idPlateforme_Archive` = `plateforme_archive`.`idPlateforme_Archive`
													AND `lieux_document`.`idPiece_Document` = `piece_document`.`idPiece_Document`
													AND `lieux_document`.`idEmplacement_Archive` = `emplacement_archive`.`idEmplacement_Archive`
													AND `lieux_document`.`idSous_Emplacement` = `sous_emplacement`.`idSous_Emplacement`
													AND `idDocument`='$idDocument'");
							$resultats->setFetchMode(PDO::FETCH_OBJ);
							while( $resultat = $resultats->fetch() )
							{
								echo 'Plateforme : '.$resultat->plateformeArchive.'<br>';
								echo 'Piece : '.$resultat->pieceDocument.'<br>';
								echo 'Emplacement : '.$resultat->emplacementArchive.'<br>';
								echo 'Sous emplacement : '.$resultat->sousEmplacement.'<br>';
							}
							$resultats->closeCursor();
						?>
						<!-- Générateur de QR code -->

					<a href="http://chart.apis.google.com/chart?cht=qr&chs=100x100&chl=http://localhost/BDD/Site/document.php?idDocument=<?= $idDocument ?>"><img src="http://chart.apis.google.com/chart?cht=qr&chs=100x100&chl=http://localhost/BDD/Site/document.php?idDocument=<?= $idDocument ?>" id="QRCode2" title="QR Code"></a><br/>

						<?php	//fonction pour afficher l'etiquette du document
							$resultats=$pdo->query("SELECT `nomFichier`,`cheminFichier`
													FROM `document`
													WHERE `document`.`idDocument`='$idDocument'");
							$resultats->setFetchMode(PDO::FETCH_OBJ);
							while($resultat = $resultats->fetch())
							{
								echo 'Nom fichier : '.$resultat->nomFichier.'<br>';
								echo '<a href="'.$resultat->cheminFichier.'">Voir le PDF</a><br>';
							}
							$resultats->closeCursor();
						?>

					<span style="position:relative; top: -207px; left: 640px;">
						<?php
							if(($_SESSION['role']=='Administrateur') xor ($_SESSION['role']=='Développeur')){
						?>
							<a class="doc" href="equi-doc.php?idDocument=<?= $idDocument; ?>">Ajout d'équipement à liés</a>
						<?php
							}
						?>
					</span><br/>


					<?php
						if(($_SESSION['role']=='Administrateur') xor ($_SESSION['role']=='Développeur')){
					?>
							<a href="update_document.php?idDocument=<?= $idDocument; ?>" class="updateButton">Modifier le document</a>
					<?php
				  		}
					?>

					<table class="equiDoc" border="0.5">
						<th>Nom équipement</th>
						<th>Etiquette équipement</th>

							<?php $requete = "SELECT `equipement`.`idEquipement`,`valeurCategorie`,`valeurAcronime`,`equipement`.`idEquipement`, `nomEquipement`
											  FROM `equipement`, `categorie_etiquette`,  `etiquette_equipement`, `acronime_etiquette`, `document`, `equipement_has_document`
											  WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
											  AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
											  AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
											  AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
											  AND `equipement`.`idEquipement` = `equipement_has_document`.`idEquipement`
											  AND `equipement_has_document`.`idDocument` = `document`.`idDocument`
											  AND `document`.`idDocument`=$idDocument";

								// Exécution de la requête SQL
								$resultat = $pdo->query($requete) or die(print_r($pdo->errorInfo()));

								while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
									?>
								<tr style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $donnees['idEquipement'];?>')">
									<td><?php echo $donnees['nomEquipement']; ?></td>
									<td><?php echo $donnees['valeurCategorie'],'-',$donnees['valeurAcronime'],'-',$donnees['idEquipement'];?></td>
									<td><img src="./image/poubelle1.png" alt="Image" onmouseover="javascript:this.src='./image/poubelle2.png';" onmouseout="javascript:this.src='./image/poubelle1.png';"  href=index.php?delete=<?= htmlentities($donnees['idEquipement']) ?>
											onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $donnees['nomEquipement'] ?> ?'));"/></td>
								</tr>

								<?php
								 }
								?>

					</table>
			</fieldset>
    	</div>
    </body>
</html>
