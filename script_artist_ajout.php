<?php
    // Récupération du Nom :
    if (isset($_POST['nom']) && $_POST['nom'] != "") {
        $nom = $_POST['nom'];
    }
    else {
        $nom = Null;
    }

    $url = (isset($_POST['url']) && $_POST['url'] != "") ? $_POST['url'] : Null;


    if ($nom == Null || $url == Null) {
        header("Location: artist_new.php");
        exit;
    }

    require "db.php"; 
    $db = connexionBase();


try {
      $requete = $db->prepare("INSERT INTO artist (artist_name, artist_url) VALUES (:nom, :url);");

   
    $requete->bindValue(":url", $url, PDO::PARAM_STR);
    $requete->bindValue(":nom", $nom, PDO::PARAM_STR);

    $requete->execute();


    $requete->closeCursor();
}

catch (Exception $e) {
    var_dump($requete->queryString);
    var_dump($requete->errorInfo());
    echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
    die("Fin du script (script_artist_ajout.php)");
}

header("Location: artist.php");

exit;
