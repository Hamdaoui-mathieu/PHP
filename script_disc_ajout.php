<?php

var_dump($_POST);

$title   = (isset($_POST['title']) && $_POST['title'] != "") ? $_POST['title'] : Null;
$year    = (isset($_POST['year']) && $_POST['year'] != "") ? $_POST['year']  : Null;
$genre   = (isset($_POST['genre']) && $_POST['genre'] != "") ? $_POST['genre'] : Null;
$label   = (isset($_POST['label']) && $_POST['label'] != "") ? $_POST['label'] : Null;
$price   = (isset($_POST['price']) && $_POST['price'] != "") ? $_POST['price'] : Null;
$disc_artist   = (isset($_POST['disc_artist']) && $_POST['disc_artist'] != "") ? $_POST['disc_artist'] : Null;
$picsName = (isset($_POST['picture']) && $_POST['picture'] != "") ? $_POST['picture'] : Null;


if ($title == Null || $year == Null || $genre == Null || $label == Null || $price == Null || $disc_artist == Null) {
    header("Location: disc_new.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_FILES["picture"]) && $_FILES["picture"]["error"] != 0) {
        echo 'Erreur de chargement image';
    }
    else{
        echo 'Chargement image validé';
    }
        $format = array("img/jpg", "img/gif", "img/jpeg", "img/pjpeg", "img/png", "img/x-png", "img/tiff", "image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/tiff", "image/jpg");

        $picsName = $_FILES["picture"]["name"];
        $picsType = $_FILES["picture"]["type"];
        $picsSize = $_FILES["picture"]["size"];
        $maxSize = 5 * 1024 * 1024;

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $picsType = finfo_file($finfo, $_FILES["picture"]["tmp_name"]);

        finfo_close($finfo);

  if (in_array($picsType, $format))

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], "img/" . $picsName)) {

                var_dump($_FILES["picture"]["tmp_name"]);
                var_dump($picsName);
            }}
    require "db.php";
    $db = connexionBase();




try {
    $requete = $db->prepare("INSERT INTO disc (disc_title, disc_year, disc_genre, disc_label, disc_price, artist_id, disc_picture) VALUES (:title, :year, :genre, :label, :price, :disc_artist, :picture);");

    $requete->bindValue(":title", $title,   PDO::PARAM_STR);
    $requete->bindValue(":year", $year,     PDO::PARAM_INT);
    $requete->bindValue(":genre", $genre,   PDO::PARAM_STR);
    $requete->bindValue(":label", $label,   PDO::PARAM_STR);
    $requete->bindValue(":price", $price,   PDO::PARAM_STR);
    $requete->bindValue(":disc_artist", $disc_artist,   PDO::PARAM_INT);
    $requete->bindvalue(":picture", $picsName, PDO::PARAM_STR);

    var_dump($requete);

    $requete->execute();

    $requete->closeCursor();

} catch (Exception $e) {
    var_dump($requete->queryString);
    var_dump($requete->errorInfo());
    echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
    die("Fin du script (script_disc_ajout.php)");
}

header("Location: disc.php");

exit;
