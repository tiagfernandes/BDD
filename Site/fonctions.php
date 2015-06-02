<?php
require_once('connexion.php');
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
    $query = "SELECT CONCAT(`valeurCategorie`,'-',`valeurAcronime`,'-',`equipement`.`idEquipement`), `nomEquipement`,`nomFournisseur`,`prix`,`marque`,`dateAjout`,`dateFabrication`,`dateReception`,`dateMiseService`,`garantie`
              FROM `equipement`, `categorie_etiquette`,  `etiquette_equipement`, `acronime_etiquette`, `fournisseur`
              WHERE `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
              AND `etiquette_equipement`.`idCategorieEtiquette` = `categorie_etiquette`.`idCategorieEtiquette`
              AND `equipement`.`idEquipement` = `etiquette_equipement`.`idEquipement`
              AND `etiquette_equipement`.`idAcronimeEtiquette` = `acronime_etiquette`.`idAcronimeEtiquette`
              AND `equipement`.`idFournisseur` = `fournisseur`.`idFournisseur`";

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
    $query = 'SELECT * FROM utilisateur';

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
