<?php
    require_once('fonctions.php');

	$idEquipement = $_GET['idEquipement'];
	$choix = ($_POST['choixDoc']);


if (count($choix)>0){
	for ($i=0; $i<count($choix); $i++){

		$sql = "INSERT INTO `equipement_has_document` (idEquipement, idDocument) VALUES ('$idEquipement','$choix[$i]')";
        $prep = $pdo->prepare($sql);
        $prep->execute();
	}
        header('Location: equipement.php?idEquipement='.$idEquipement.'&?succes');

}
else {
	header('Location: doc-equi.php?idEquipement='.$idEquipement.'&?erreur');
}
?>
