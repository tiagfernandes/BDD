<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'ajout_emplacement.php', permet l'insersion d'un nouveau emplacement.
---------------------------------------------------------------------------
L'utilisateur :
Ne peut rien faire.
---------------------------------------------------------------------------
Le développeur :
Ne peut rien faire.
---------------------------------------------------------------------------
L'administrateur :
Autorisé.
------------------------------------------------------------------------ */

    require_once('fonctions.php');


	$emplacement = $_GET['emplacement'];
    $val_emplacement = $_GET['val_emplacement'];

	//Vérification de la saisie de lieu d'archive


	if ((!empty($emplacement)) or (!empty($val_emplacement))) {
		$sql = "INSERT INTO `emplacement_archive` (emplacementArchive, valeurEmplacement) VALUES ('$emplacement', '$val_emplacement')";
        $prep = $pdo->prepare($sql);
        $prep->execute();


        header('Location: ajout-archivage.php?succes_emplacement');
	}

	else{
    	header('Location: ajout-archivage.php?erreur');
	}
?>
