<?php

  $host='localhost';
  $bd='ecotron';
  $login='root';
  $password='';

  try
{
	$bdd = new PDO('mysql:host=localhost; dbname=ecotron; charset=utf8', 'root', '');
  $pdo = new PDO('mysql:host='.$host.';dbname='.$bd, $login, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
  catch (Exception $e) //Le catch est chargé d’intercepter une éventuelle erreur

{
        die('Erreur : ' . $e->getMessage());
}

?>
