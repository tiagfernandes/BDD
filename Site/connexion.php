<?php

  try
{
      $bdd = new PDO('mysql:host=localhost; dbname=ecotron; charset=utf8', 'root', '');
      $pdo = new PDO('mysql:host=localhost;dbname=ecotron', 'root', '');
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
  catch (Exception $e) //Le catch est chargé d’intercepter une éventuelle erreur

{
        die('Erreur : ' . $e->getMessage());
}

?>
