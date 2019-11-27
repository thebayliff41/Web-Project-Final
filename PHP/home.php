<?php
include('includes/functions.php');
session_start();

//if the session variable doesn't exist, they aren't logged in, redirect
if (!isset($_SESSION['id'], $_SESSION['user_name'])) {
    header('location: login.php');
    exit(0);
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home Page</title>
        <meta charset="utf-8" />
        <link href = "../CSS/home.css" type="text/css" rel="stylesheet" />
    </head>

    <nav>
      <ul>
        <li>HearthStats</li>
        <li><a href="#">Home</a></li>
        <li><a href="decks.php">My Decks</a></li>
        <li><a href="cards.php">Cards</a></li>
        <li><a href="signout.php">Sign Out</a></li>
      </ul>
    </nav>

    <body>
      <div class="main">
        <h1>Welcome, <?php print $_SESSION['user_name'];?>!</h1>
      </div>
    </body>
</html>
