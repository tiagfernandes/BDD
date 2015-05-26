<?php
    require_once('fonctions.php');
    session_start ();

    $prenom = $_POST['nprenom'];
    $nom = $_POST['nnom'];
    $mail = $_POST['nmail'];
    $login = $_POST['nidentifiant'];
    $passwd = $_POST['nmdp'];

    $sql = "UPDATE utilisateur
            SET nomUtilisateur = :nom,
            prenomUtilisateur= :prenom,
            email = :mail,
            login = :login,
            password = :password";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(":nom", $nom);
    $stmt->bindValue(":prenom", $prenom);
    $stmt->bindValue(":mail", $mail);
    $stmt->bindValue(":login", $login);
    $stmt->bindValue(":password", $passwd);

    $stmt->execute();

    header ('location: authentification.php?reco');
?>
