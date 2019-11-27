<?php

include("includes/functions.php");

print "id = " . $_SESSION['id'] . "\n";

session_start();
main();

function main() {
    if (!isset($_SESSION['id'], $_GET['class'], $_GET['format'])) {
        print "nli";
        return;
    }

    $query = "INSERT INTO decks (user_id, class, format) VALUES ({$_SESSION['id']}, '{$_GET['class']}', '{$_GET['format']}');";

    $deck_cards_query = "INSERT INTO deck_cards (deck_cards.deck_id) VALUES (LAST_INSERT_ID());";

    print $query;

    print $deck_cards_query;

    $conn = connect();

    if (!$conn->query($query)) {
        print "error";
        return;
    }

    if (!$conn->query($deck_cards_query)) print "error";
}
?>