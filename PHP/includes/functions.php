<?php
/**
 * Avoids XSS by cleaning the input
 * 
 * <$str> the string to sanitize
 * <return> the sanitized string
 */
function sanitize($str) {
    $str = trim($str);
    $str = stripslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}

/**
 * Connects to the sql server
 * 
 * return the connection object
 */
function connect() {
    $servername = "47.39.149.56";
    $username = "group-project"; 
    $password = "arpinar";

    //open connnection
    $conn = new mysqli($servername, $username, $password, 'final');

    if ($conn->connect_error) return "error";

    return $conn;
}

/**
 * Gets a card based on the name that was passed
 * 
 * $str the name of the card
 * returns the data from the execution
 */
function getCard($str) {
    $header = array('X-RapidAPI-Host: omgvamp-hearthstone-v1.p.rapidapi.com', 
    'X-RapidAPI-Key: 515a0871e5mshd0993dfb00e17f7p10d5ecjsneb6f413631ca');

    $url = 'https://omgvamp-hearthstone-v1.p.rapidapi.com/cards/search/' . $str . '?collectible=1';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //curl_exec returns data instead of printing
    
    $data = curl_exec($ch);

    curl_close($ch);

    return $data;
}


?>