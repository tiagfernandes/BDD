<?php
require_once('connexion.php');
session_start ();
header('Content-Type: text/html; charset=UTF-8');

function getAuthentification($login, $pass){
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

function getAllEquipement(){
    global $pdo;
    $query = "SELECT `equipement`.`idEquipement`, CONCAT(`valeurCategorie`,'-',`valeurAcronime`,'-',`equipement`.`idEquipement`), `nomEquipement`,`prix`,`marque`,`dateAjout`,`dateFabrication`,`dateReception`,`dateMiseService`,`garantie`
              FROM `equipement`, `categorie_etiquette`,  `etiquette_equipement`, `acronime_etiquette`
              WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
              AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
              AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
              AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
              GROUP BY `idEquipement` DESC";

    try {
      $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }
    catch ( Exception $e ) {
      die ("Erreur dans la requete ".$e->getMessage());
    }

}

function getAllUtilisateur(){
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


function deleteUtilisateur($id){
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

function getEtiquetteEquipement(){
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


function getEquipement($idEquipement){
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

function getNomEquipement($idEquipement){
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

function getEquipementDoc(){
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

function getDocumentEquipement($idEquipement){
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

function getCategorie() {
	global $pdo;
		$query = "SELECT * FROM categorie_etiquette ORDER BY categorieEtiquette";

		try{
			$result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
			return($result);
		}
		catch (Exception $e){
			die ("SELECT * FROM acronime_etiquette".$e->getMessage());
		}
}

function deleteCategorie($id){
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

function updateCategorie($id){
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
