<?php

  $host='localhost';
  $bd='qualite';
  $login='qualite_admin';
  $password='5GRA79T4puXvQsGU';
/*
// Si utilisation PC local ou Serveur distant
if (($_SERVER['SERVER_ADDR'] == '127.0.0.1') || ($_SERVER['SERVER_ADDR'] == '::1'))	{
	// --> Utilisation du PC LOCAL
	define('B2RUN_MODE_LOCAL', TRUE);

	// Chemin de base du serveur !!! Doit se finir par '/' !!!
	define('B2RUN_SERVER_BASE_PATH',
	'/home/chollet/Travail/WWW/ECOTRON/B2RUN/');

	// URL de base du serveur !!! Doit se finir par '/' !!!
	define('B2RUN_SERVER_BASE_URL', '/b2run/');

	// Serveur de base de donnees
	define('B2RUN_BDD_SERVER_HOST', 'localhost');
	// Utilisateur du serveur de BDD
	define('B2RUN_BDD_SERVER_LOGIN', 'test');
	// Mot de passe du serveur de BDD
	define('B2RUN_BDD_SERVER_PASSWD', 'tempor');
}
else {
	// --> Utilisation du SERVEUR DISTANT
	define('B2RUN_MODE_LOCAL', FALSE);

	// Chemin de base du serveur !!! Doit se finir par '/' !!!
	define('B2RUN_SERVER_BASE_PATH', ($_SERVER['DOCUMENT_ROOT'] . 	'/ecotron/b2run/'));

	// URL de base du serveur !!! Doit se finir par '/' !!!
	define('B2RUN_SERVER_BASE_URL', 'http://' .	$_SERVER['HTTP_HOST'] . '/ecotron/b2run/');

	// Serveur de base de donnees
	define('B2RUN_BDD_SERVER_HOST', 'localhost');
	// Utilisateur du serveur de BDD
	define('B2RUN_BDD_SERVER_LOGIN', 'qualite_admin');
	// Mot de passe du serveur de BDD
	define('B2RUN_BDD_SERVER_PASSWD', '5GRA79T4puXvQsGU');
}
*/

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
