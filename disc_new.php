<?php include('header.php'); 
include('db.php');
$db = connexionBase();

$requete = $db->query("SELECT * FROM artist ");
$myArtistoption = $requete->fetchAll(PDO::FETCH_OBJ);
$requete->closeCursor();
?>

<body class="back">


    <header>
        <br>
        <h1><strong>Ajouter un vinyle</strong></h1>
        <br>
        <br>
        <br>
        <br>
    </header>
    <br>
    <form class="margin" action="script_disc_ajout.php" method="POST" enctype="multipart/form-data">

    <label id="title" class="lb" for="title">Title : </label><br>
        <input type="text" placeholder= "Enter title" id="title" name="title" class="ip"><br>

    <label id="disc_artist" for="disc_artist" class="lb">Artist :</label><br>
        <select name="disc_artist" id="disc_artist"><br>

<?php foreach ($myArtistoption as $artist){
    if($artist->artist_id == $myArtist->artist_id){
        echo'<option value="'.$artist->artist_id.'" selected >'.$artist->artist_name.'</option>';
    }
    else{
        echo '<option value="'.$artist->artist_id.'">'.$artist->artist_name.'</option>';
    }
}?>
        <!--label class="lb" for="title">Title : </label><br>
        <input type="text" placeholder="Enter title" id="title" name="title" class="ip"><br>


        <label id="name" class="lb" for="name">Artist :</label><br>
        <select name="name" id="name">
            <option value=0>--Choisissez un artiste--</option>
            <option value=1>Neil Young</option>
            <option value=2>YES</option>
            <option value=3>Rolling Stones</option>
            <option value=4>Queens of the Stone Age</option>
            <option value=5>Serge Gainsbourg</option>
            <option value=6>AC/DC</option>
            <option value=7>Marillion</option>
            <option value=8>Bob Dylan</option>
            <option value=9>Fleshtones</option>
            <option value=10>The Clash</option>
            <option value=11>Alice in Chains</option-->
        </select>

        <br>

        <label id="year" class="lb" for="year">Year : </label><br>
        <input type="text" placeholder="Enter Year" id="year" name="year" class="ip"><br>


        <label id="genre" class="lb" for="genre">Genre : </label><br>
        <input type="text" placeholder="Enter genre (Rock,Pop, Prog...)" id="genre" name="genre" class="ip"><br>


        <label id="label" class="lb" for="label">Label : </label><br>
        <input type="text" placeholder="Enter label (EMI,Warner, PolyGram, Univers sale...)" id="label" name="label" class="ip"><br>


        <label id="price" class="lb" for="Price">Price : </label><br>
        <input type="text" placeholder="Enter price" id="price" name="price" class="ip"><br>

        <label id="picture" class="lb" for="picture"> Picture : </label><br><br>
        <input type="file" name="picture">
        <br>
        <br>
        <input id="sb" type="submit" value="Ajouter"> <input type="button" value="Retour" onclick="history.back()">

    </form>

    <?php include('footer.php'); ?>
