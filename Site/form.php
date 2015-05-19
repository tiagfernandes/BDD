<?php
$nom=$_GET['nom'];
$mail=$_GET['mail'];
$message=$_GET['message'];

    $db = mysql_connect('localhost', 'root', '')  or die('Erreur de connexion '.mysql_error());
    mysql_select_db('test1',$db)  or die('Erreur de selection '.mysql_error());
    $sql = "INSERT INTO test(nom,courriel,message) VALUES($nom,$mail,$message)";
    mysql_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error());

    mysql_close();
?>
