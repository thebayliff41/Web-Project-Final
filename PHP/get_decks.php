<?php 
include("includes/functions.php"); 

session_start(); 

if (!isset($_SESSION['id'], $_GET['add'])) {
    print "nli"; //not logged in
    return;
}

$conn = connect();

//Check if the user has any decks
$decks_query = "SELECT * FROM decks WHERE user_id = {$_SESSION['id']}";

$decks = $conn->query($decks_query);

if ($decks->num_rows == 0) { //no resullts
    print "no decks";
    return;
}

$min = $obj = -1;
$dup = 0;

for ($i = 30; $i > 0; $i--) { //look through the 30 cards
    $search_query = "SELECT deck_cards.card{$i}_id  FROM deck_cards INNER JOIN decks on"
        . " (decks.id = deck_cards.deck_id) INNER JOIN user on (user.id = decks.user_id)"
        . " WHERE user.id = {$_SESSION['id']} AND deck_cards.card{$i}_id IS NOT NULL;";

    $res = $conn->query($search_query);

    if ($res->num_rows == 0) { //no results 
        $min = $i;
        continue; 
    }

    //the user has multiple decks
    if ($res->num_rows == 2) {

    }

    $obj = $res->fetch_row();

    //checking for duplicates
    if ($obj[0] == $_GET['add'] && ++$dup > 1) {
        print "duplicate";
        return;
    }
}

if ($min == -1) { //the min was never updated, deck full
    print "full";
    return;
}

//inserts the card number into the database
$insert = "UPDATE deck_cards INNER JOIN decks ON (decks.id = deck_cards.deck_id) INNER JOIN user ON (user.id = decks.user_id) SET card{$min}_id = '{$_GET['add']}' WHERE "
    . "user.id = {$_SESSION['id']};";

if (!$conn->query($insert)) {
    print "error";
    return;
}

print $min . "\n";

//print json_encode($obj);
$conn->close();