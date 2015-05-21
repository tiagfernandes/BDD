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
      die ("erreur dans la requete ".$e->getMessage());
    }

}
?>
