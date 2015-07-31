<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'ajout_plateforme.php', permet l'insersion d'une nouvelle plateforme.
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


    $plateforme = $_GET['plateforme'];
    $val_plateforme = $_GET['val_plateforme'];


	//Vérification de la saisie de lieu d'archive

    if ( (!empty($plateforme)) or (!empty($val_plateforme)) ) {

        $sql = "INSERT INTO `plateforme_archive` (plateformeArchive, valeurPlateforme) VALUES ('$plateforme', '$val_plateforme')";
        $prep = $pdo->prepare($sql);
        $prep->execute();


        header('Location: ajout-archivage.php?succes_plateforme');
    }

	else{
    	header('Location: ajout-archivage.php?erreur');
	}
?>
