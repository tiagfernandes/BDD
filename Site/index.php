<!doctype html>
<html lang="fr">

   <head>
    <title>Index</title>
    <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <div id="contenu">
            Bonjour
        </div>
    </body>
</html>
<?php // Connexion à la base de donnée + SESSION.
session_start();

// Configuration.
$host = "localhost";
$user = "root";
$pass = "";
$db = "augustine";

$pdo = null;

$DEV = true;

try {
    $connStr = 'mysql:host='.$host.';dbname='.$db;
    $arrExtraParam= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
    $pdo = new PDO($connStr, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES utf8');
} catch(PDOException $e) {
    if($DEV) :
      $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
    else :
      $msg = 'ERREUR de connexion à la base de données';
    endif;
    die($msg);
}
