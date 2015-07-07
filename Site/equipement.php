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

                   <fieldset class="info_equipement"><legend>Information équipement</legend>

						<?php	//fonction pour afficher le nom de l'équipement
							$resultats=$pdo->query("SELECT nomEquipement FROM equipement WHERE idEquipement='$idEquipement'");
							$resultats->setFetchMode(PDO::FETCH_OBJ);
							while( $resultat = $resultats->fetch() )
							{
								echo 'Nom : '.$resultat->nomEquipement.'<br>';
							}
							$resultats->closeCursor();
						?>
						<br/>

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

				<span style="position:relative; top: -320px; left: 510px;">
					<?php
						if(($_SESSION['role']=='Administrateur') xor ($_SESSION['role']=='Développeur')){
					?>
						<a class="doc" href="doc-equi.php?idEquipement=<?= $idEquipement; ?>">Ajout document liés</a>
					<?php
						}
					?>
				</span>

				<span style="position:relative; top: -320px; left: 500px;">
					<a class="fiche-vie" href="fiche-vie.php?idEquipement=<?= $idEquipement; ?>">Fiche de vie</a>
				</span>

				  <!-- Création du tableau-->
					<table class="docEqui" border="0.5">
						<th>Nom Document</th>
						<th>Etiquette document</th>

						<?php $requete = "SELECT `document`.`idDocument`,`nomDocument`, `valeurTypeDoc`,`valeurProcessus`,`valeurSousProcessus`,`valeurCategorie`,`valeurAcronime`,`document`.`idDocument`
											FROM `equipement`, `equipement_has_document`, `document`, `etiquette_document`, `type_document`, `processus`, `sous_processus`, `etiquette_equipement`, `categorie_etiquette`, `acronime_etiquette`
											WHERE `equipement`.`idEquipement` = `equipement_has_document`.`idEquipement`
											AND `equipement_has_document`.`idDocument` = `document`.`idDocument`
											AND `document`.`idEtiquette_Document` = `etiquette_document`.`idEtiquette_Document`
											AND `etiquette_document`.`idType_Document` = `type_document`.`idType_Document`
											AND `etiquette_document`.`idProcessus` = `processus`.`idProcessus`
											AND `etiquette_document`.`idSous_Processus` = `sous_processus`.`idSous_Processus`
											AND `etiquette_document`.`idEtiquette_Equipement` = `etiquette_equipement`.`idEtiquette_Equipement`
											AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
											AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
											AND `equipement`.`idEquipement`=$idEquipement";

								// Exécution de la requête SQL
								$resultat = $pdo->query($requete) or die(print_r($pdo->errorInfo()));

								while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
									?>
								<tr style="cursor: pointer;" onClick="window.open('document.php?idDocument=<?= $donnees['idDocument'];?>')">
									<td><?php echo $donnees['nomDocument']; ?></td>
									<td><?php echo $donnees['valeurTypeDoc'],'-',$donnees['valeurProcessus'],'-',$donnees['valeurSousProcessus'],$donnees['valeurCategorie'],'-',$donnees['valeurAcronime'],'-',$donnees['idDocument'];?></td>
								</tr>

								<?php
								 }
								?>

					</table>


					<div class="text">
						<?php
							$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
							if ($monUrl == "http://localhost/BDD/Site/equipement.php?idEquipement=".$idEquipement."&?succes"){
								echo ("Document ajouter avec succes !");
							}
						?>
					</div>
           		</fieldset>
            </div>
    </body>
</html>
