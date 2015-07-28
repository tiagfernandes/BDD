<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'ajout_sous_emplacement.php', permet l'insersion d'un nouveau
sous-emplacement.
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


	$s_emplacement = $_GET['s_emplacement'];
    $val_s_emplacement = $_GET['val_s_emplacement'];


	//Vérification de la saisie de lieu d'archive


	if ((!empty($s_emplacement)) or (!empty($val_s_emplacement))){
		$sql = "INSERT INTO `sous_emplacement` (sousEmplacement, valeurSousEmplacement) VALUES ('$s_emplacement', '$val_s_emplacement')";
        $prep = $pdo->prepare($sql);
        $prep->execute();


        header('Location: ajout-archivage.php?succes_s_emplacement');
	}

	else{
    	header('Location: ajout-archivage.php?erreur');
	}
?>
