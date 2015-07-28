<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'equipement.php', fiche de l'équipement.
---------------------------------------------------------------------------
L'utilisateur :
Autorisé.
---------------------------------------------------------------------------
Le développeur :
Autorisé, modifié l'équipement.
---------------------------------------------------------------------------
L'administrateur :
Autorisé, modifié l'équipement.
------------------------------------------------------------------------ */

    require_once('fonctions.php');
    $idEquipement=$_GET['idEquipement'];
	$listeDocumentEquipement = getDocumentEquipement($idEquipement);

	if(isset($_GET['delete'])){ //Ajoute le document
		$idDocument = $_GET['delete'];
		deleteDocToEqui($idDocument, $idEquipement);
	}

	if(isset($_GET['qrcode'])){ //Ajoute le document
		$taille = $_GET['qrcode'];
	}
	else {
		$taille = "82x82";
	}

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

						<form class="choixQr" method="get" action="equipement.php">
						<input type="hidden" id="idEquipement" name="idEquipement" value="<?= $idEquipement ?>">
							<select name="qrcode">
								<option value="82x82">82x82</option>
								<option value="50x50">50x50</option>
								<option value="130x130">130x130</option>
									<input type="submit" value="Modifier la taille">
							</select>

						</form>

						<?php	//fonction pour afficher le nom de l'équipement
							$resultats=$pdo->query("SELECT nomEquipement FROM equipement WHERE idEquipement='$idEquipement'");
							$resultats->setFetchMode(PDO::FETCH_OBJ);
							while( $resultat = $resultats->fetch() )
							{
								echo '<b>Nom : </b>'.$resultat->nomEquipement.'<p>';
							}
							$resultats->closeCursor();
						?>
						<br/>

						<?php	//Fonction pour afficher l'etiquette de l'équipement
							$resultats=$pdo->query("SELECT `valeurCategorie`,`valeurAcronime`,`equipement`.`idEquipement` FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`
						WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
						AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
						AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
						AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette` AND `equipement`.`idEquipement`='$idEquipement'");

							$resultats->setFetchMode(PDO::FETCH_OBJ);
							while( $resultat = $resultats->fetch() )
							{
								echo '<b>Etiquette : </b>'.$resultat->valeurCategorie.'-';
								echo ''.$resultat->valeurAcronime.'-';
								echo ''.$resultat->idEquipement.'<p>';
							}
							$resultats->closeCursor();
						?><br/>

						<?php	//Fonction pour afficher la marque
							$resultats=$pdo->query("SELECT * FROM equipement WHERE idEquipement='$idEquipement'");
							$resultats->setFetchMode(PDO::FETCH_OBJ);
							while( $resultat = $resultats->fetch() )
							{
								echo "<b>Marque :</b> ".$resultat->marque."<p>";
								echo "<b>Date d'ajout : </b>".$resultat->dateAjout."<p>";
								echo "<b>Prix d'achat : </b>".$resultat->prix." €<p>";
								echo "<b>Date de fabrication : </b>".$resultat->dateFabrication."<p>";
								echo "<b>Date de réception : </b>".$resultat->dateReception."<p>";
								echo "<b>Date de mise en service :</b> ".$resultat->dateMiseService."<p>";
								echo "<b>Fin de garantie : </b>".$resultat->garantie."<p>";
								echo "<b>Responsable : </b>".$resultat->responsable."<p>";
								echo "<b>Vairable automate : </b>".$resultat->nomVariableAutomate."<p>";
								echo "<b>Adresse automate : </b>".$resultat->adresseAutomate."<p>";
								echo "<b>Id stoc : </b>".$resultat->idStoc."<p>";
								echo "<b>Numéro de Fabrication : </b>".$resultat->nFabrication."<p>";
								echo "<b>Attestation d'examen :</b> ".$resultat->attestationExamen."<p>";
								echo "<b>Contrat d'entretien : </b>".$resultat->contratEntretien."<p>";
								echo "<b>Suppleant : </b>".$resultat->suppleant."<p>";
								echo "<b>Oberservation : </b>".$resultat->observation."<p>";
							}
							$resultats->closeCursor();
						?><br>

						<?php	//Fonction pour afficher le nom du fournisseur
							$resultats=$pdo->query("SELECT `nomFournisseur` FROM `equipement`, `fournisseur` WHERE `equipement`.`idFournisseur`=`fournisseur`.`idFournisseur` AND `idEquipement`='$idEquipement'");
							$resultats->setFetchMode(PDO::FETCH_OBJ);
							while( $resultat = $resultats->fetch() )
							{
								echo '<b>Founisseur :</b> '.$resultat->nomFournisseur.'<br>';
							}
							$resultats->closeCursor();
						?><br/>



				<!-- Générateur de QR code -->
					<a class="QRCODE" href="http://chart.apis.google.com/chart?cht=qr&chs=<?= $taille ?>&chl=http://10.118.40.20/qualite/BDD/Site/equipement.php?idEquipement=<?= $idEquipement ?>">
					<img src="http://chart.apis.google.com/chart?cht=qr&chs=<?= $taille ?>&chl=http://10.118.40.20/qualite/BDD/Site/equipement.php?idEquipement=<?= $idEquipement ?>" id="QRCode" title="QR Code"></a>

					<?php
						if(($_SESSION['role']=='Administrateur') xor ($_SESSION['role']=='Développeur')){
					?>
							<a href="update_equipement.php?idEquipement=<?= $idEquipement; ?>" class="updateButton">Modifier l'équipement</a>
					<?php
				  		}
					?>

				<span style="position:relative; top: -700px; left: 320px;">
					<?php
						if(($_SESSION['role']=='Administrateur') xor ($_SESSION['role']=='Développeur')){
					?>
							<a class="doc" href="doc-equi.php?idEquipement=<?= $idEquipement; ?>">Ajout document liés</a>
					<?php
						}
					?>



					<a class="fiche-vie" href="fiche-vie.php?idEquipement=<?= $idEquipement; ?>">Fiche de vie</a><br/>
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
								<tr>
									<td style="cursor: pointer;" onClick="window.open('document.php?idDocument=<?= $donnees['idDocument'];?>')"><?php echo $donnees['nomDocument']; ?></td>
									<td style="cursor: pointer;" onClick="window.open('document.php?idDocument=<?= $donnees['idDocument'];?>')"><?php echo $donnees['valeurTypeDoc'],'-',$donnees['valeurProcessus'],'-',$donnees['valeurSousProcessus'],$donnees['valeurCategorie'],'-',$donnees['valeurAcronime'],'-',$donnees['idDocument'];?></td>
								<?php
									if($_SESSION['role']=='Administrateur'){
								?>
										<td width=20px>
											<a href="equipement.php?idEquipement=<?= $idEquipement ?>&delete=<?= htmlentities($donnees['idDocument']) ?>"><img class="poubelle" border="0" alt="Image" src='./image/poubelle1.png'
											onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $donnees['nomDocument'] ?> ?'));"/></a>							</td>
								<?php
									}
								?>
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
           		<br><br>
            </div>
    </body>
</html>
