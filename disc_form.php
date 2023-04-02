<?php
require "db.php";
$db = connexionBase();

$requete = $db->prepare("SELECT * FROM disc join artist on disc.artist_id = artist.artist_id WHERE disc.disc_id = ? ");
$requete->execute(array($_GET["id"]));
$myArtist = $requete->fetch(PDO::FETCH_OBJ);
$requete->closeCursor();

$requete2 = $db->query("SELECT * FROM artist ");
$myArtistoption = $requete2->fetchAll(PDO::FETCH_OBJ);
$requete2->closeCursor();




var_dump($myArtist);
?>


<?php include('header.php'); ?>

<body class="back">

    <header>
        <br>
        <h1><strong>Modifier un vinyle</strong></h1>
        <br>
        <br>
        <br>
        <br>
    </header>

    <br>
    <form class="margin" action="script_disc_modif.php" method="post" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?= $myArtist->disc_id ?>">

        <label id="title" class="lb" for="title">Title : </label><br>
        <input type="text" value="<?= $myArtist->disc_title ?>" id="title" name="title" class="ip"><br>


        <label id="disc_artist" for="disc_artist" class="lb">Artist :</label><br>
        <select name="disc_artist" id="disc_artist">

<?php foreach ($myArtistoption as $artist){
    if($artist->artist_id == $myArtist->artist_id){
        echo'<option value="'.$artist->artist_id.'" selected >'.$artist->artist_name.'</option>';
    }
    else{
        echo '<option value="'.$artist->artist_id.'">'.$artist->artist_name.'</option>';
    }
}?>


</select><br><br>

        <label id="year" class="lb" for="year">Year : </label><br>
        <input type="text" value="<?= $myArtist->disc_year ?>" id="year" name="year" class="ip"><br>


        <label id="genre" class="lb" for="genre">Genre : </label><br>
        <input type="text" value="<?= $myArtist->disc_genre ?>" id="genre" name="genre" class="ip"><br>


        <label id="label" class="lb" for="label">Label : </label><br>
        <input type="text" value="<?= $myArtist->disc_label ?>" id="label" name="label" class="ip"><br>


        <label id="price" class="lb" for="Price">Price : </label><br>
        <input type="text" value="<?= $myArtist->disc_price ?>" id="price" name="price" class="ip"><br>

        <label id="Picture" class="lb" for="label"> Picture : </label><br><br>
        <input type="file" name="picture">
        <br>
        <br>
        <img src="/img/<?= $myArtist->disc_picture ?>" height=" 400" alt=""><br>
<br>
        <input id="sb" type="submit" value="Modifier" onclick="return confirm('Voulez-vous vraiment modifier ce vinyle?');">
        <input type="button" value="Retour" onclick="history.back()">
    </form>


    <?php include('footer.php'); ?>
