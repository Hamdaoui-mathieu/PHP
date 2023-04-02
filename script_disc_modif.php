<?php

var_dump($_POST);

include("header.php");
require "db.php";
$db = connexionBase();

$id = (isset($_POST['id']) && $_POST['id'] != "") ? $_POST['id'] : Null;
$title   = (isset($_POST['title']) && $_POST['title'] != "") ? $_POST['title'] : Null;
$year    = (isset($_POST['year']) && $_POST['year'] != "") ? $_POST['year'] : Null;
$genre   = (isset($_POST['genre']) && $_POST['genre'] != "") ? $_POST['genre'] : Null;
$label   = (isset($_POST['label']) && $_POST['label'] != "") ? $_POST['label'] : Null;
$price   = (isset($_POST['price']) && $_POST['price'] != "") ? $_POST['price'] : Null;
$disc_artist   = (isset($_POST['disc_artist']) && $_POST['disc_artist'] != "") ? $_POST['disc_artist'] : Null;





if ($id == Null) {
    header("location: disc.php");
}
elseif ($title == Null || $year == Null || $genre == Null || $label == Null || $price == Null || $disc_artist == Null) {
    header("Location: disc_form.php?id=" . $id);

    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST")

    if (isset($_FILES["picture"]) && $_FILES["picture"]["error"] == 0) {
        $format = array("img/jpg", "img/gif", "img/jpeg", "img/pjpeg", "img/png", "img/x-png", "img/tiff", "image/gif", "image/jpg", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/tiff");

        $picsName = $_FILES["picture"]["name"];
        $picsType = $_FILES["picture"]["type"];
        $picsSize = $_FILES["picture"]["size"];
        $file_info = pathinfo($_FILES['picture']['name']);
        $maxSize = 5 * 1024 * 1024;

        // Extraction du type de fichier avec file_info

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $picsType = finfo_file($finfo, $_FILES["picture"]["tmp_name"]);
        finfo_close($finfo);

        var_dump($picsType);

        /* le type de fichier est okay, donc on va pouvoir déplacer et renommer le fichier.*/


        if (in_array($picsType, $format)) {

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], "img/" . $picsName)) {

                var_dump($_FILES["picture"]["tmp_name"]);
                var_dump($picsName);
                try {
                    $requete = $db->prepare("UPDATE disc SET disc_picture = :picture WHERE disc_id = :id;");

                    $requete->bindvalue(':picture', $picsName, PDO::PARAM_STR);
                    $requete->bindvalue(':id', $id, PDO::PARAM_INT);

                    $requete->execute();
                    $requete->closeCursor();
                } catch (Exception $e) {
                    var_dump($requete->errorInfo());
                    print_r($_POST);
                    echo "Erreur :" . $requete->errorInfo()[2] . "<br>";
                    die("fin du script(script_disc_modif.php)");
                }
            }
        } else {
            // Info si type de fichier non autorisé
            echo "Seul les fichiers: gif, jpeg, pjpeg, x-png, png, ou tiff sont autorisés. Merci de choisir parmi ce type cités.";
            exit;
        }
    }




try {
    $requete = $db->prepare("UPDATE disc SET disc_title = :title, disc_year = :year, disc_genre = :genre, disc_label = :label, disc_price = :price , artist_id = :disc_artist WHERE disc_id = :id;");
    $requete->bindValue(":id", $id, PDO::PARAM_INT);
    $requete->bindValue(":title", $title,   PDO::PARAM_STR);
    $requete->bindValue(":year", $year,     PDO::PARAM_INT);
    $requete->bindValue(":genre", $genre,   PDO::PARAM_STR);
    $requete->bindValue(":label", $label,   PDO::PARAM_STR);
    $requete->bindValue(":price", $price,   PDO::PARAM_STR);
    $requete->bindValue(":disc_artist",  $disc_artist,   PDO::PARAM_STR);



    $requete->execute();
    $requete->closeCursor();
} catch (Exception $e) {
    echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
    die("Fin du script (script_disc_modif.php)");
}

header("Location: disc.php");
exit;
