<?php
require "db.php";
$db = connexionBase();

$id = $_GET["id"];

$requete = $db->prepare("SELECT * FROM disc join artist on disc.artist_id = artist.artist_id WHERE disc_id = ? ");

$requete->execute(array($id));


$myArtist = $requete->fetch(PDO::FETCH_OBJ);

$requete->closeCursor();
//var_dump($myArtist);

include("header.php");
?>

<body class="back">

    <header>

        <br>
        <h1><strong>Details</strong></h1>
        <br>
        <br>
        <br>
        <br>
    </header>

    <div class="container-fluid">

        <div class="row">

            <div class="col-6">
                <p class="cadre"><strong>Titre : <?php echo $myArtist->disc_title ?></strong>
                <p class="cadre"><strong>Année : <?= $myArtist->disc_year ?></strong>
                <p class="cadre"><strong>Label : <?= $myArtist->disc_label ?></strong>
            </div>
            <div class="col-6">
                <p class="cadre"><strong>Artist: <?= $myArtist->artist_name ?></strong>
                <p class="cadre"><strong>Genre : <?= $myArtist->disc_genre ?></strong>
                <p class="cadre"><strong>Price : <?= $myArtist->disc_price ?></strong>
            </div>
        </div>
    </div>

    <p class="cadre2"><strong> Picture:</strong>

        <br>
        <br>
        <?php echo '<img src="/img/' . $myArtist->disc_picture . '"height="400" alt="">'; ?>
        <br>
        <br>
        <a href="disc_form.php?id=<?= $myArtist->disc_id ?>" class="button">Modifier</a>
        <a href="script_disc_delete.php?id=<?= $myArtist->disc_id ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce vinyle?');" class="button">Supprimer</a>
        <a href="disc.php" class="button">Retour</a>
        </div>
</body>

</html>
