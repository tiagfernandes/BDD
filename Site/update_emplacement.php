<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'update_emplacement.php', modification d'un emplacement.
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


	$sql = "UPDATE emplacement_archive
            SET valeurEmplacement = :valeurEmplacement,
            EmplacementArchive = :emplacement
			WHERE idEmplacement_Archive = :idEmplacement
			";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':valeurEmplacement', $_POST['valeurEmplacement'], PDO::PARAM_STR);
    $stmt->bindValue(':emplacement', $_POST['emplacement'], PDO::PARAM_STR);
    $stmt->bindValue(':idEmplacement', $_GET['idEmplacement'], PDO::PARAM_STR);

    $stmt->execute();

    header ('location: ajout-archivage.php?succes_update');
?>
