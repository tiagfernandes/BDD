<?php
require_once('connexion.php');
session_start ();
header('Content-Type: text/html; charset=UTF-8');

/*
------------------------------------------------------------------------
Fonction : getAuthentification
---------------------------------------------------------------------------
Description :
Permet de ce connecter avec son identifiant et mdp.
---------------------------------------------------------------------------
Arguments :
$login : Identifiant.
$pass : Mot de passe.
---------------------------------------------------------------------------
Retour : True si utilisateur et mot de passe correct, sinon False
------------------------------------------------------------------------ */
function getAuthentification($login, $pass) {
	global $pdo;
	$query = "SELECT * FROM utilisateur WHERE login=:login and password=:pass";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':login', $login);
        $prep->bindValue(':pass', $pass);
        $prep->execute();

        if($prep->rowCount() == 1){
            $result = $prep->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        else{
            return false;
        }
}


/*
------------------------------------------------------------------------
Fonction : getAllEquipement
---------------------------------------------------------------------------
Description :
Permet de sélectionner tout les équipements de la base, par ordre decroisant
id.
---------------------------------------------------------------------------
Arguments : Aucun.
---------------------------------------------------------------------------
Retour : idEquipement, l'étiquette, nom, marque, plateforme, responsable.
------------------------------------------------------------------------ */
function getAllEquipement() {
    global $pdo;
    $query = "SELECT `equipement`.`idEquipement`, CONCAT(`valeurCategorie`,'-',`valeurAcronime`,'-',`equipement`.`idEquipement`), `nomEquipement`,`marque`,`plateforme`, `responsable`
              FROM `equipement`, `categorie_etiquette`,  `etiquette_equipement`, `acronime_etiquette`, `plateforme`
              WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
              AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
              AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
              AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
              AND `equipement`.`idPlateforme` = `plateforme`.`idPlateforme`
              GROUP BY `idEquipement` DESC";

    try {
      $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }
    catch ( Exception $e ) {
      die ("Erreur dans la requete ".$e->getMessage());
    }

}


/*
------------------------------------------------------------------------
Fonction : getAllUtilisateur
---------------------------------------------------------------------------
Description :
Permet de sélectionner tout les utilisateurs.
---------------------------------------------------------------------------
Arguments : Aucun.
---------------------------------------------------------------------------
Retour : idUtilisateur, nomUtilisateur, prenomUtilisateur, email, login,
role.
------------------------------------------------------------------------ */
function getAllUtilisateur() {
    global $pdo;
    $query = 'SELECT `idUtilisateur`,`nomUtilisateur`,`prenomUtilisateur`,`email`,`login`,`role` FROM utilisateur';

    try {
      $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }
    catch ( Exception $e ) {
      die ("Erreur dans la requete ".$e->getMessage());
    }
}


/*
------------------------------------------------------------------------
Fonction : deleteUtilisateur
---------------------------------------------------------------------------
Description :
Permet de supprimer un utilisateur choisis.
---------------------------------------------------------------------------
Arguments :
$id : id de l'utilisateur.
---------------------------------------------------------------------------
Retour : Aucun.
------------------------------------------------------------------------ */
function deleteUtilisateur($id) {
      global $pdo;
      $query = "delete from utilisateur where idUtilisateur = :idUtilisateur ;";
      try {
		$prep = $pdo->prepare($query);
		$prep->bindValue(':idUtilisateur', $id);
		$prep->execute();
      }
      catch ( Exception $e ) {
		die ("erreur dans la requete ".$e->getMessage());
      }
}


/*
------------------------------------------------------------------------
Fonction : getEtiquetteEquipement
---------------------------------------------------------------------------
Description :
Permet de sélectionner l'étiquette de l'équipement.
---------------------------------------------------------------------------
Arguments : Aucun.
---------------------------------------------------------------------------
Retour : Aucun.
------------------------------------------------------------------------ */
function getEtiquetteEquipement() {
    global $pdo;

        $query = "  SELECT CONCAT(`valeurCategorie`,'-',`valeurAcronime`,'-',`equipement`.`idEquipement`)
                    FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`
                    WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
                    AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
                    AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
                    AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
                    ;";

        try {
            $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        catch ( Exception $e ) {
            die ("erreur dans la requete ".$e->getMessage());
        }
}


/*
------------------------------------------------------------------------
Fonction : getEquipement
---------------------------------------------------------------------------
Description :
Permet de sélectionner tout sur l'équipement choisis.
---------------------------------------------------------------------------
Arguments :
$idEquipement : id de l'équipement choisis.
---------------------------------------------------------------------------
Retour : Tout.
------------------------------------------------------------------------ */
function getEquipement($idEquipement) {
    global $pdo;
        $query = "SELECT * FROM equipement WHERE idEquipement=$idEquipement";

        try {
          $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
          return($result);
        }
        catch ( Exception $e ) {
          die ("Erreur dans la requete ".$e->getMessage());
        }
}


/*
------------------------------------------------------------------------
Fonction : getNomEquipement
---------------------------------------------------------------------------
Description :
Permet de sélectionner le nom de l'équipement.
---------------------------------------------------------------------------
Arguments :
$idEquipement : id de l'équipement choisis.
---------------------------------------------------------------------------
Retour : Nom équipement.
------------------------------------------------------------------------ */
function getNomEquipement($idEquipement) {
    global $pdo;
        $query = "SELECT nomEquipement FROM equipement WHERE idEquipement=$idEquipement";

        try {
          $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
          return($result);
        }
        catch ( Exception $e ) {
          die ("Erreur dans la requete ".$e->getMessage());
        }
}


/*
------------------------------------------------------------------------
Fonction : getEquipementDoc
---------------------------------------------------------------------------
Description :
Permet de sélectionner tout sur l'équipement lier a chque documents.
---------------------------------------------------------------------------
Arguments :
$idEquipement : id de l'équipement choisis.
---------------------------------------------------------------------------
Retour : Tout.
------------------------------------------------------------------------ */
function getEquipementDoc() {
	global $pdo;
        $query = "SELECT CONCAT(`valeurCategorie`,'-',`valeurAcronime`,'-',`equipement`.`idEquipement`), nomEquipement
				  FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`
                  WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
                  AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
                  AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`";

        try {
          $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
          return($result);
        }
        catch ( Exception $e ) {
          die ("Erreur dans la requete ".$e->getMessage());
        }
}


/*
------------------------------------------------------------------------
Fonction : getDocumentEquipement
---------------------------------------------------------------------------
Description :
Permet de sélectionner tout les documents lier à l'équipement.
---------------------------------------------------------------------------
Arguments :
$idEquipement : id de l'équipement choisis.
---------------------------------------------------------------------------
Retour : Tout.
------------------------------------------------------------------------ */
function getDocumentEquipement($idEquipement) {
	global $pdo;
        $query = "SELECT `document`.`idDocument`,`nomDocument`, CONCAT(`valeurTypeDoc`,'-',`valeurProcessus`,'-',`valeurSousProcessus`,'-',`valeurCategorie`,'-',`valeurAcronime`,'-',`document`.`idDocument`)
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

        try {
        	$result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
        	return($result);
        }
        catch ( Exception $e ) {
        	die ("Erreur dans la requete ".$e->getMessage());
        }
}


/*
------------------------------------------------------------------------
Fonction : getCategorie
---------------------------------------------------------------------------
Description :
Permet de sélectionner toutes les catégorie d'équipement.
---------------------------------------------------------------------------
Arguments : Aucun.
---------------------------------------------------------------------------
Retour : Tout.
------------------------------------------------------------------------ */
function getCategorie() {	//Affiche tout les catégorie d'équipement
	global $pdo;
		$query = "SELECT * FROM categorie_etiquette ORDER BY categorieEtiquette LIMIT 1, 600";

		try{
			$result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
			return($result);
		}
		catch (Exception $e){
			die ("Erreur dans la requete ".$e->getMessage());
		}
}


/*
------------------------------------------------------------------------
Fonction : deleteCategorie
---------------------------------------------------------------------------
Description :
Permet de supprimer la catégorie d'équipement choisis.
---------------------------------------------------------------------------
Arguments :
$id : id de la catégorie choisis.
---------------------------------------------------------------------------
Retour : Aucun.
------------------------------------------------------------------------ */
function deleteCategorie($id){	//Supprimer la catégorie d'équipement
      global $pdo;
      $query = "delete from categorie_etiquette where idCategorieEtiquette = :idCategorieEtiquette ;";
      try {
		$prep = $pdo->prepare($query);
		$prep->bindValue(':idCategorieEtiquette', $id);
		$prep->execute();
      }
      catch ( Exception $e ) {
		die ("Erreur dans la requete ".$e->getMessage());
      }
}


/*
------------------------------------------------------------------------
Fonction : updateCategorie
---------------------------------------------------------------------------
Description :
Permet de modifier une catégorie.
---------------------------------------------------------------------------
Arguments :
$id : id de la catégorie choisis.
---------------------------------------------------------------------------
Retour : Rien.
------------------------------------------------------------------------ */
function updateCategorie($id){	//Modifie la catégorie d'équipement
      global $pdo;
      $query = "update from categorie_etiquette where idCategorieEtiquette = :idCategorieEtiquette ;";
      try {
		$prep = $pdo->prepare($query);
		$prep->bindValue(':idCategorieEtiquette', $id);
		$prep->execute();
      }
      catch ( Exception $e ) {
		die ("Erreur dans la requete ".$e->getMessage());
      }
}


/*
------------------------------------------------------------------------
Fonction : getEquipementEtiquette
---------------------------------------------------------------------------
Description :
Permet de sélectionner les équipements par recherche d'étiquette.
---------------------------------------------------------------------------
Arguments :
$chaineSearchCat : chaine de caractère de la catégorie.
$chaineSearchAcr : chaine de caractère de l'acronime.
$chaineSearchId : chaine de caractère de l'id équipement.
---------------------------------------------------------------------------
Retour : Tout.
------------------------------------------------------------------------ */
function getEquipementEtiquette($chaineSearchCat, $chaineSearchAcr, $chaineSearchId) {	//affihce les etiquette pour chaque equipement
	global $pdo;
	$query = "SELECT *
				FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`
				WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
				AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
				AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
				AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
				AND valeurCategorie LIKE :chaineSearchCat
				AND valeurAcronime LIKE :chaineSearchAcr
				AND equipement.idEquipement LIKE :chaineSearchId";

	try{
		$prep = $pdo->prepare($query);
		$prep->bindValue(':chaineSearchCat', $chaineSearchCat);
		$prep->bindValue(':chaineSearchAcr', $chaineSearchAcr);
		$prep->bindValue(':chaineSearchId', $chaineSearchId);
		$prep->execute();
      }
      catch ( Exception $e ) {
		die ("Erreur dans la requete ".$e->getMessage());
      }
}


/*
------------------------------------------------------------------------
Fonction : getAcronime
---------------------------------------------------------------------------
Description :
Permet de sélectionner tous les acronimes d'étiquette.
---------------------------------------------------------------------------
Arguments : Aucun.
---------------------------------------------------------------------------
Retour : Tout.
------------------------------------------------------------------------ */
function getAcronime() {	//Affiche les acronime
	global $pdo;
		$query = "SELECT * FROM acronime_etiquette ORDER BY acronimeEtiquette LIMIT 1, 600";

		try{
			$result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
			return($result);
		}
		catch (Exception $e){
			die ("Erreur dans la requete ".$e->getMessage());
		}
}


/*
------------------------------------------------------------------------
Fonction : deleteAcronime
---------------------------------------------------------------------------
Description :
Permet de supprimer un acronime choisis.
---------------------------------------------------------------------------
Arguments :
$id : id de l'acronime choisis.
---------------------------------------------------------------------------
Retour : Aucun.
------------------------------------------------------------------------ */
function deleteAcronime($id) {	//Supprime l'acronime selectionner
      global $pdo;
      $query = "delete from acronime_etiquette where idAcronimeEtiquette = :idAcronimeEtiquette ;";
      try {
		$prep = $pdo->prepare($query);
		$prep->bindValue(':idAcronimeEtiquette', $id);
		$prep->execute();
      }
      catch ( Exception $e ) {
		die ("Erreur dans la requete ".$e->getMessage());
      }
}


/*
------------------------------------------------------------------------
Fonction : updateAcronime
---------------------------------------------------------------------------
Description :
Permet de modifer l'acronime choisis.
---------------------------------------------------------------------------
Arguments :
$id : id de l'acronime choisis.
---------------------------------------------------------------------------
Retour : Aucune.
------------------------------------------------------------------------ */
function updateAcronime($id) {	//Modifie l'acronime selectionner
      global $pdo;
      $query = "update from acronime_etiquette where idAcronimeEtiquette = :idAcronimeEtiquette ;";
      try {
		$prep = $pdo->prepare($query);
		$prep->bindValue(':idAcronimeEtiquette', $id);
		$prep->execute();
      }
      catch ( Exception $e ) {
		die ("Erreur dans la requete ".$e->getMessage());
      }
}


/*
------------------------------------------------------------------------
Fonction : getDocumentToEquipement
---------------------------------------------------------------------------
Description :
Permet de sélectionner tout les documents qui ne sont pas lier à
l'équipement.
---------------------------------------------------------------------------
Arguments :
$idEquipement : id de l'équipement choisis.
---------------------------------------------------------------------------
Retour : Tout.
------------------------------------------------------------------------ */
function getDocumentToEquipement($idEquipement) {	//Affiche tout les documents
	global $pdo;
		$query = "SELECT `document`.`idDocument`,`nomDocument`, CONCAT(`valeurTypeDoc`,'-',`valeurProcessus`,'-',`valeurSousProcessus`,'-',`valeurCategorie`,'-',`valeurAcronime`,'-',`document`.`idDocument`), CONCAT(`valeurPlateforme`,'-', `valeurPiece`,'-', `valeurEmplacement`,'-', `valeurSousEmplacement`)
				FROM `document`, `etiquette_document`,`type_document`,`processus`, `sous_processus`, `etiquette_equipement`, `categorie_etiquette`, `acronime_etiquette`,`lieux_document`,`plateforme_archive`, `piece_document`, `emplacement_archive`, `sous_emplacement`
				WHERE `document`.`idEtiquette_Document` = `etiquette_document`.`idEtiquette_Document`
				AND `etiquette_document`.`idType_Document` = `type_document`.`idType_Document`
				AND `etiquette_document`.`idProcessus` = `processus`.`idProcessus`
				AND `etiquette_document`.`idSous_Processus` = `sous_processus`.`idSous_Processus`
				AND `etiquette_document`.`idEtiquette_Equipement` = `etiquette_equipement`.`idEtiquette_Equipement`
				AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
				AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
				AND `document`.`idLieux_Document` = `lieux_document`.`idLieux_Document`
				AND `lieux_document`.`idPlateforme_Archive` = `plateforme_archive`.`idPlateforme_Archive`
				AND `lieux_document`.`idPiece_Document` = `piece_document`.`idPiece_Document`
				AND `lieux_document`.`idEmplacement_Archive` = `emplacement_archive`.`idEmplacement_Archive`
				AND `lieux_document`.`idSous_Emplacement` = `sous_emplacement`.`idSous_Emplacement`
				AND `idDocument` NOT IN (

										SELECT `document`.`idDocument`
										FROM `document`, `equipement_has_document`
										WHERE `document`.`idDocument` = `equipement_has_document`.`idDocument`
										AND`idEquipement`= $idEquipement)";

		try {
		  $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
		  return $result;
		}
		catch ( Exception $e ) {
		  die ("Erreur dans la requete ".$e->getMessage());
		}
}


/*
------------------------------------------------------------------------
Fonction : getEquipement
---------------------------------------------------------------------------
Description :
Permet de sélectionner tout sur l'équipement choisis.
---------------------------------------------------------------------------
Arguments :
$idEquipement : id de l'équipement choisis.
---------------------------------------------------------------------------
Retour : Tout.
------------------------------------------------------------------------ */
function getAllDocument() {
	global $pdo;
		$query = "SELECT `document`.`idDocument`,`nomDocument`, CONCAT(`valeurTypeDoc`,'-',`valeurProcessus`,'-',`valeurSousProcessus`,'-',`valeurCategorie`,'-',`valeurAcronime`,'-',`document`.`idDocument`), CONCAT(`valeurPlateforme`,'-', `valeurPiece`,'-', `valeurEmplacement`,'-', `valeurSousEmplacement`)
				FROM `document`, `etiquette_document`,`type_document`,`processus`, `sous_processus`, `etiquette_equipement`, `categorie_etiquette`, `acronime_etiquette`,`lieux_document`,`plateforme_archive`, `piece_document`, `emplacement_archive`, `sous_emplacement`
				WHERE `document`.`idEtiquette_Document` = `etiquette_document`.`idEtiquette_Document`
				AND `etiquette_document`.`idType_Document` = `type_document`.`idType_Document`
				AND `etiquette_document`.`idProcessus` = `processus`.`idProcessus`
				AND `etiquette_document`.`idSous_Processus` = `sous_processus`.`idSous_Processus`
				AND `etiquette_document`.`idEtiquette_Equipement` = `etiquette_equipement`.`idEtiquette_Equipement`
				AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
				AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
				AND `document`.`idLieux_Document` = `lieux_document`.`idLieux_Document`
				AND `lieux_document`.`idPlateforme_Archive` = `plateforme_archive`.`idPlateforme_Archive`
				AND `lieux_document`.`idPiece_Document` = `piece_document`.`idPiece_Document`
				AND `lieux_document`.`idEmplacement_Archive` = `emplacement_archive`.`idEmplacement_Archive`
				AND `lieux_document`.`idSous_Emplacement` = `sous_emplacement`.`idSous_Emplacement`";

		try {
		  $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
		  return $result;
		}
		catch ( Exception $e ) {
		  die ("Erreur dans la requete ".$e->getMessage());
		}
}


/*
------------------------------------------------------------------------
Fonction : getPlanning
---------------------------------------------------------------------------
Description :
Permet de sélectionner tout entretien, anomalie et calibration d'un
équipement.
---------------------------------------------------------------------------
Arguments :
$idEquipement : id de l'équipement choisis.
---------------------------------------------------------------------------
Retour : Tout.
------------------------------------------------------------------------ */
function getPlanning($idEquipement) {	//Affiche le planning par équipement
    global $pdo;
        $query="
            SELECT `entretien`.`idEntretien` as Id , `nomEntretien` as Nom, `dateEntretien` as Date, `finEntretien` as DateFin, `utilisateur`.`nomUtilisateur` as Createur, SUBSTRING(`descriptionEntretien`,1,100) as description
            FROM `entretien`,`utilisateur`, `fiche_de_vie_has_entretien`, `fiche_de_vie` , `equipement`
			WHERE `entretien`.`idUtilisateur` = `utilisateur`.`idUtilisateur`
			AND `entretien`.`idEntretien` = `fiche_de_vie_has_entretien`.`idEntretien`
			AND `fiche_de_vie_has_entretien`.`idFicheDeVie` = `fiche_de_vie`.`idFicheDeVie`
			AND `fiche_de_vie`.`idEquipement` = `equipement`.`idEquipement`
			AND `equipement`.`idEquipement` = $idEquipement

            UNION

            SELECT `anomalie`.`idAnomalie` as Id, `nomAnomalie`as Nom , `dateAnomalie` as Date, `finAnomalie` as DateFin, `utilisateur`.`nomUtilisateur` as Createur, SUBSTRING(`descriptionAnomalie`,1,100) as description
            FROM `anomalie`,`utilisateur`, `fiche_de_vie_has_anomalie`,`fiche_de_vie`,`equipement`
            WHERE `anomalie`.`idUtilisateur`= `utilisateur`.`idUtilisateur`
			AND `anomalie`.`idAnomalie` = `fiche_de_vie_has_anomalie`.`idAnomalie`
			AND `fiche_de_vie_has_anomalie`.`idFicheDeVie` = `fiche_de_vie`.`idFicheDeVie`
			AND `fiche_de_vie`.`idEquipement` = `equipement`.`idEquipement`
			AND `equipement`.`idEquipement` = $idEquipement

            UNION

            SELECT  `calibration`.`idCalibration` as Id, `nomCalibration`as Nom , `dateCalibration` as Date, `finCalibration` as DateFin, `utilisateur`.`nomUtilisateur` as Createur, SUBSTRING(`descriptionCalibration`,1,100) as description
            FROM `calibration`,`utilisateur`, `fiche_de_vie_has_calibration`, `fiche_de_vie` , `equipement`
            WHERE `calibration`.`idUtilisateur`= `utilisateur`.`idUtilisateur`
			AND `calibration`.`idCalibration` = `fiche_de_vie_has_calibration`.`idCalibration`
			AND `fiche_de_vie_has_calibration`.`idFicheDeVie` = `fiche_de_vie`.`idFicheDeVie`
			AND `fiche_de_vie`.`idEquipement` = `equipement`.`idEquipement`
			AND `equipement`.`idEquipement` = $idEquipement
            ORDER BY DATE DESC;";


		try {
		  $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
		  return $result;
		}
		catch ( Exception $e ) {
		  die ("Erreur dans la requete ".$e->getMessage());
		}
}


/*
------------------------------------------------------------------------
Fonction : getAllPlateforme
---------------------------------------------------------------------------
Description :
Permet de sélectionner toutes les plateformes.
---------------------------------------------------------------------------
Arguments : Aucun.
---------------------------------------------------------------------------
Retour : Tout.
------------------------------------------------------------------------ */
function getAllPlateforme() {	//Affiche les plateformes
	global $pdo;
		$query = "SELECT * FROM plateforme_archive ORDER BY plateformeArchive LIMIT 1, 600";

		try{
			$result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
			return($result);
		}
		catch (Exception $e){
			die ("Erreur dans la requete ".$e->getMessage());
		}
}


/*
------------------------------------------------------------------------
Fonction : deletePlatforme
---------------------------------------------------------------------------
Description :
Permet de supprimer la plateforme choisis.
---------------------------------------------------------------------------
Arguments :
$id : id de la plateforme choisis.
---------------------------------------------------------------------------
Retour : Aucun.
------------------------------------------------------------------------ */
function deletePlateforme($id) {
    global $pdo;
      $query = "delete from plateforme_archive where idPlateforme_Archive = :idPlateforme_Archive ;";
      try {
		$prep = $pdo->prepare($query);
		$prep->bindValue(':idPlateforme_Archive', $id);
		$prep->execute();
      }
      catch ( Exception $e ) {
		die ("Erreur dans la requete ".$e->getMessage());
      }
}


/*
------------------------------------------------------------------------
Fonction : deletePiece
---------------------------------------------------------------------------
Description :
Permet de supprimer la piece choisis.
---------------------------------------------------------------------------
Arguments :
$id : id de la piece choisis.
---------------------------------------------------------------------------
Retour : Aucun.
------------------------------------------------------------------------ */
function deletePiece($id) {
      global $pdo;
      $query = "delete from piece_document where idPiece_Document = :idPiece ;";
      try {
		$prep = $pdo->prepare($query);
		$prep->bindValue(':idPiece', $id);
		$prep->execute();
      }
      catch ( Exception $e ) {
		die ("Erreur dans la requete ".$e->getMessage());
      }
}


/*
------------------------------------------------------------------------
Fonction : deleteEmplacement
---------------------------------------------------------------------------
Description :
Permet de supprimer l'emplacement choisis.
---------------------------------------------------------------------------
Arguments :
$id : id de l'emplacement choisis.
---------------------------------------------------------------------------
Retour : Aucun.
------------------------------------------------------------------------ */
function deleteEmplacement($id){	//Supprime la plateforme selectionner
      global $pdo;
      $query = "delete from emplacement_archive where idEmplacement_Archive = :idEmplacement ;";
      try {
		$prep = $pdo->prepare($query);
		$prep->bindValue(':idEmplacement', $id);
		$prep->execute();
      }
      catch ( Exception $e ) {
		die ("Erreur dans la requete ".$e->getMessage());
      }
}


/*
------------------------------------------------------------------------
Fonction : deleteSousEmplacement
---------------------------------------------------------------------------
Description :
Permet de supprimer le sous emplacement choisis.
---------------------------------------------------------------------------
Arguments :
$id : id du sous emplacement choisis.
---------------------------------------------------------------------------
Retour : Aucun.
------------------------------------------------------------------------ */
function deleteSousEmplacement($id){	//Supprime la plateforme selectionner
      global $pdo;
      $query = "delete from sous_emplacement where idSous_Emplacement = :idSousEmplacement ;";
      try {
		$prep = $pdo->prepare($query);
		$prep->bindValue(':idSousEmplacement', $id);
		$prep->execute();
      }
      catch ( Exception $e ) {
		die ("Erreur dans la requete ".$e->getMessage());
      }
}


/*
------------------------------------------------------------------------
Fonction : getAllPiece
---------------------------------------------------------------------------
Description :
Permet de sélectionner toutes les pièce de document.
---------------------------------------------------------------------------
Arguments : Aucun.
---------------------------------------------------------------------------
Retour : Tout.
------------------------------------------------------------------------ */
function getAllPiece(){
	global $pdo;
		$query = "SELECT * FROM piece_document ORDER BY pieceDocument LIMIT 1, 600";

		try{
			$result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
			return($result);
		}
		catch (Exception $e){
			die ("Erreur dans la requete ".$e->getMessage());
		}
}

/*
------------------------------------------------------------------------
Fonction : getAllEmplacement
---------------------------------------------------------------------------
Description :
Permet de sélectionner toutes les emplacements de document.
---------------------------------------------------------------------------
Arguments : Aucun.
---------------------------------------------------------------------------
Retour : Tout.
------------------------------------------------------------------------ */
function getAllEmplacement(){
	global $pdo;
		$query = "SELECT * FROM emplacement_archive ORDER BY emplacementArchive LIMIT 1, 600";

		try{
			$result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
			return($result);
		}
		catch (Exception $e){
			die ("Erreur dans la requete ".$e->getMessage());
		}
}


/*
------------------------------------------------------------------------
Fonction : getAllsousEmplacement
---------------------------------------------------------------------------
Description :
Permet de sélectionner toutes les sous emplacements de document.
---------------------------------------------------------------------------
Arguments : Aucun.
---------------------------------------------------------------------------
Retour : Tout.
------------------------------------------------------------------------ */
function getAllSousEmplacement(){
	global $pdo;
		$query = "SELECT * FROM sous_emplacement ORDER BY sousEmplacement LIMIT 1, 600";

		try{
			$result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
			return($result);
		}
		catch (Exception $e){
			die ("Erreur dans la requete ".$e->getMessage());
		}
}



/*
------------------------------------------------------------------------
Fonction : getPlanningOccupation
---------------------------------------------------------------------------
Description :
Permet de sélectionner les périodes d'utilisation et de réservation
de l'équipement.
---------------------------------------------------------------------------
Arguments :
$idEquipement : équipement choisis.
---------------------------------------------------------------------------
Retour : Tout.
------------------------------------------------------------------------ */
function getPlanningOccupation($idEquipement) {	//Affiche le planning d'occupation de chaque equipement
	global $pdo;
	$query = "SELECT `planning_occupation`.`idPlanning_Occupation`,`dateDebut`, `dateFin`,`plateforme`,`lieuUtilisation`,`piece`, `fonctionPrincipal`, `fonctionSecondaire`, `nomUtilisateur`
				FROM `planning_occupation`, `equipement_has_planning_occupation`, `equipement`, `plateforme`, `lieu_utilisation`, `piece_equipement`, `utilisateur`
				WHERE `equipement`.`idEquipement` = `equipement_has_planning_occupation`.`idEquipement`
				AND `equipement_has_planning_occupation`.`idPlanning_Occupation` = `planning_occupation`.`idPlanning_Occupation`
				AND `planning_occupation`.`idPlateforme` = `plateforme`.`idPlateforme`
				AND `planning_occupation`.`idLieu_Utilisation` = `lieu_utilisation`.`idLieu_Utilisation`
				AND `planning_occupation`.`idPiece` = `piece_equipement`.`idPiece`
				AND `planning_occupation`.`idUtilisateur` = `utilisateur`.`idUtilisateur`
				AND `equipement`.`idEquipement`= $idEquipement;";
    	try {
			$result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
			return $result;

      	}
      	catch ( Exception $e ) {
			die ("Erreur dans la requete ".$e->getMessage());
		}
}


/*
------------------------------------------------------------------------
Fonction : getEquipementDocument
---------------------------------------------------------------------------
Description :
Permet de sélectionner tout les équipement lier au document choisis.
---------------------------------------------------------------------------
Arguments : $idDocument.
---------------------------------------------------------------------------
Retour : Tout.
------------------------------------------------------------------------ */
function getEquipementDocument($idDocument){	//Affiche les documents lier au document choisis
	global $pdo;
        $query = "SELECT `equipement`.`idEquipement`, CONCAT(`valeurCategorie`,'-',`valeurAcronime`,'-',`equipement`.`idEquipement`), `nomEquipement`
				  FROM `equipement`, `categorie_etiquette`,  `etiquette_equipement`, `acronime_etiquette`, `document`, `equipement_has_document`
				  WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
				  AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
				  AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
				  AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
				  AND `equipement`.`idEquipement` = `equipement_has_document`.`idEquipement`
				  AND `equipement_has_document`.`idDocument` = `document`.`idDocument`
				  AND `document`.`idDocument`=$idDocument";

        try {
        	$result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
        	return($result);
        }
        catch ( Exception $e ) {
        	die ("Erreur dans la requete ".$e->getMessage());
        }
}


/*
------------------------------------------------------------------------
Fonction : deleteEquipement
---------------------------------------------------------------------------
Description :
Permet de l'équipement choisis.
---------------------------------------------------------------------------
Arguments : $idEquipement.
---------------------------------------------------------------------------
Retour : Aucun.
------------------------------------------------------------------------ */
function deleteEquipement($idEquipement){
	global $pdo;

    $query = "DELETE FROM equipement WHERE idEquipement = :idEquipement;";
		  try {
			$prep = $pdo->prepare($query);
			$prep->bindValue(':idEquipement', $idEquipement);
			$prep->execute();
		  }
		  catch ( Exception $e ) {
			die ("Erreur dans la requete ".$e->getMessage());
		  }

	$query = "DELETE FROM etiquette_equipement WHERE idEquipement = :idEquipement;";
		  try {
			$prep = $pdo->prepare($query);
			$prep->bindValue(':idEquipement', $idEquipement);
			$prep->execute();
		  }
		  catch ( Exception $e ) {
			die ("Erreur dans la requete ".$e->getMessage());
		  }

	$query = "DELETE FROM fiche_de_vie WHERE idEquipement = :idEquipement;";
		  try {
			$prep = $pdo->prepare($query);
			$prep->bindValue(':idEquipement', $idEquipement);
			$prep->execute();
		  }
		  catch ( Exception $e ) {
			die ("Erreur dans la requete ".$e->getMessage());
		  }

	$query = "DELETE FROM fiche_de_vie_has_calibration WHERE idFicheDeVie = :idEquipement;";
		  try {
			$prep = $pdo->prepare($query);
			$prep->bindValue(':idEquipement', $idEquipement);
			$prep->execute();
		  }
		  catch ( Exception $e ) {
			die ("Erreur dans la requete ".$e->getMessage());
		  }

	$query = "DELETE FROM fiche_de_vie_has_entretien WHERE idFicheDeVie = :idEquipement;";
		  try {
			$prep = $pdo->prepare($query);
			$prep->bindValue(':idEquipement', $idEquipement);
			$prep->execute();
		  }
		  catch ( Exception $e ) {
			die ("Erreur dans la requete ".$e->getMessage());
		  }

	$query = "DELETE FROM fiche_de_vie_has_anomalie WHERE idFicheDeVie = :idEquipement;";
		  try {
			$prep = $pdo->prepare($query);
			$prep->bindValue(':idEquipement', $idEquipement);
			$prep->execute();
		  }
		  catch ( Exception $e ) {
			die ("Erreur dans la requete ".$e->getMessage());
		  }

	$query = "DELETE FROM equipement_has_planning_occupation WHERE idEquipement = :idEquipement;";
		  try {
			$prep = $pdo->prepare($query);
			$prep->bindValue(':idEquipement', $idEquipement);
			$prep->execute();
		  }
		  catch ( Exception $e ) {
			die ("Erreur dans la requete ".$e->getMessage());
		  }
}


/*
------------------------------------------------------------------------
Fonction : getEquipementToDocument
---------------------------------------------------------------------------
Description :
Permet de sélectionner tout les équipement qui ne sont pas
lier au document choisis.
---------------------------------------------------------------------------
Arguments : $idDocument.
---------------------------------------------------------------------------
Retour : Tout.
------------------------------------------------------------------------ */
function getEquipementToDoc($idDocument){
	global $pdo;
		$query = "SELECT `equipement`.`idEquipement`, CONCAT(`valeurCategorie`,'-',`valeurAcronime`,'-',`equipement`.`idEquipement`), nomEquipement
				FROM `categorie_etiquette`,  `etiquette_equipement`, `equipement`, `acronime_etiquette`
				WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
				AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
				AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
				AND `equipement`.`idEquipement` NOT IN (

													SELECT `equipement`.`idEquipement`
													FROM `Equipement`, `equipement_has_document`
													WHERE `equipement`.`idEquipement` = `equipement_has_document`.`idEquipement`
													AND`idDocument`= '$idDocument')";

        try {
          $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
          return($result);
        }
        catch ( Exception $e ) {
          die ("Erreur dans la requete ".$e->getMessage());
        }
}


/*
------------------------------------------------------------------------
Fonction : deleteDocument
---------------------------------------------------------------------------
Description :
Permet de supprimer le document choisis.
---------------------------------------------------------------------------
Arguments : $idDocument.
---------------------------------------------------------------------------
Retour : Tout.
------------------------------------------------------------------------ */
function deleteDocument($idDocument){

	global $pdo;

	$requete2 = "SELECT `cheminFichier` FROM `document` WHERE `idDocument` = '$idDocument'";

	$retour_requete = $pdo->query($requete2); //Nous récupérons le contenu de la requête dans $retour_total

	while($donnees = $retour_requete->fetch(PDO::FETCH_ASSOC)) {
		$cheminFichier = ($donnees['cheminFichier']);
	}

    $query = "DELETE FROM document WHERE idDocument = :idDocument;";
		  try {
			$prep = $pdo->prepare($query);
			$prep->bindValue(':idDocument', $idDocument);
			$prep->execute();
		  }
		  catch ( Exception $e ) {
			die ("Erreur dans la requete ".$e->getMessage());
		  }

	$query = "DELETE FROM equipement_has_document WHERE idDocument = :idDocument;";
		  try {
			$prep = $pdo->prepare($query);
			$prep->bindValue(':idDocument', $idDocument);
			$prep->execute();
		  }
		  catch ( Exception $e ) {
			die ("Erreur dans la requete ".$e->getMessage());
		  }

	$query = "DELETE FROM etiquette_document WHERE idEtiquette_Document = :idDocument;";
		  try {
			$prep = $pdo->prepare($query);
			$prep->bindValue(':idDocument', $idDocument);
			$prep->execute();
		  }
		  catch ( Exception $e ) {
			die ("Erreur dans la requete ".$e->getMessage());
		  }

	$query = "DELETE FROM lieux_document WHERE idLieux_Document = :idDocument;";
		  try {
			$prep = $pdo->prepare($query);
			$prep->bindValue(':idDocument', $idDocument);
			$prep->execute();
		  }
		  catch ( Exception $e ) {
			die ("Erreur dans la requete ".$e->getMessage());
		  }

	unlink($cheminFichier);
}

/*
------------------------------------------------------------------------
Fonction : CleanPath
---------------------------------------------------------------------------
Description :
Permet de supprimer les fichiers d'un repertoire de maniere
recursive.
---------------------------------------------------------------------------
Arguments :
$dirName : Chemin de base a parcourir.
$doRecursive : TRUE si recursif (sous repertoire), FALSE sinon.
---------------------------------------------------------------------------
Retour : Aucun.
------------------------------------------------------------------------ */
function CleanPath($dirName, $doRecursive=FALSE) {
// Pour tous les elements du repertoire
	$d = dir($dirName);
	while ($entry = $d->read())	{
		if ($entry != "." && $entry != "..")	{
			// Fichier ?
			$tmpFile = $dirName . "/" . $entry;

			if (is_file($tmpFile))
				unlink($tmpFile);
			else if ($doRecursive && is_dir($tmpFile))
				CleanParh($tmpFile, $doRecursive);
		}
	}
	$d->close();
}


/*
------------------------------------------------------------------------
Fonction : addDocToEqui
---------------------------------------------------------------------------
Description :
Permet d'ajouter un document à l'équipement choisis.
---------------------------------------------------------------------------
Arguments :
$idDocument : id du document.
$idEquipement : id de l'équipement.
---------------------------------------------------------------------------
Retour : Aucun.
------------------------------------------------------------------------ */
function addDocToEqui($idDocument, $idEquipement) {
	global $pdo;
    $query = "INSERT INTO `equipement_has_document` (idEquipement, idDocument) VALUES (:idEquipement, :idDocument)";
		  try {
			$prep = $pdo->prepare($query);
			$prep->bindValue(':idDocument', $idDocument);
			$prep->bindValue(':idEquipement', $idEquipement);
			$prep->execute();
		  }
		  catch ( Exception $e ) {
			die ("Erreur dans la requete ".$e->getMessage());
		  }
}


/*
------------------------------------------------------------------------
Fonction : deleteDocToEqui
---------------------------------------------------------------------------
Description :
Permet de supprimer un équipement au document choisis.
---------------------------------------------------------------------------
Arguments :
$idDocument : id du document.
$idEquipement : id de l'équipement.
---------------------------------------------------------------------------
Retour : Aucun.
------------------------------------------------------------------------ */
function deleteDocToEqui($idDocument, $idEquipement) {
	global $pdo;
    $query = "DELETE FROM `equipement_has_document` WHERE idEquipement=:idEquipement AND idDocument=:idDocument";
		  try {
			$prep = $pdo->prepare($query);
			$prep->bindValue(':idDocument', $idDocument);
			$prep->bindValue(':idEquipement', $idEquipement);
			$prep->execute();
		  }
		  catch ( Exception $e ) {
			die ("Erreur dans la requete ".$e->getMessage());
		  }
}


/*
------------------------------------------------------------------------
Fonction : getAllFournisseur
---------------------------------------------------------------------------
Description :
Permet de sélectionner tout les fournisseurs.
---------------------------------------------------------------------------
Arguments : Aucun.
---------------------------------------------------------------------------
Retour : Tout.
------------------------------------------------------------------------ */
function getAllFournisseur(){
	global $pdo;
		$query = "SELECT * FROM fournisseur ORDER BY idFournisseur LIMIT 1, 5000";

		try{
			$result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
			return($result);
		}
		catch (Exception $e){
			die ("Erreur dans la requete ".$e->getMessage());
		}
}


/*
------------------------------------------------------------------------
Fonction : deleteFournisseur
---------------------------------------------------------------------------
Description :
Permet de supprimer un fournisseur choisis.
---------------------------------------------------------------------------
Arguments :
$idFournisseur : id du fournisseur.
---------------------------------------------------------------------------
Retour : Aucun.
------------------------------------------------------------------------ */
function deleteFournisseur($idFournisseur) {
	global $pdo;
    $query = "DELETE FROM `fournisseur` WHERE idFournisseur=:idFournisseur";
		  try {
			$prep = $pdo->prepare($query);
			$prep->bindValue(':idFournisseur', $idFournisseur);
			$prep->execute();
		  }
		  catch ( Exception $e ) {
			die ("Erreur dans la requete ".$e->getMessage());
		  }
}


/*
------------------------------------------------------------------------
Fonction : getAllType
---------------------------------------------------------------------------
Description :
Permet de sélectionner tout les types.
---------------------------------------------------------------------------
Arguments : Aucun.
---------------------------------------------------------------------------
Retour : Tout.
------------------------------------------------------------------------ */
function getAllType() {
	global $pdo;
		$query = "SELECT * FROM type_document ORDER BY typeDocument LIMIT 1, 600";

		try{
			$result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
			return($result);
		}
		catch (Exception $e){
			die ("Erreur dans la requete ".$e->getMessage());
		}
}


/*
------------------------------------------------------------------------
Fonction : deleteType
---------------------------------------------------------------------------
Description :
Permet de supprimer le type choisis.
---------------------------------------------------------------------------
Arguments :
$id : id de du type choisis.
---------------------------------------------------------------------------
Retour : Aucun.
------------------------------------------------------------------------ */
function deleteType($id) {
    global $pdo;
      $query = "delete from type where idType_Document = :idType ;";
      try {
		$prep = $pdo->prepare($query);
		$prep->bindValue(':idType', $id);
		$prep->execute();
      }
      catch ( Exception $e ) {
		die ("Erreur dans la requete ".$e->getMessage());
      }
}


/*
------------------------------------------------------------------------
Fonction : deleteProcessus
---------------------------------------------------------------------------
Description :
Permet de supprimer le processus choisis.
---------------------------------------------------------------------------
Arguments :
$id : id de le processus choisis.
---------------------------------------------------------------------------
Retour : Aucun.
------------------------------------------------------------------------ */
function deleteProcessus($id) {
      global $pdo;
      $query = "delete from processus where idProcessus = :idProcessus ;";
      try {
		$prep = $pdo->prepare($query);
		$prep->bindValue(':idProcessus', $id);
		$prep->execute();
      }
      catch ( Exception $e ) {
		die ("Erreur dans la requete ".$e->getMessage());
      }
}


/*
------------------------------------------------------------------------
Fonction : deleteSousProcessus
---------------------------------------------------------------------------
Description :
Permet de supprimer le sous-processus choisis.
---------------------------------------------------------------------------
Arguments :
$id : id du sous-processus choisis.
---------------------------------------------------------------------------
Retour : Aucun.
------------------------------------------------------------------------ */
function deleteSousProcessus($id){	//Supprime la plateforme selectionner
      global $pdo;
      $query = "delete from sous_processus where idSous_Processus = :idSousProcessus ;";
      try {
		$prep = $pdo->prepare($query);
		$prep->bindValue(':idSousProcessus', $id);
		$prep->execute();
      }
      catch ( Exception $e ) {
		die ("Erreur dans la requete ".$e->getMessage());
      }
}


/*
------------------------------------------------------------------------
Fonction : getAllProcessus
---------------------------------------------------------------------------
Description :
Permet de sélectionner toutes les processus de document.
---------------------------------------------------------------------------
Arguments : Aucun.
---------------------------------------------------------------------------
Retour : Tout.
------------------------------------------------------------------------ */
function getAllProcessus(){
	global $pdo;
		$query = "SELECT * FROM processus ORDER BY idProcessus LIMIT 1, 600";

		try{
			$result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
			return($result);
		}
		catch (Exception $e){
			die ("Erreur dans la requete ".$e->getMessage());
		}
}

/*
------------------------------------------------------------------------
Fonction : getAllSousProcessus
---------------------------------------------------------------------------
Description :
Permet de sélectionner tout les sous processus de document.
---------------------------------------------------------------------------
Arguments : Aucun.
---------------------------------------------------------------------------
Retour : Tout.
------------------------------------------------------------------------ */
function getAllSousProcessus(){
	global $pdo;
		$query = "SELECT * FROM sous_processus ORDER BY idSous_Processus LIMIT 1, 600";

		try{
			$result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
			return($result);
		}
		catch (Exception $e){
			die ("Erreur dans la requete ".$e->getMessage());
		}
}


/*
------------------------------------------------------------------------
Fonction : deleteReservation
---------------------------------------------------------------------------
Description :
Permet de supprimer une réservation choisis.
---------------------------------------------------------------------------
Arguments :
$id : id de la réservation.
---------------------------------------------------------------------------
Retour : Aucun.
------------------------------------------------------------------------ */
function deleteReservation($id) {
	global $pdo;
    $query = "DELETE FROM `planning_occupation` WHERE idPlanning_Occupation = :id";
		  try {
			$prep = $pdo->prepare($query);
			$prep->bindValue(':id', $id);
			$prep->execute();
		  }
		  catch ( Exception $e ) {
			die ("Erreur dans la requete ".$e->getMessage());
		  }
	$query = "DELETE FROM `equipement_has_planning_occupation` WHERE idPlanning_Occupation = :id";
		  try {
			$prep = $pdo->prepare($query);
			$prep->bindValue(':id', $id);
			$prep->execute();
		  }
		  catch ( Exception $e ) {
			die ("Erreur dans la requete ".$e->getMessage());
		  }
}
