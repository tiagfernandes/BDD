<!doctype html>
<html lang="fr">

   <head>
    <title>Index</title>
    <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    
<?php include_once('connexion.php'); ?>
      
    <body>

        <div class="">
        <?php
            $req1 = 'SELECT * FROM utilisateur';
            $result = $pdo->query(req1);
        while ($row = $result->fetch())
        { ?>

        <p>Nom : <?php>print($row[]);?></p>
        ?>

        </div>
    </body>
</html>
