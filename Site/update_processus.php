<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'update_processus.php', modification du processus.
---------------------------------------------------------------------------
L'utilisateur :
N'est pas autorisé.
---------------------------------------------------------------------------
Le développeur :
N'est pas autorisé.
---------------------------------------------------------------------------
L'administrateur :
Autorisé.
------------------------------------------------------------------------ */

    require_once('fonctions.php');


	$sql = "UPDATE processus
            SET valeurProcessus = :valeurProcessus,
            Processus = :processus
			WHERE idProcessus = :idProcessus
			";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':valeurProcessus', $_POST['valeurProcessus'], PDO::PARAM_STR);
    $stmt->bindValue(':processus', $_POST['processus'], PDO::PARAM_STR);
    $stmt->bindValue(':idProcessus', $_GET['idProcessus'], PDO::PARAM_STR);

    $stmt->execute();

    header ('location: ajout-etiquette_doc.php');
?>
