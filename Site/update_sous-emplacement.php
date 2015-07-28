<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'update_sous-emplacement.php', modification du sous-emplacement.
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


	$sql = "UPDATE sous_emplacement
            SET valeurSousEmplacement = :valeurSousEmplacement,
            sousEmplacement = :sousEmplacement
			WHERE idSous_Emplacement = :idSousEmplacement
			";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':valeurSousEmplacement', $_POST['valeurSousEmplacement'], PDO::PARAM_STR);
    $stmt->bindValue(':sousEmplacement', $_POST['sousEmplacement'], PDO::PARAM_STR);
    $stmt->bindValue(':idSousEmplacement', $_GET['idSousEmplacement'], PDO::PARAM_STR);

    $stmt->execute();

    header ('location: ajout-archivage.php?succes_update');
?>
