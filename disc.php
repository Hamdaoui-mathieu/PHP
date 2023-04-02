<?php

include "db.php";

$db = connexionBase();

$requete = $db->query("SELECT * FROM disc join artist on disc.artist_id = artist.artist_id order by disc_id");

$tableau = $requete->fetchAll(PDO::FETCH_OBJ);

$requete->closeCursor();


$db = connexionBase();

$requete = $db->query("SELECT * FROM disc");

$tableauc = $requete->fetchAll(PDO::FETCH_OBJ);

$requete->closeCursor();
?>

<?php include('header.php'); ?>

<body class="back">

    <header class="beat">

        <br>
        <br>

        <div class="container-fluid">
            <div class="row">
                <div class="col-11">
                    <h1> <strong>Liste des disques(<?= count($tableauc) ?>)</strong></h1>
                </div>

                <div class="col-1">
                    <a href="disc_new.php" class="button2">Ajouter</a>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>

    </header>

    <div>
        <br><br>
        <div class="col">

            <?php foreach ($tableau as $artist) : ?>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-5">

                            <?php echo '<img src="/img/' . $artist->disc_picture . '" height="220" alt="" style="width:100% height:auto;">'; ?>

                        </div>

                        <div class="col-4">

                            <div>
                                <p class="cadre"><strong><?= $artist->disc_title  ?></strong><br>
                                <p class="cadre"><strong><?= $artist->artist_name ?></strong><br>
                                <p class="cadre"><strong><?= $artist->disc_label  ?></strong><br>
                                <p class="cadre"><strong><?= $artist->disc_year   ?></strong><br>
                                <p class="cadre"><strong><?= $artist->disc_genre  ?></strong><br>

                                <form class="cadre2" action="disc_detail.php?id=<?= $artist->disc_id ?>" method="post">
                                    <input type="hidden" value="<?= $artist->disc_id ?>" name="id"> </input>
                                    <input class="cadre" type="submit" value="Details">
                                </form>

                            </div>
                        </div>
                    </div>
                    <br>

                </div>

            <?php endforeach; ?>
        </div>

        <?php include('footer.php'); ?>
