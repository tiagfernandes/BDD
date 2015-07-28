<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'update_sous_processus.php', modification du sous-processus.
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


	$sql = "UPDATE sous_processus
            SET valeurSousProcessus = :valeurSousProcessus,
            sousProcessus = :sousProcessus
			WHERE idSous_Processus = :idSousProcessus
			";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':valeurSousProcessus', $_POST['valeurSousProcessus'], PDO::PARAM_STR);
    $stmt->bindValue(':sousProcessus', $_POST['sousProcessus'], PDO::PARAM_STR);
    $stmt->bindValue(':idSousProcessus', $_GET['idSousProcessus'], PDO::PARAM_STR);

    $stmt->execute();

    header ('location: ajout-etiquette_doc.php');
?>
