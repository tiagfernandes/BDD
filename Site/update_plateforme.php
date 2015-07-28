<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'update_plateforme.php', modification de la plateforme.
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


	$sql = "UPDATE plateforme_archive
            SET valeurPlateforme = :valeurPlateforme,
            plateformeArchive = :plateforme
			WHERE idPlateforme_Archive = :idPlateforme
			";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':valeurPlateforme', $_POST['valeurPlateforme'], PDO::PARAM_STR);
    $stmt->bindValue(':plateforme', $_POST['plateforme'], PDO::PARAM_STR);
    $stmt->bindValue(':idPlateforme', $_GET['idPlateforme'], PDO::PARAM_STR);

    $stmt->execute();

    header ('location: ajout-archivage.php?succes_update');
?>
