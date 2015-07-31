<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'ajout_doc.php', permet l'insersion d'un nouveau document.
---------------------------------------------------------------------------
L'utilisateur :
Ne peut rien faire.
---------------------------------------------------------------------------
Le développeur :
Autorisé.
---------------------------------------------------------------------------
L'administrateur :
Autorisé.
------------------------------------------------------------------------ */

    require_once('fonctions.php');

    $nom_document= $_POST['nom_document'];
    $idType_Document = $_POST['type'];
    $idProcessus = $_POST['processus'];
    $idSous_Processus = $_POST['s_processus'];
    $idEtiquette_Equipement = $_POST['idEtiquetteEquipement'];

	$plateforme = $_POST['plateforme'];
	$piece = $_POST['piece'];
	$emplacement = $_POST['emplacement'];
	$sous_emplacement = $_POST['sous_emplacement'];

	$resultats = $pdo->query("SELECT `idEquipement` FROM `etiquette_equipement` WHERE `idEtiquette_Equipement`='$idEtiquette_Equipement'");
	$resultat = $resultats->fetch(PDO::FETCH_NUM);
	$idEquipement = $resultat[0];

	$newNom = $_POST['nom'];  //Nouveau nom taper

	$nom = $_FILES['mon_fichier']['name'] ;   //Le nom original du fichier, comme sur le disque du visiteur (exemple : mon_icone.png).
	$type = $_FILES['mon_fichier']['type'] ;    //Le type du fichier. Par exemple, cela peut être « image/png ».
	$taille = $_FILES['mon_fichier']['size'] ;    //La taille du fichier en octets.
	$adresse = $_FILES['mon_fichier']['tmp_name']; //L'adresse vers le fichier uploadé dans le répertoire temporaire.
	$erreur = $_FILES['mon_fichier']['error'] ;   //Le code d'erreur, qui permet de savoir si le fichier a bien été uploadé.



	//S'il n'y a pas de document PDF lier
	if (empty($nom)) {

		$sql = "INSERT INTO `etiquette_document` (idType_Document, idProcessus, idSous_Processus, idEtiquette_Equipement) VALUES ('$idType_Document', '$idProcessus', '$idSous_Processus', '$idEtiquette_Equipement')";
        $prep = $pdo->prepare($sql);
        $prep->execute();

        $idEtiquette_Document =$pdo->lastInsertId();

        $sql2 = "INSERT INTO `document` (idEtiquette_Document, nomDocument) VALUES ('$idEtiquette_Document','$nom_document')";
        $prep2 = $pdo->prepare($sql2);
        $prep2->execute();

		$idDoc = $pdo->lastInsertId();

		$sql3 = "INSERT INTO `equipement_has_document` (idEquipement, idDocument) VALUES ('$idEquipement', '$idDoc')";
		$prep3 = $pdo->prepare($sql3);
        $prep3->execute();

		$sql4 = "INSERT INTO `lieux_document` (idPlateforme_Archive, idPiece_Document, idEmplacement_Archive, idSous_Emplacement) VALUES ('$plateforme', '$piece', '$emplacement', '$sous_emplacement')";
		$prep4 = $pdo->prepare($sql4);
        $prep4->execute();

		$idLieu = $pdo->lastInsertId();

		$sql5 = "UPDATE `document` SET `idLieux_Document` = '$idLieu' WHERE idDocument='$idDoc'";
		$prep5 = $pdo->prepare($sql5);
        $prep5->execute();

        header('Location: ajout-document.php?succes');


	}
	//S'il y a un document PDF lier
   	else if ($nom_document !="NULL" && $idType_Document!="NULL" && $idProcessus!="NULL" && $idSous_Processus!="NULL" && $nom!="NULL") {


		if (!empty($nom)) {	//Vérifie si un document à été sélectionné
			$extensions_valides = array( 'pdf', 'xps' );
			//1. strrchr renvoie l'extension avec le point (« . »).
			//2. substr(chaine,1) ignore le premier caractère de chaine.
			//3. strtolower met l'extension en minuscules.
			$extension_upload = strtolower(  substr(  strrchr($_FILES['mon_fichier']['name'], '.')  ,1)  );



			if (in_array($extension_upload, $extensions_valides)) {	//Vérifie si le type de fichier correspond a ce que le souhaite
				print "Extension correcte.<br>";

				if (empty($newNom)) {
					$newNom = $nom;
					// on souhaite récupéré l'extension
					$filename = $newNom;

					$extension = strrchr($filename,'.');
					// Comme le point ne vous intéresse pas
					// forcément on le supprime
					$extension=substr($extension, 1) ;
					$today = date("d_m_y"); //Date aujourd'hui jour/mois/annee

					//Si le champs du nouveau nom est vide, la variable récupère le nom du fichier
					$newNom = pathinfo($nom, PATHINFO_FILENAME);

					$newNom = ("$newNom-$today.$extension"); //Nouveau nom/date/extension
				}

				else {
					// on souhaite récupéré l'extension
					$filename = $nom;

					$extension = strrchr($filename,'.');
					// Comme le point ne vous intéresse pas
					// forcément on le supprime
					$extension = substr($extension, 1) ;
					$today = date("d_m_y"); //Date aujourd'hui jour/mois/annee



					$newNom = ("$newNom-$today.$extension"); //Nouveau nom/date/extension

				}


						if ($_FILES['mon_fichier']['error'] > 0) {	//Vérifie si une erreur est transmise lors du transfere
							$error = "Erreur lors du transfert<br>";
							print $error;
						}


							$lieu = '/var/www/qualite/BDD/Site/documents/'.$newNom.'';	//Envoie le fichier dans le dossier
							$resultat = move_uploaded_file($_FILES['mon_fichier']['tmp_name'], $lieu);

							if ($resultat) { //Si l'upload du fichier a fonctionner, on ajoute les donnees sur la base de donnee

								$sql = "INSERT INTO `etiquette_document` (idType_Document, idProcessus, idSous_Processus, idEtiquette_Equipement) VALUES ('$idType_Document', '$idProcessus', '$idSous_Processus', '$idEtiquette_Equipement')";
								$prep = $pdo->prepare($sql);
								$prep->execute();

								$idEtiquette_Document =$pdo->lastInsertId();

								$sql2 = "INSERT INTO `document` (idEtiquette_Document, nomDocument, nomFichier, cheminFichier) VALUES ('$idEtiquette_Document','$nom_document','$newNom', '$lieu')";
								$prep2 = $pdo->prepare($sql2);
								$prep2->execute();

								$idDoc = $pdo->lastInsertId();

								$sql3 = "INSERT INTO `equipement_has_document` (idEquipement, idDocument) VALUES ('$idEquipement', '$idDoc')";
								$prep3 = $pdo->prepare($sql3);
								$prep3->execute();

								$sql4 = "INSERT INTO `lieux_document` (idPlateforme_Archive, idPiece_Document, idEmplacement_Archive, idSous_Emplacement) VALUES ('$plateforme', '$piece', '$emplacement', '$sous_emplacement')";
								$prep4 = $pdo->prepare($sql4);
								$prep4->execute();

								$idLieu = $pdo->lastInsertId();

								$sql5 = "UPDATE `document` SET `idLieux_Document` = '$idLieu' WHERE idDocument='$idDoc'";
								$prep5 = $pdo->prepare($sql5);
								$prep5->execute();

								header('Location: ajout-document.php?succes');
							}
							else {
								header('Location: ajout-document.php?erreur_upload');
							}
			}
			else {
				header('Location: ajout-document.php?erreur_type');
			}
		}
		else {
			header('Location: ajout-document.php?erreur_fichier');
		}
	}

   	else
        header('Location: ajout-document.php?erreur');
?>
