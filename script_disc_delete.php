<?php

if (!(isset($_GET['id'])) || intval($_GET['id']) <= 0) goto TrtRedirection;


require "db.php";
$db = connexionBase();

try {

    $requete = $db->prepare("DELETE FROM disc WHERE disc_id = ?");
    $requete->execute(array($_GET["id"]));
    $requete->execute();
    $requete->closeCursor();
} catch (Exception $e) {
    echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
    die("Fin du script (script_disc_modif.php)");
}


TrtRedirection:
header("Location: disc.php");
exit;
