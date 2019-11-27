<?php
include ("includes/functions.php");

session_start();

if (!isset($_GET['val'], $_GET['num'])) return;

print $_GET['val'] . "\n";
print $_GET['num'];

$query = "UPDATE deck_cards SET card{$_GET['num']}_id = NULL;";
$conn = connect();

if (!$conn->query($query)) print "error";