<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'update_acronime.php', modifie les valeurs de l'acronime choisis.
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


	$sql = "UPDATE acronime_etiquette
            SET valeurAcronime = :valAcronime,
            acronimeEtiquette = :acronime
			WHERE idAcronimeEtiquette = :idAcronime
			";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':valAcronime', $_POST['valAcronime'], PDO::PARAM_STR);
    $stmt->bindValue(':acronime', $_POST['acronime'], PDO::PARAM_STR);
    $stmt->bindValue(':idAcronime', $_GET['idAcronime'], PDO::PARAM_STR);

    $stmt->execute();

    header ('location: ajout-acronime.php?succes_update');
?>
