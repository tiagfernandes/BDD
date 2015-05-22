<?php
require_once('connexion.php');

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
    $query = 'SELECT * FROM equipement ';

    try {
      $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }
    catch ( Exception $e ) {
      die ("Erreur dans la requete ".$e->getMessage());
    }

}

function getAllFournisseur(){
    global $pdo;
    $query = 'SELECT * FROM fournisseur ';

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

function getAllEntretient(){
    global $pdo;
    $query = 'SELECT * FROM entretient';

    try {
      $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }
    catch ( Exception $e ) {
      die ("Erreur dans la requete ".$e->getMessage());
    }
}

function getAllArchive(){
    global $pdo;
    $query = 'SELECT * FROM lieux_archive';

    try {
      $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }
    catch ( Exception $e ) {
      die ("Erreur dans la requete ".$e->getMessage());
    }
}

function getAllPanne(){
    global $pdo;
    $query = 'SELECT * FROM panne';

    try {
      $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }
    catch ( Exception $e ) {
      die ("Erreur dans la requete ".$e->getMessage());
    }
}

function getAllOccupation(){
    global $pdo;
    $query = 'SELECT * FROM planning_occupation';

    try {
      $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }
    catch ( Exception $e ) {
      die ("Erreur dans la requete ".$e->getMessage());
    }
}

function getAllLiaison(){
    global $pdo;
    $query = 'SELECT * FROM liaison';

    try {
      $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }
    catch ( Exception $e ) {
      die ("Erreur dans la requete ".$e->getMessage());
    }
}
?>
