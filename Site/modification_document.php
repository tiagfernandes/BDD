<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'modification_document.php', modifie le document.
---------------------------------------------------------------------------
L'utilisateur :
N'est pas autorisé.
---------------------------------------------------------------------------
Le développeur :
Autorisé.
---------------------------------------------------------------------------
L'administrateur :
Autorisé.
------------------------------------------------------------------------ */

    require_once('fonctions.php');

	$idDocument = $_GET['idDocument'];

	$nomDocument = $_POST['newNom'];
	$idPlateforme = $_POST['newPlateforme'];
	$idPiece = $_POST['newPiece'];
	$idEmplacement = $_POST['newEmplacement'];
	$idSousEmplacement = $_POST['newSousEmplacement'];
	$idEtiquetteEquipement = $_POST['idEtiquetteEquipement'];

	$newNom = $_POST['newNomDoc'];

	$nom = $_FILES['mon_fichier']['name'] ;   //Le nom original du fichier, comme sur le disque du visiteur (exemple : mon_icone.png).
	$type = $_FILES['mon_fichier']['type'] ;    //Le type du fichier. Par exemple, cela peut être « image/png ».
	$taille = $_FILES['mon_fichier']['size'] ;    //La taille du fichier en octets.
	$adresse = $_FILES['mon_fichier']['tmp_name']; //L'adresse vers le fichier uploadé dans le répertoire temporaire.
	$erreur = $_FILES['mon_fichier']['error'] ;   //Le code d'erreur, qui permet de savoir si le fichier a bien été uploadé.


//Si un document à été sélectionner
	if (!empty($nom)){	//Vérifie si un document à été sélectionné
			$extensions_valides = array( 'pdf', 'xps' );
			//1. strrchr renvoie l'extension avec le point (« . »).
			//2. substr(chaine,1) ignore le premier caractère de chaine.
			//3. strtolower met l'extension en minuscules.
			$extension_upload = strtolower(  substr(  strrchr($_FILES['mon_fichier']['name'], '.')  ,1)  );

			if ( in_array($extension_upload,$extensions_valides) ) {	//Vérifie si le type de fichier correspond a ce que le souhaite

				if (empty($newNom)){ //Si le champs est vide, on garde le meme nom du fichier
					$newNom = $nom;
					// on souhaite récupéré l'extension
					$filename = $newNom;

					$extension = strrchr($filename,'.');
					// Comme le point ne vous intéresse pas
					// forcément on le supprime
					$extension=substr($extension,1) ;
					$today = date("d_m_y"); //Date aujourd'hui jour/mois/annee

					//Si le champs du nouveau nom est vide, la variable récupère le nom du fichier
					$newNom = pathinfo($nom, PATHINFO_FILENAME);

					$newNom = ("$newNom-$today.$extension"); //Encien nom/date/extension

				}
				else {
					// on souhaite récupéré l'extension
					$filename = $nom;

					$extension = strrchr($filename,'.');
					// Comme le point ne vous intéresse pas
					// forcément on le supprime
					$extension=substr($extension,1) ;
					$today = date("d_m_y"); //Date aujourd'hui jour/mois/annee

					$newNom = ("$newNom-$today.$extension"); //Nouveau nom/date/extension

						$resultats=$pdo->query("SELECT nomFichier
												FROM document
												WHERE idDocument='$idDocument'");
						$resultats->setFetchMode(PDO::FETCH_OBJ);

						while( $resultat = $resultats->fetch() )
						{
							$nomFichier1 = $resultat->nomFichier;

							$nomFichier2 = substr($nomFichier1, 0,-13);
						}

						$resultats->closeCursor();

						$newNomFichier = $nom;

							if ($nom == $nomFichier2){ //Si le nouveau nom du fichier est identique a celui qui existe
								$newNom = $nomFichier1;	//On garde le meme nom sans changer la date
							}
				}


					if ($_FILES['mon_fichier']['error'] > 0) {	//Vérifie si une erreur est transmise lors du transfere
						$error = "Erreur lors du transfert<br>";
						print $error;
					}

					else {

						$lieu = "documents/{$newNom}";	//Envoie le fichier dans le dossier
						$resultat = move_uploaded_file($_FILES['mon_fichier']['tmp_name'],$lieu);

						if ($resultat) { //Si l'upload du fichier a fonctionner, on ajoute les donnees sur la base de donnee

							$resultats=$pdo->query("SELECT idLieux_Document
							FROM document
							WHERE idDocument='$idDocument'");

							$resultats->setFetchMode(PDO::FETCH_OBJ);

							while( $resultat = $resultats->fetch() )
							{
								$idLieux_Document = $resultat->idLieux_Document;
							}
							$resultats->closeCursor();


								$sql = "UPDATE document
										SET nomDocument = :nomDocument,
										nomFichier = :nomFichier,
										cheminFichier = :cheminFichier
										WHERE idDocument = :idDocument
										";

								$stmt = $pdo->prepare($sql);

								$stmt->bindValue(':nomDocument', $nomDocument);
								$stmt->bindValue(':idDocument', $idDocument);
								$stmt->bindValue(':nomFichier', $newNom);
								$stmt->bindValue(':cheminFichier', $lieu);

								$stmt->execute();


									$sql2 = "UPDATE lieux_document
											SET lieux_document.idPlateforme_Archive = :plateforme,
											lieux_document.idPiece_Document = :piece,
											lieux_document.idEmplacement_Archive = :emplacement,
											lieux_document.idSous_Emplacement = :sousEmplacement
											WHERE idLieux_Document = :idLieux_Document ";

									$stmt = $pdo->prepare($sql2);

									$stmt->bindValue(':plateforme', $idPlateforme);
									$stmt->bindValue(':piece', $idPiece);
									$stmt->bindValue(':emplacement', $idEmplacement);
									$stmt->bindValue(':sousEmplacement', $idSousEmplacement);
									$stmt->bindValue(':idLieux_Document', $idLieux_Document);


									$stmt->execute();


										$sql3 = "UPDATE etiquette_document
												SET idEtiquette_Equipement = :idEtiquette_Equipement
												WHERE idEtiquette_Document = :idEtiquette_Document";

										$stmt = $pdo->prepare($sql3);

										$stmt->bindValue(':idEtiquette_Equipement', $idEtiquetteEquipement);
										$stmt->bindValue(':idEtiquette_Document', $idDocument);

										$stmt->execute();


							header("Location: document.php?idDocument=$idDocument");

						}
						else {
							header('Location: update_document.php?erreur_upload');
						}
					}
			}
			else {
				header('Location: update_document.php?erreur_type');
			}

	}
//Sinon
	else {//On modifie toutes les données et on laisse le nom et chemin du fichier


		$resultats=$pdo->query("SELECT idLieux_Document
								FROM document
								WHERE idDocument='$idDocument'");
		$resultats->setFetchMode(PDO::FETCH_OBJ);

		while( $resultat = $resultats->fetch() )
		{
			$idLieux_Document = $resultat->idLieux_Document;
		}
		$resultats->closeCursor();


		$sql = "UPDATE document
				SET nomDocument = :nomDocument
				WHERE idDocument = :idDocument
				";

		$stmt = $pdo->prepare($sql);

		$stmt->bindValue(':nomDocument', $nomDocument);
		$stmt->bindValue(':idDocument', $idDocument);

		$stmt->execute();


			$sql2 = "UPDATE lieux_document
					SET lieux_document.idPlateforme_Archive = :plateforme,
					lieux_document.idPiece_Document = :piece,
					lieux_document.idEmplacement_Archive = :emplacement,
					lieux_document.idSous_Emplacement = :sousEmplacement
					WHERE idLieux_Document = :idLieux_Document ";

			$stmt = $pdo->prepare($sql2);

			$stmt->bindValue(':plateforme', $idPlateforme);
			$stmt->bindValue(':piece', $idPiece);
			$stmt->bindValue(':emplacement', $idEmplacement);
			$stmt->bindValue(':sousEmplacement', $idSousEmplacement);
			$stmt->bindValue(':idLieux_Document', $idLieux_Document);

			$stmt->execute();



					$sql3 = "UPDATE etiquette_document
							SET idEtiquette_Equipement = :idEtiquette_Equipement
							WHERE idEtiquette_Document = :idEtiquette_Document";

					$stmt = $pdo->prepare($sql3);

					$stmt->bindValue(':idEtiquette_Equipement', $idEtiquetteEquipement);
					$stmt->bindValue(':idEtiquette_Document', $idDocument);

					$stmt->execute();


    	header ('location: document.php?idDocument='.$idDocument.'&update');

	}

?>
