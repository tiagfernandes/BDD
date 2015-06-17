<?php
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
