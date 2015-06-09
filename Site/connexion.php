<?php

  $host='localhost';
  $bd='qualite';
  $login='root';
  $password='';


try
{
      $pdo = new PDO('mysql:host='.$host.'; dbname='.$bd, $login, $password);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
    catch (Exception $e) //Le catch est chargé d’intercepter une éventuelle erreur

{
    die('Erreur : ' . $e->getMessage());
}

?>
