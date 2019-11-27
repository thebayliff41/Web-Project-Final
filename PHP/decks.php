<?php
include("includes/functions.php");

session_start();
main();

function main() {
    global $decks, $num;

    //if the session variables doesn't exist, they aren't logged in, redirect
    if (!isset($_SESSION['id'], $_SESSION['user_name'])) {
        header('location: login.php');
        exit(0);
    }

    $conn = connect(); //create connnection

    $query = "SELECT d.card1_id, d.card2_id, d.card3_id, d.card4_id, d.card5_id, d.card6_id, d.card7_id, d.card8_id, d.card9_id, d.card10_id, d.card11_id, "
        . "d.card12_id, d.card13_id, d.card14_id, d.card15_id, d.card16_id, d.card17_id, d.card18_id, d.card19_id, d.card20_id, d.card21_id, d.card21_id, "
        . "d.card22_id, d.card23_id, d.card24_id, d.card25_id, d.card26_id, d.card27_id, d.card28_id, d.card29_id, d.card30_id FROM deck_cards d "
        . "INNER JOIN decks ON (decks.id = d.deck_id) INNER JOIN user ON (user.id = decks.user_id) WHERE user.id = {$_SESSION['id']};";

    $res = $conn->query($query);

    if (!$res) return;

    if ($res->num_rows == 0) { //no results
        $num = "<p>{$_SESSION['user_name']} has not created any decks yet.</p>";
        return;
    }

    $row = $res->fetch_row();
    $curl = curl_init() ;

    ?> <div class="cards"> <?php
    for ($i = 0; $i < 30; $i++) { //$decks .= $row[$i] . "\n";

        if ($row[$i] == null) continue;

        $header = array('X-RapidAPI-Host: omgvamp-hearthstone-v1.p.rapidapi.com',
        'X-RapidAPI-Key: 515a0871e5mshd0993dfb00e17f7p10d5ecjsneb6f413631ca');

        $curl = curl_init();

        $options = array(
            CURLOPT_URL => "https://omgvamp-hearthstone-v1.p.rapidapi.com/cards/{$row[$i]}",
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_RETURNTRANSFER => true
        );

        curl_setopt_array($curl, $options);

        $data = json_decode(curl_exec($curl));

        //0 can be hardcoded because we should only get 1 spot
        $decks .= "<div class=\"card-image\"> <img src=\"{$data[0]->img}\" class=\"{$row[$i]}\"id=\"{$i}img\"/> </br>";
        $decks .= '<input type="button" class="remove" id="' . $i . 'btn" onclick="javascript:deleteIt(this);" value="Delete Card" > </div>';

    }//for
    ?> </div> <?php

    curl_close($curl);

}

?>

<!DOCTYPE html>
<html>

<head>
    <title>My Decks</title>
    <meta charset="utf-8" />
    <link href="../CSS/decks.css" type="text/css" rel="stylesheet" />
    <script src="../JS/decks.js"></script>
</head>

<nav>
    <ul>
        <li>HearthStats</li>
        <li><a href="home.php">Home</a></li>
        <li><a href="decks.php">My Decks</a></li>
        <li><a href="cards.php">Cards</a></li>
        <li><a href="signout.php">Sign Out</a></li>
    </ul>
</nav>

<body>
<div class="title">
  <h1> My Decks </h1>
</div>

    <?php
    if ($num != "") print $num;
    else print $decks;
    ?>

</body>

</html>
