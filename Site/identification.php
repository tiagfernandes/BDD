<?php
header('Content-Type: text/html; charset=utf-8');

$login_valide = "root";
$pwd_valide = "sio";

if (isset($_POST['login']) && isset($_POST['pwd'])) {
    if ($login_valide == $_POST['login'] && $pwd_valide == $_POST['pwd']) {
        session_start ();
        $_SESSION['login'] = $_POST['login'];
		$_SESSION['pwd'] = $_POST['pwd'];
        header ('location: page_membre.php');
    }

    else {
        echo '<body onLoad="alert(\'Membre non reconnu...\')">';

		echo '<meta http-equiv="refresh" content="0;URL=formulaire-co.php">';
    }
}
else {
	echo 'Les variables du formulaire ne sont pas déclarées.';
}
?>
