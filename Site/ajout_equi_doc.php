<?php
    require_once('fonctions.php');

	$idDocument = $_GET['idDocument'];
	$choix = ($_POST['choixEqui']);
print ($choix);

if (count($choix)>0){
	for ($i=0; $i<count($choix); $i++){

		$sql = "INSERT INTO `equipement_has_document` (idEquipement, idDocument) VALUES ('$choix[$i]','$idDocument')";
        $prep = $pdo->prepare($sql);
        $prep->execute();
	}
       // header('Location: document.php?idDocument='.$idDocument.'&?succes');

}
else {
	//header('Location: equi-doc.php?idDocument='.$idDocument.'&?erreur');
}
?>
