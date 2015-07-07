<?php
$newNom = $_POST['nom'];	//Nouveau nom taper

$nom = $_FILES['mon_fichier']['name'] ;   //Le nom original du fichier, comme sur le disque du visiteur (exemple : mon_icone.png).
$type = $_FILES['mon_fichier']['type'] ;    //Le type du fichier. Par exemple, cela peut être « image/png ».
$taille = $_FILES['mon_fichier']['size'] ;    //La taille du fichier en octets.
$adresse = $_FILES['mon_fichier']['tmp_name']; //L'adresse vers le fichier uploadé dans le répertoire temporaire.
$erreur = $_FILES['mon_fichier']['error'] ;   //Le code d'erreur, qui permet de savoir si le fichier a bien été uploadé.


if (!empty($nom)){	//Vérifie si un document à été sélectionné
	$extensions_valides = array( 'pdf', 'xps' );
	//1. strrchr renvoie l'extension avec le point (« . »).
	//2. substr(chaine,1) ignore le premier caractère de chaine.
	//3. strtolower met l'extension en minuscules.
	$extension_upload = strtolower(  substr(  strrchr($_FILES['mon_fichier']['name'], '.')  ,1)  );

		print("Nom : $nom <br>");
		print("Type : $type <br>");
		print("Taille : $taille <br>");
		print("Adresse tempo : $adresse <br>");
		print("Erreur : $erreur <br>");

	if ( in_array($extension_upload,$extensions_valides) ) {	//Vérifie si le type de fichier correspond a ce que le souhaite
		echo "Extension correcte.<br>";

		if (empty($newNom)){
			$newNom = $nom;
			// on souhaite récupéré l'extension
			$filename = $newNom;

			$extension = strrchr($filename,'.');
			// Comme le point ne vous intéresse pas
			// forcément on le supprime
			$extension=substr($extension,1) ;
			$today = date("d_m_y"); //Date aujourd'hui jour/mois/annee

			print "Extension :$extension<br>";

			//Si le champs du nouveau nom est vide, la variable récupère le nom du fichier
			$newNom = pathinfo($nom, PATHINFO_FILENAME);
			print "Nouveau $newNom<br>";
			$newNom = ("$newNom-$today.$extension"); //Nouveau nom/date/extension
			print "Nouveau nom : $newNom<br>";	//Nouveau nom avec extension
		}
		else {
			// on souhaite récupéré l'extension
			$filename = $nom;

			$extension = strrchr($filename,'.');
			// Comme le point ne vous intéresse pas
			// forcément on le supprime
			$extension=substr($extension,1) ;
			$today = date("d_m_y"); //Date aujourd'hui jour/mois/annee

			print "Extension :$extension<br>";

			$newNom = ("$newNom-$today.$extension"); //Nouveau nom/date/extension
			print "Nouveau nom : $newNom<br>";	//Nouveau nom avec extension
		}


			if ($_FILES['mon_fichier']['error'] > 0) {	//Vérifie si une erreur est transmise lors du transfere
				$error = "Erreur lors du transfert<br>";
				print $error;
			}
			else {
				print "OK<br>";
			}


				$lieu = "documents/{$newNom}";	//Envoie le fichier dans le dossier
				$resultat = move_uploaded_file($_FILES['mon_fichier']['tmp_name'],$lieu);

				if ($resultat) {
					echo "Transfert reussi <br>";
					$test = $lieu;
					echo $test;

				}
				else {
					print "Non reussi";
				}
	}
	else {
		echo "Mauvais type de fichier.<br>";
	}
}
else {
	print "Aucun fichier selectionner";
}
?>
