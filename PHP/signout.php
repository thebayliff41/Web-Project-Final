<?php
    session_start();
    if (!isset($_SESSION['id'], $_SESSION['user_name'])) {
        header('location: login.php');
        exit(0);
    }

    session_destroy();
    header('location: ../index.html');
    exit(0);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sign-off</title>
        <meta charset="utf-8" />
        <link href = "../CSS/index.css" type="text/css" rel="stylesheet"/>
    </head>

    <body>
    <h2>Thank you for using HearthStats</h2>
    <h4>Created by:</h4>
        <div>
            <p>
                <strong>Bailey Nelson</strong>
                <img src="../Images/captain.png" />
            </p>
        </div>

        <div>
            <p>
                <strong>Matthew Mooney</strong>
                <!-- put image of a card here  -->
            </p>
        </div>

        <div>
            <p>
                <strong>Kirsten Floyd</strong>
                <!-- put image of a card here  -->
            </p>
        </div>

        <a href="../index.html">Back to Main Screen</a>
    </body>
</html>