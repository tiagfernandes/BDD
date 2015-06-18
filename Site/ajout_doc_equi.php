<?php
    require_once('fonctions.php');

	$idEquipement = $_GET['idEquipement'];
	$choix = ($_POST['choixDoc']);

if (count($choix)>0){
	for ($i=0; $i<count($choix); $i++){
		print("$choix[$i]\n");
	 }
}
else {
	header('Location: doc-equi.php?idEquipement='.$idEquipement.'&?erreur');
}
?>
